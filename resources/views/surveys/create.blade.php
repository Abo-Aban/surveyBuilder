@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-10">Survey Builder</h1>
<p class="main-title main-title-sub text-center">creating new survey</p>

<div class="mt-10">
    <div class="box box-md bg-main-light text-main-dark">
        <div class="box-hdr text-center">New Survey</div>
        <div class="box-bdy">

            @include('inc.messages')

            <form method="post" action="/surveys">
                {{ csrf_field() }} 
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">   
                <label class="inpt-lbl text-left" for="title">Survey Title:</label>
                <input type="text" class="inpt text-main-dark" name="title" id="title" value="{{ old('title') }}">
                <label class="inpt-lbl text-left" for="description">Survey Description:</label>
                <textarea class="inpt text-main-dark v-growable" name="description"  id="description">{{ old('description') }}</textarea>

                <div class="flex flex-around" style="margin-top: 10px;">
                    <button type="button" class="main-btn main-btn-dark w-40" onclick="location.assign('{{ route('home') }}')">Cancel</button>
                    <button type="submit" class="main-btn main-btn-dark w-40">Create</button>
                </div>
            </form>
        </div>
        <div class="box-ftr text-right"></div>
    </div>
</div>

@endsection

{{--  Custom Page Script  --}}
@section('scripts')
<script src="{{ asset('js/jquery.ns-autogrow.min.js') }}"></script>
@endsection
