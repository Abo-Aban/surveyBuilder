@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
<p class="main-title main-title-sub text-center">login to continue</p>

<div class="mt-1">
    <div class="box box-sm bg-main-light text-main-dark">
        <div class="box-hdr text-center">Login</div>
        <div class="box-bdy">
            
            @include('inc.messages')

            <form method="post" action="{{ route('login')}}">
                {{ csrf_field() }}
                <label class="inpt-lbl text-left" for="name">Username:</label>
                <input type="text" class="inpt text-main-dark" name="name" value="{{ old('name') }}" required id="name">
                <label class="inpt-lbl text-left" for="pass">Password:</label>
                <input type="password" class="inpt text-main-dark" name="password" required  id="password">
                <label class="inpt-lbl chk"> Remember Me
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="chk-mrk"></span>
                </label>
                <button type="submit" name="submit" class="main-btn main-btn-dark w-100">Login</button>
            </form>
        </div>
        <div class="box-ftr text-right"><small><a href="{{ route('password.request') }}">Forgot Your password</a>. or <a href="{{ route('register') }}">Sign-up</a></small></div>
    </div>
</div>

@endsection