@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-20">{{ $survey->title }}</h1>

<div class="mt-3">
    <div class="box box-md text-main-light">
        <div class="box-bdy">
            <p class="main-title main-title-sub text-center">{{ $survey->description }}</p>
            
            <p class="main-title main-title-sub text-center mt-4">By: {{ $survey->user->name }}</p>

            <div class="flex flex-around" style="margin-top: 25px;">
                <button class="main-btn main-btn-light-dark w-40" onclick="location.assign('{{ url("surveys/$survey->id/questions/1") }}')">Start</button>
                {{--  <button class="main-btn main-btn-light-dark w-40" onclick="location.assign('{{ url("surveys/$survey->id/questions/1") }}')">Start</button>  --}}
            </div>
        </div>
        <div class="box-ftr text-right"></div>
    </div>
</div>

@endsection