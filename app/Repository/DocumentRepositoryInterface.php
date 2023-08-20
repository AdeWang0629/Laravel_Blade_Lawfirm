<?php
namespace App\Repository;


interface DocumentRepositoryInterface {
    // all Documents
    public function index();

    // store Document
    public function show($document);

    // store Document
    public function store($request);

    // download Document
    public function downloadDocument($request);
    
    // destroy Document
    public function destroy($document);
}