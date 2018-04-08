@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
<p class="main-title main-title-sub text-center">login to continue</p>

<div class="mt-1">
    <div class="box box-sm bg-main-light text-main-dark">
        <div class="box-hdr text-center">Login</div>
        <div class="box-bdy">
            @if($errors->any())
            <div class="alerty alerty-danger alerty-fade">
                <ul>
                    <li>Invalid Credintials</li>
                </ul>
            </div>
            @endif
            <form method="post" action="{{ route('login')}}">
                {{ csrf_field() }}
                <label class="inpt-lbl text-left" for="name">Username:</label>
                <input type="text" class="inpt text-main-dark" name="name" value="{{ old('name') }}" required id="name">
                <label class="inpt-lbl text-left" for="pass">Password:</label>
                <input type="password" class="inpt text-main-dark" name="password"required  id="password">
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


{{--  

{{ $errors->any() ? 'inpt-invalid' : '' }} {{ $errors->any() ? 'inpt-invalid' : '' }}

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
    
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}