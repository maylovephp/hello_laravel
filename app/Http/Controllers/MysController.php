<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MysController extends Controller
{
    public function index(){
        return view('my_home')->with('name','^启正^');
    }
}
