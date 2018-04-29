<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;  
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(count($user) <= 0){
            return redirect()->back()->with('error', 'Invalid Profile.');
        }

        //get the total no of participations on user's surveys
        

        return view('profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // return $request;
        if(Auth::user()->id == $user->id){
            // validate the request data
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                // 'profile_img' => 'image|nullable|max:1999',
            ]);

            
            // check on password only if one of pass fields is present
            if($request->filled('old_password') || $request->filled('password') || $request->filled('password_confirmation')){
                $this->validate($request, [
                    'old_password' => "required|string|min:6",
                    'password' => 'required|string|min:6|confirmed',
                ]);
                $cur_pass = $user->password;
                $old_pass = $request->input('old_password');
                //chek the current password 
                if(!Hash::check($old_pass, $cur_pass)){
                    return redirect("/profile/$user->id")->with('error', "Old Password Doesn't Match The Current Passowrd.");
                }

                $user->password = Hash::make($request->input('password'));
            }
            

            // return (($request->hasFile('profile_img'))?'true':'false');

            /* ================Profile Image================== */
            if($request->hasFile('profile_img')){
                $fileNameWithExt = $request->file('profile_img')->getClientOriginalName();
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $ext = $request->file('profile_img')->getClientOriginalExtension();
                $profileImageNameToStore = $filename.'_'.time().'.'.$ext;
                // save the profile iamge
                $path = $request->file('profile_img')->storeAs('public/img', $profileImageNameToStore);

            }else{
                $profileImageNameToStore = $user->profile_img;
            }

            /* =============================================== */
            
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->profile_img = $profileImageNameToStore;
            $user->save();

            return redirect("/profile/$user->id")->with('success', 'Changes Has Been Saved Successfully.');

        }else{
            return redirect("/profile/$user->id")->with('error', "You Don't Have Permissions To Modify This Profile.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if the logged user isn't admin
        if(Auth::user()->role != 'admin' && Auth::user()->id != $id){
            return redirect( "/profile/".Auth::user()->id )->with('error', "You Don't Have Permissions To Modify This Profile.");
        }

        //delete the actual profile image if it's not the defualt
        if($user->profile_img !== 'profile.png'){
            Storage::delete('profile/img/' . $user->profile_img);
        }

        $user = User::find($id)->delete();
        if(Auth::user()->role == 'admin'){
            return redirect("/")->with('success', "Profile Deleted Successfully.");
        } else{
            return redirect()->route('login')->with('success', "Profile Deleted Successfully.");
        }
    }
}
