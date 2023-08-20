<?php

namespace App\Repository;

use App\Models\Document;
use App\Models\Lawsuite;
use App\Repository\DocumentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentRepository implements DocumentRepositoryInterface {
    public function index()
    {
        $documents = Document::with('documentable')->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function show($document)
    {
        if ($document) {
            return response()->file(public_path('documents_files/'.$document->documentable->case_number.'/'.$document->file_name));
        }
    }

    public function store($request)
    {
        try {
            $lawsuite = Lawsuite::findOrFail($request->lawsuite_id);
            foreach ($request->lawsuite_documents as $image) {
                $fileName = $image->getClientOriginalName();
                $image->storeAs($lawsuite->case_number, $fileName, 'document_attachments');
                
                $lawsuite->documents()->create([
                    'file_name'     => $fileName,
                    'file_type'     => $image->getMimeType(),
                    'file_size'     => $image->getSize(),
                ]);
            }

            toast(trans('site.created successfully', ['attr' => trans('site.documents')]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($document)
    {
        try {
            if ($document) {
                Storage::disk('document_attachments')->delete($document->documentable->case_number.'/'.$document->file_name);
                $document->delete();
            }

            toast(trans('site.deleted successfully', ['attr' => trans_choice('site.documents', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function downloadDocument($request)
    {
        try {
            return response()->download(public_path('documents_files/'.$request->lawsuite_case_number.'/'.$request->file_name ));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }
}