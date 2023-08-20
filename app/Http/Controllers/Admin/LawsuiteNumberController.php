<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LawsuiteNumberRequest;
use App\Models\LawsuiteNumber;
use App\Repository\LawsuiteNumberRepositoryInterface;
use Illuminate\Http\Request;

class LawsuiteNumberController extends Controller
{
    public $lawsuiteNumbers;
    public function __construct(LawsuiteNumberRepositoryInterface $lawsuiteNumbers) {
        $this->lawsuiteNumbers = $lawsuiteNumbers;
        $this->middleware('permission:lawsuiteNumbers_create', ['only' => ['store']]);
        $this->middleware('permission:lawsuiteNumbers_edit', ['only' => ['update']]);
        $this->middleware('permission:lawsuiteNumbers_delete', ['only' => ['destroy']]);
    }

    public function store(LawsuiteNumberRequest $request)
    {
        return $this->lawsuiteNumbers->store($request);
    }

    public function update(LawsuiteNumberRequest $request, LawsuiteNumber $lawsuites_number)
    {
        return $this->lawsuiteNumbers->update($request, $lawsuites_number);
    }

    public function destroy(LawsuiteNumber $lawsuites_number)
    {
        return $this->lawsuiteNumbers->destroy($lawsuites_number);
    }
}
