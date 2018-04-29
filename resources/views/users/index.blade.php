@extends('layouts.master')

@section('content')

<div class="content">
    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">Users</div>
        <div class="content-hdr-options">
            {{--  <button type="button" class="btn btn-light" title="Settings"><span class="oma-settings"></span></button>  --}}
            <button type="button" class="btn btn-light" id="show_search_bar" title="Search"><span class="oma-search"></span></button>
            <button type="button" class="btn btn-light" id="sort_btn" title="Sort" data-sort="desc"><span class="oma-sort-alpha-asc"></span></button>
            <button type="button" class="btn btn-light" title="Dashboard" id="home_btn"><span class="oma-home"></span></button>
        </div>
    </div>
    <div class="content-bdy">
        <!-- Search Bar  -->
        <div class="search-bar mb-3" id="search_bar" style="display: none">
            <div class="inpt-group">
                <span class="inpt-icon" id="search_btn"><span class="oma-search"></span></span>
                <input class="inpt text-main-dark pl-4" placeholder="Search Survey Name">
            </div>
        </div>

            {{--  DELETE SURVEY FORM  --}}
            <form method="post" action="" id="user_del_form">{{ csrf_field() }} {{ method_field('DELETE') }} </form>
        

        <div class="content-bdy-container flex flex-center" id="users_container">
            @foreach($users as $user)
                <div class="main-list bg-main-white" data-user-id="{{ $user->id }}" onclick="location.assign('{{ url('profile/'.$user->id) }}')">
                    <div class="main-list-icon text-main-dark"><span class="oma-user"></span></div><div class="main-list-sprtr"></div>
                    <div class="main-list-title text-main-dark">{{ $user->name }}</div>
                    <div class="main-list-options text-main-dark del_user_btn"><span class="oma-trash"></span></div>
                </div>
            @endforeach
            {{ $users->links() }}
            

        </div>

    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/users.js') }}"> </script>
@endsection