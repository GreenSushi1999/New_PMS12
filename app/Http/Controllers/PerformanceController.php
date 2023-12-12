<?php

namespace App\Http\Controllers;

use App\document;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {

        return view('pages.index');
    }
}
