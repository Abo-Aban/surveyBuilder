<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    
    public function dashboard(){
        return view('dahsboard');
    }


    

    public function users(){
        return view('users');        
    }



}
