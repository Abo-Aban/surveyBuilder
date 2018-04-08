<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function dashboard(){
        return view('/dahsboard');
    }


    public function profile(){
        return view('profile');
    }



}
