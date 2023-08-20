<?php
namespace App\Repository;


interface LawsuitePaperRepositoryInterface {
    // all lawsuites papers
    public function index();

    // show lawsuites paper
    public function show($lawsuites_paper);

    // store lawsuites paper
    public function store($request);

    // update lawsuites paper
    public function update($request, $lawsuites_paper);

    // delete lawsuites paper
    public function destroy($lawsuites_paper);
}