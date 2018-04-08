@extends('layouts.master')


@section('content')

<div class="content">
    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">Dashboard</div>
        <div class="content-hdr-options">
            <button type="button" class="btn btn-light"><span class="oma-gears"></span></button>
            <button type="button" class="btn btn-light">B</button>
            <button type="button" class="btn btn-light">C</button>
        </div>
    </div>
    <div class="content-bdy">
        <!-- <div class="alerty alerty-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, corporis reprehenderit? Optio nostrum architecto reprehenderit autem ratione itaque quas magni, adipisci sed, vel recusandae iste aut dolores necessitatibus voluptatum veniam?</div> -->
        <div class="content-bdy-container flex flex-start">
            <div class="main-card" onclick="location.assign('{{ route('login') }}')">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-bug2"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Surveys</div>
            </div>

            <div class="main-card" onclick="location.assign('{{ route('login') }}')">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-user"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Users</div>
            </div>

            <div class="main-card" onclick="location.assign('{{ route('login') }}')">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-pie-chart2"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Statistics</div>
            </div>

            <div class="main-card" onclick="location.assign('{{ route('login') }}')">
                <div class="main-card-bdy bg-main-dark text-main-light"><span class="oma-gear"></span></div>
                <div class="main-card-title bg-main-light-dark text-main-light">Settings</div>
            </div>

        </div>

    </div>
</div>

@endsection