<?php

namespace App\Repository;

use App\Models\Client;
use App\Repository\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class ClientRepository implements ClientRepositoryInterface {
    public function index()
    {
        $clients = Client::withCount(['lawsuites','consultations'])->orderByDesc('id')->get();
        $trashed = Client::onlyTrashed()->get();
        return view('admin.clients.index', compact('clients','trashed'));
    }

    public function trashed()
    {
        $trashed = Client::onlyTrashed()->withCount(['lawsuites','consultations'])->orderByDesc('id')->get();
        return view('admin.clients.trash', compact('trashed'));
    }

    public function store($request)
    {
        try {
            $data['name']           = Purify::clean($request->name);
            $data['user_name']      = Purify::clean($request->user_name);
            $data['id_number']      = Purify::clean($request->id_number);
            $data['cr_number']      = Purify::clean($request->cr_number);
            $data['nationality']    = Purify::clean($request->nationality);
            $data['po_box']         = Purify::clean($request->po_box);
            $data['mobile']         = Purify::clean($request->mobile);
            $data['phone']          = Purify::clean($request->phone);
            $data['email']          = $request->email;
            $data['city']           = Purify::clean($request->city);
            $data['address']        = Purify::clean($request->address);
            $data['status']         = $request->status;
            $data['notes']          = Purify::clean($request->notes);
            if ($request->has('password') && $request->password != '') {
                $data['password'] = bcrypt($request->password);
            }

            Client::create($data);
            toast(trans('site.created successfully', ['attr' => trans_choice('site.clients', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    function show($client)
    {
        $client->load('lawsuites');
        return view('admin.clients.show', compact('client'));
    }

    public function update($request, $client)
    {
        try {

            $data['name']           = Purify::clean($request->name);
            $data['user_name']      = Purify::clean($request->user_name);
            $data['id_number']      = Purify::clean($request->id_number);
            $data['cr_number']      = Purify::clean($request->cr_number);
            $data['nationality']    = Purify::clean($request->nationality);
            $data['po_box']         = Purify::clean($request->po_box);
            $data['mobile']         = Purify::clean($request->mobile);
            $data['phone']          = Purify::clean($request->phone);
            $data['email']          = $request->email;
            $data['city']           = Purify::clean($request->city);
            $data['address']        = Purify::clean($request->address);
            $data['status']         = $request->status;
            $data['notes']          = Purify::clean($request->notes);
            if ($request->has('password') && $request->password != '') {
                $data['password'] = bcrypt($request->password);
            }
            $client->update($data);
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.clients', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($client)
    {
        if ($client->lawsuites->count() > 0 || $client->consultations->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $client->delete();

        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.clients', 0)]),'error');
        return back();
    }

    public function forceDelete($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);

        if ($client->lawsuites->count() > 0 || $client->consultations->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $client->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.clients', 0)]),'error');
        return back();
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);

        $client->restore();
        toast(trans('site.restored successfully', ['attr' => trans_choice('site.clients', 0)]),'success');
        return back();
    }
}
