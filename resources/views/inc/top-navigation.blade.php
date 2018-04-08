{{--  override the background color  --}}
<style>
    body {
        background-color: #E2E8ED!important;
    }
</style>
<div class="top-nav bg-main-dark fixed-top">
    <div class="top-nav-title text-main-light">
        Survey Builder
    </div>
    @guest
        <div class="pr-3 float-right">
            <a class="lead text-main-light mr-2" href="{{ route('login') }}">Login</a>
            <a class="lead text-main-light" href="{{ route('register') }}">Sign-up</a>
        </div>
    @endguest
    @auth
        <div class="logged-info dropup logged-dropdown float-right">
            <div class="" data-toggle="dropdown">
                <img src="./storage/img/profile.png" class="float-left">
                <div class="logged-user float-left">{{ Auth::user()->name }}</div>
                <div class="caret float-left">
                    <span class="oma-caret-down"></span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-item" onclick="location.assign('{{ route('profile') }}')"><span class="oma-id-card-o"></span> Profile</div>
                <div class="dropdown-item" onclick="$('#logout_form').submit()"><span class="oma-log-out"></span> Logout</div>
                <form method="post" action="{{route('logout')}}" id="logout_form">{{csrf_field()}}</form>
            </div>
        </div>
    @endauth
</div>