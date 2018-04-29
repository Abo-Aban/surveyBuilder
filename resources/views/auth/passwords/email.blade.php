@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
<p class="main-title main-title-sub text-center">Reset Your password</p>
<div class="mt-1">
    <div class="box box-sm bg-main-light text-main-dark">
        <div class="box-hdr text-center">Password Reset</div>
        <div class="box-bdy">
            
            @include('inc.messages')

            <form method="post" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <label class="inpt-lbl text-left" for="email">E-mail:</label>
                <input type="email" class="inpt text-main-dark" name="email" id="email" required>
                {{--  @if($errors->has('email'))
                    <div class="inpt-help text-right small text-main-red">
                        {{ $errors->first('email') }}
                    </div>
                @endif  --}}
                <button type="submit" class="main-btn main-btn-dark w-100">Send</button>
            </form>
        </div>
    </div>
</div>

@endsection