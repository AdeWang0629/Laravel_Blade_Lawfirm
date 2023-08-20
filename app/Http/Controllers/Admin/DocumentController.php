<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Lawsuite;
use App\Repository\DocumentRepositoryInterface;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public $documents;
    public function __construct(DocumentRepositoryInterface $documents) {
        $this->documents = $documents;
        $this->middleware('permission:document_list|document_create|document_show|document_delete|document_downloadDocument', ['only' => ['index']]);
        $this->middleware('permission:document_create', ['only' => ['store']]);
        $this->middleware('permission:document_show', ['only' => ['show']]);
        $this->middleware('permission:document_delete', ['only' => ['destroy']]);
        $this->middleware('permission:document_downloadDocument', ['only' => ['downloadDocument']]);

    }

    public function index()
    {
        return $this->documents->index();
    }

    public function store(DocumentRequest $request)
    {
        return $this->documents->store($request);
    }

    public function show(Document $document)
    {
        return $this->documents->show($document);
    }

    public function destroy(Document $document)
    {
        return $this->documents->destroy($document);
    }

    public function downloadDocument(Request $request)
    {
        return $this->documents->downloadDocument($request);
    }
}
