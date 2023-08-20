<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Local\LocalFilesystemAdapter;

class BackupController extends Controller
{

    public function __construct() {
        $this->middleware('permission:backups_list|backups_create|backups_download|backups_delete', ['only' => ['index']]);
        $this->middleware('permission:backups_create', ['only' => ['create']]);
        $this->middleware('permission:backups_download', ['only' => ['download']]);
        $this->middleware('permission:backups_delete', ['only' => ['delete']]);
    }

    public function index()
    {
        if (!count(config('backup.backup.destination.disks'))) {
            abort(500, trans('backpack::backup.no_disks_configured'));
        }

        $this->data['backups'] = [];

        foreach (config('backup.backup.destination.disks') as $diskName) {
            $disk = Storage::disk($diskName);
            $files = $disk->allFiles();

            // make an array of backup files, with their filesize and creation date
            foreach ($files as $file) {
                // remove diskname from filename
                $fileName = str_replace('backups/', '', $file);
                $downloadLink = route('admin.backup.download', ['file_name' => $fileName, 'disk' => $diskName]);
                $deleteLink = route('admin.backup.destroy', ['file_name' => $fileName, 'disk' => $diskName]);

                // only take the zip files into account
                if (substr($file, -4) == '.zip' && $disk->exists($file)) {
                    $this->data['backups'][] = (object) [
                        'filePath'     => $file,
                        'fileName'     => str_replace(config('backup.backup.name') . '/', '', $fileName),
                        'fileSize'     => round((int) $disk->size($file) / 1048576, 2),
                        'lastModified' => Carbon::createFromTimeStamp($disk->lastModified($file))->translatedFormat('d M, Y, H:i'),
                        'diskName'     => $diskName,
                        'downloadLink' => is_a($disk->getAdapter(), LocalFilesystemAdapter::class, true) ? $downloadLink : null,
                        'deleteLink'   => $deleteLink,
                    ];
                }
            }
        }

        // reverse the backups, so the newest one would be on top
        $this->data['backups'] = array_reverse($this->data['backups']);

        return view('admin.backups.backup', $this->data);
    }

    public function create()
    {
        $command = config('backpack.backupmanager.artisan_command_on_button_click') ?? 'backup:run';

        try {
            foreach (config('backpack.backupmanager.ini_settings', []) as $setting => $value) {
                ini_set($setting, $value);
            }

            Log::info('Backpack\BackupManager -- Called backup:run from admin interface');

            Artisan::call($command);

            $output = Artisan::output();
            if (strpos($output, 'Backup failed because')) {
                preg_match('/Backup failed because(.*?)$/ms', $output, $match);
                $message = "Backpack\BackupManager -- backup process failed because ".($match[1] ?? '');
                Log::error($message.PHP_EOL.$output);

                return response($message, 500);
            }
        } catch (Exception $e) {
            Log::error($e);

            return response($e->getMessage(), 500);
        }

        return true;
    }

    public function download()
    {
        $diskName = Request::input('disk');
        $fileName = Request::input('file_name');
        $disk = Storage::disk($diskName);

        if (!$this->isBackupDisk($diskName)) {
            abort(500, trans('backpack::backup.unknown_disk'));
        }

        if (!is_a($disk->getAdapter(), LocalFilesystemAdapter::class, true)) {
            abort(404, trans('backpack::backup.only_local_downloads_supported'));
        }

        if (!$disk->exists($fileName)) {
            abort(404, trans('backpack::backup.backup_doesnt_exist'));
        }

        return $disk->download($fileName);
    }

    public function delete()
    {
        $diskName = Request::input('disk');
        $fileName = Request::input('file_name');

        if (!$this->isBackupDisk($diskName)) {
            return response(trans('backpack::backup.unknown_disk'), 500);
        }

        $disk = Storage::disk($diskName);

        if (!$disk->exists($fileName)) {
            return response(trans('backpack::backup.backup_doesnt_exist'), 404);
        }

        return $disk->delete($fileName);
    }

    private function isBackupDisk(string $diskName)
    {
        return in_array($diskName, config('backup.backup.destination.disks'));
    }
}
