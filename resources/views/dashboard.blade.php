@extends('layouts.master')

@section('content')

<div class="content">
    @include('inc.messages')
    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">Dashboard</div>
        <div class="content-hdr-options">
            {{--  <button type="button" class="btn btn-light"><span class="oma-settings"></span></button>  --}}
        </div>
    </div>
    <div class="content-bdy">
        
        <div class="content-bdy-container flex flex-center">
            <div class="main-card" onclick="location.assign('{{ route('surveys.index') }}')">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="img-survey-alt"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Surveys</div>
            </div>
            
            <div class="main-card" onclick="location.assign('{{ route('surveys.statistics') }}')">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-pie-chart2"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Statistics</div>
            </div>
            
            @if(Auth::user()->role == 'admin')
                <div class="main-card" onclick="location.assign('{{ route('users') }}')">
                    <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-group"></span></div>
                    <div class="main-card-title bg-main-light-dark text-main-light">Users</div>
                </div>
                
                {{--  <div class="main-card" onclick="location.assign('{{ route('login') }}')">
                    <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-settings"></span></div>
                    <div class="main-card-title bg-main-light-dark text-main-light">Settings</div>
                </div>  --}}
            @endif

        </div>

    </div>
</div>

@endsection