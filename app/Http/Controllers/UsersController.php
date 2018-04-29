<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    
    public function index(){
        if(Auth::user()->role != 'admin'){
            return redirect()->route('home')->with('error', 'You Are Not Authorized To View This Page.');
        }
        $users = User::latest()->where('role', '<>', 'admin')->paginate(15);
        return view('users.index', compact('users'));
    }

    public function destroy($id){
        $user = User::find($id);
        //$user->surveys()->detach();
        $user->delete();

        return redirect('/users')->with('status', 'User Deleted Successfuly.');
    }





    // create admin user with credentials of (admin, 123456)
    public function init(){
        // check if the admin account has been created or not

        if(User::where('name', 'admin')->count() > 0){
            // already exists
            return redirect()->route('login')->with('error', 'Admin Account Already Exists.');
        }else{
            $user = new User();
            $user->name = 'admin';
            $user->password = Hash::make('123456');
            $user->email = "admin@admin.com";
            $user->role = "admin";

            $user->save();

            return redirect("/profile/$user->id");
        }

    }

}
