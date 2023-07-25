<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class DataController extends Controller
{
    public function index()
    {
        $data = FormData::all();
        return view('data.index', compact('data'));
    }
}
