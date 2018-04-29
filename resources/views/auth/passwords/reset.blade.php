@extends('layouts.master2') 

@section('content')
    <h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
    <p class="main-title main-title-sub text-center">Reset Password</p>
    <div class="mt-1">
        <div class="box box-sm bg-main-light text-main-dark">
            <div class="box-hdr text-center">Sign-Up</div>
            <div class="box-bdy">

                {{--  @if(session('status'))
                    <div class="alerty alerty-primary alert-fade">
                        <ul>
                            <li>{{ session('status') }}</li>
                        </ul>
                    </div>
                @endif  --}}

                <form method="post" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <label class="inpt-lbl text-left" for="email">E-mail:</label>
                    <input type="email" class="inpt text-main-dark" name="email" id="email" required value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <div class="inpt-help text-right small text-main-red">
                            {{ $errors->first('email') }}
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

                    <button type="submit" class="main-btn main-btn-dark w-100">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

@endsection