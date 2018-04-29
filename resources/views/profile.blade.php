@extends('layouts.master')

@section('content')

<div class="content">
    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">{{ $user->name }} - Profile</div>
        <div class="content-hdr-options">
            {{--  <button type="button" class="btn btn-light"><span class="oma-settings"></span></button>  --}}
            <form method="post" action="/profile/{{ $user->id }}" id="del_form">{{ csrf_field() }} {{ method_field('DELETE') }} </form>            
            <button type="button" class="btn btn-light" id="del_acc_btn" title="Delete Acoount" data-id="{{ $user->id }}" style="{{ (Auth::user()->role == 'user')?'2':'display:none' }}"><span class="oma-close"></span></button>
            <button type="button" class="btn btn-light" title="Dashboard" id="home_btn"><span class="oma-home"></span></button>
        </div>
    </div>
    <div class="content-bdy">

        @include('inc.messages')
        
        <div class="content-bdy-container">
            <form method="post" action="/profile/{{$user->id}}" id="profile_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="profile-img-container">
                    @if(Auth::user()->id == $user->id)    
                        <label class="profile-img-overlay">Change Profile Image<input id="p-img" name="profile_img" type="file"></label>
                    @endif
                    <img class="profile-img" id="profile-img" src="/storage/img/{{ $user->profile_img }}"> 
                </div>

                <div class="profile-data py-4 pl-4">
                    <label class="inpt-lbl text-main-dark text-left" for="name">Username:</label>
                    <div class="inpt-group">
                        <input type="text" class="inpt text-main-dark" name="name" id="name" value="{{ $user->name }}" {{ (Auth::user()->id != $user->id)?'readonly':'' }}>
                    </div>

                    <label class="inpt-lbl text-main-dark text-left" for="email">E-mail:</label>
                    <div class="inpt-group">
                        <input type="email" class="inpt text-main-dark" name="email" id="email" value="{{ $user->email }}" {{ (Auth::user()->id != $user->id)?'readonly':'' }}>
                    </div>

                    @if(Auth::user()->id == $user->id) 
                        <div class="row text-main-dark mt-1" id="change_pass_container">
                            <div class="col">
                                <label class="inpt-lbl text-main-dark text-left" for="old_password">Old Password:</label>
                                <input type="password" class="inpt text-main-dark" name="old_password" id="old_password">
                            </div>
                            <div class="col">
                                <label class="inpt-lbl text-main-dark text-left" for="password">New Password:</label>
                                <input type="password" class="inpt text-main-dark" name="password" id="password">
                            </div>
                            <div class="col">
                                <label class="inpt-lbl text-main-dark text-left" for="password2">Confirm Password:</label>
                                <div class="inpt-group">
                                    <div class="inpt-icon" title="Passwords Match" style="display: none;" ><span class="oma-done_all text-main-green"></span></div>
                                    <input type="password" class="inpt text-main-dark" name="password_confirmation" id="password2">
                                </div>

                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->id == $user->id) 
                        <div class="text-center">
                            <button type="button" class="main-btn main-btn-dark mt-3 px-5" disabled id="save_changes">Save Changes</button>
                        </div>
                    @endif


                </div>

                <div class="profile-statistics mt-4 py-1">
                    <table class="table table-sm mb-1">
                        <tr>
                            <td>Registered Since:</td>
                            <td>{{ $user->created_at->toFormattedDateString() }}</td>
                        </tr>

                        <tr>
                            <td>No of Created Surveys:</td>
                            <td>{{ $user->surveys->count() }}</td>
                        </tr>
                        
                        {{--  <tr>
                            <td>Users Participated in the Surveys:</td>
                            <td>{{ $user-> }}</td>
                        </tr>  --}}

                        <tr>
                            <td>Most Recent Survey:</td>
                            <td>
                                @if($user->surveys->count() !== 0)
                                    {{ $user->surveys->last()->title}}
                                @else
                                    {{ 'N/A' }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>            
            </form>

        </div>

    </div>
</div>

@endsection

{{--  Page Custom Scripts  --}}
@section('scripts')

<script src="{{ asset('js/profile.js') }}"></script>

@endsection