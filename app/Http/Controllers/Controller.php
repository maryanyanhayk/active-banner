<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $rpp;
    public $page;

    public function __construct()
    {
        $request = Request::instance();
        $this->rpp = empty($request->input('rpp')) ? env('RPP') : $request->input('rpp');
        $this->page = empty($request->input('rpp')) ? 1 : $request->input('page');
    }
}
