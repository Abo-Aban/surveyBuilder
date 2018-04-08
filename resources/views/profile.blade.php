@extends('layouts.master')

@section('content')

<div class="content">
    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">Username - Profile</div>
        <div class="content-hdr-options">
            <button type="button" class="btn btn-light"><span class="oma-gears"></span></button>
            <button type="button" class="btn btn-light"><span class="oma-close"></span> Disable Acoount</button>
            <button type="button" class="btn btn-light"><span class="oma-home"></span></button>
        </div>
    </div>
    <div class="content-bdy">
        <!-- <div class="alerty alerty-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, corporis reprehenderit? Optio nostrum architecto reprehenderit autem ratione itaque quas magni, adipisci sed, vel recusandae iste aut dolores necessitatibus voluptatum veniam?</div> -->
        <div class="content-bdy-container">
            <div class="profile-img-container">
                <label class="profile-img-overlay">Change Profile Image<input id="p-img" name="p-img" type="file"></label>
                <img class="profile-img" id="profile-img" src="storage/img/profile.png"> 

            </div>

            <div class="profile-data py-4 pl-4">
                <label class="inpt-lbl text-main-dark text-left" for="name">Username:</label>
                <div class="inpt-group">
                    <input type="text" class="inpt text-main-dark" name="name" id="name">
                    <!-- <div class="inpt-icon"><span class="oma-edit"></span></div> -->
                </div>

                <label class="inpt-lbl text-main-dark text-left" for="email">E-mail:</label>
                <div class="inpt-group">
                    <input type="email" class="inpt text-main-dark" name="email" id="email">
                    <!-- <div class="inpt-icon"><span class="oma-edit"></span></div> -->
                </div>

                <div class="row text-main-dark mt-1" id="change_pass_container">
                    <div class="col">
                        <label class="inpt-lbl text-main-dark text-left" for="old_pass">Old Password:</label>
                        <input type="password" class="inpt text-main-dark" name="old_pass" id="old_pass">
                    </div>
                    <div class="col">
                        <label class="inpt-lbl text-main-dark text-left" for="pass1">New Password:</label>
                        <input type="password" class="inpt text-main-dark" name="pass1" id="pass1">
                    </div>
                    <div class="col">
                        <label class="inpt-lbl text-main-dark text-left" for="pass2">Confirm Password:</label>
                        <div class="inpt-group">
                            <div class="inpt-icon" title="Passwords Match" style="display: none;" ><span class="oma-done_all text-main-green"></span></div>
                            <input type="password" class="inpt text-main-dark" name="pass2" id="pass2">
                        </div>

                    </div>
                </div>

                <div class="text-center">
                    <button class="main-btn main-btn-dark mt-3 px-5" disabled id="save_changes">Save Changes</button>
                    <!-- <button class="main-btn main-btn-dark mt-3 px-5" id="show_change_pass_btn">Change Password</button> -->
                    <!-- <button class="main-btn main-btn-dark w-40 mt-3 px-5" id="hide_change_pass_btn" style="display: none">Cancel</button>
                    <button class="main-btn main-btn-dark w-40 mt-3 px-5" id="change_pass_btn" style="display: none">Change</button> -->
                </div>


            </div>

            <div class="profile-statistics mt-4 py-1">
                <table class="table table-sm mb-1">
                    <tr>
                        <td>Registered Since:</td>
                        <td>28/2/2018</td>
                    </tr>

                    <tr>
                        <td>No of Created Surveys:</td>
                        <td>28</td>
                    </tr>
                    
                    <tr>
                        <td>Users Participated in the Surveys:</td>
                        <td>128</td>
                    </tr>

                    <tr>
                        <td>Most Recent Survey:</td>
                        <td>Kangaroo on his way out</td>
                    </tr>
                </table>
            </div>            

            <!-- <div class="main-card">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-bug2"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Surveys</div>
            </div>

            <div class="main-card">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-bug2"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Surveys</div>
            </div> -->

            

        </div>

    </div>
</div>

@endsection

{{--  Page Custom Scripts  --}}
@section('scripts')

<script src="{{ asset('js/profile.js') }}"></script>

@endsection