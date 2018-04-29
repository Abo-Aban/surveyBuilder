{{--  override the background color  --}}
<style>
    body {
        background-color: #E2E8ED!important;
    }
</style>
<div class="top-nav bg-main-dark fixed-top">
    <div class="top-nav-title text-main-light cur-ptr" onclick="location.assign('{{ route('home') }}')">
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
                <img src="/storage/img/{{ Auth::user()->profile_img }}" class="float-left" style="border: 1px solid #FFFFFFAA" >
                <div class="logged-user float-left">{{ substr(Auth::user()->name, 0, min(12, (strpos(Auth::user()->name, ' ') !== false ) ?strpos(Auth::user()->name, ' '):12)) }}</div>
                <div class="caret float-left">
                    <span class="oma-caret-down"></span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-item" onclick="location.assign('/profile/{{ Auth::user()->id }}')"><span class="oma-id-card-o"></span> Profile</div>
                <div class="dropdown-item" onclick="$('#logout_form').submit()"><span class="oma-log-out"></span> Logout</div>
                <form method="post" action="{{route('logout')}}" id="logout_form">{{csrf_field()}}</form>
            </div>
        </div>
    @endauth
</div>