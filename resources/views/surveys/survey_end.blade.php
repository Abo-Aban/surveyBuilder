@extends('layouts.master2')

@section('content')

<h1 class="main-title main-title-main text-center mt-30">{{ $survey->title }}</h1>

<div style="margin-top: 1vh;">
    <div class="box box-lg text-main-light">
        <div class="box-bdy">
            <p class="main-title main-title-sub text-center">Completed Successfully, Thank You For Your Time.</p>
            
            <p class="main-title main-title-sub text-center mt-5">
                created by: <a href="\" class="text-main-light">SurveyBuilder</a> Web App.<br>
                <span class="oma-facebook-square main-icon"></span> <span class="oma-github-square main-icon"></span> <span class="oma-twitter-square main-icon"></span> 
            </p>

        </div>
        <div class="box-ftr text-right"></div>
    </div>
</div>

@endsection