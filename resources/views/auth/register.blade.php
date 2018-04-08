@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
<p class="main-title main-title-sub text-center">Sign-Up to start making surveys</p>

<div class="mt-1">
    <div class="box box-sm bg-main-light text-main-dark">
        <div class="box-hdr text-center">Sign-Up</div>
        <div class="box-bdy">
            {{--  @if($errors->any())
                <span class="text-main-red ">** Invalid Username or Password</span>
            @endif  --}}
            
            <form method="post" action="{{ route('register') }}">
                {{ csrf_field() }}
                <label class="inpt-lbl text-left" for="name">Username:</label>
                <input type="text" class="inpt text-main-dark" name="name" id="name" required value="{{ old('name') }}">
                @if($errors->has('name'))
                    <div class="inpt-help text-right small text-main-red">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <label class="inpt-lbl text-left" for="password">Password:</label>
                <input type="password" class="inpt text-main-dark" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="inpt-help text-right small text-main-red">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <label class="inpt-lbl text-left" for="password2">Confirm Password:</label>
                <div class="inpt-group">
                    <div class="inpt-icon" title="Passwords Match" style="display: none;"><span class="oma-done_all text-main-dark"></span></div>
                    <input type="password" class="inpt text-main-dark" name="password_confirmation" id="password2" required>
                </div>
                

                <label class="inpt-lbl text-left" for="email">E-mail:</label>
                <input type="email" class="inpt text-main-dark" name="email" id="email" required value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="inpt-help text-right small text-main-red">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <button type="submit" class="main-btn main-btn-dark w-100">Sign Up</button>
            </form>
        </div>
        <div class="box-ftr text-right"><small>already registered <a href="{{ route('login') }}">Login</a> Now.</small></div>
    </div>
</div>

@endsection

{{--  
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
    
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
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
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}