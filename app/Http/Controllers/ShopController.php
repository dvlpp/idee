<?php

namespace Idee\Http\Controllers;

use Illuminate\Http\Request;

use Idee\Http\Requests;
use Idee\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop');
    }
}
