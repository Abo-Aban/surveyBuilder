@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
<p class="main-title main-title-sub text-center">Reset Your password</p>
<div class="mt-1">
    <div class="box box-sm bg-main-light text-main-dark">
        <div class="box-hdr text-center">Password Reset</div>
        <div class="box-bdy">
            @if(session('status'))
                <div class="alerty alerty-primary alerty-fade">
                    <ul>
                        <li>{{ session('status') }}</li>
                    </ul>
                </div>
            @endif


            <form method="post" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <label class="inpt-lbl text-left" for="email">E-mail:</label>
                <input type="email" class="inpt text-main-dark" name="email" id="email" required>
                @if($errors->has('email'))
                    <div class="inpt-help text-right small text-main-red">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <button type="submit" class="main-btn main-btn-dark w-100">Send</button>
            </form>
        </div>
    </div>
</div>

@endsection


{{--  
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>
    
                    <div class="panel-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
    
                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}