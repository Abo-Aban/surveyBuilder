@extends('layouts.master') 

@section('content')

<div class="content">

    @include('inc.messages')

    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">Surveys</div>
        <div class="content-hdr-options">
            {{--  @if(!Auth::user()->role == 'admin')  --}}
                <button type="button" class="btn btn-light" title="Add Survey" onclick="location.assign('{{ route('surveys.create') }}')"><span class="oma-plus"></span></button>
            {{--  @endif  --}}
            
            <button type="button" class="btn btn-light" id="show_search_bar" title="Search"><span class="oma-search"></span></button>
            <!-- Settings dropdown menu -->
            <div class="dropdown settings-dropdown">
                <button type="button" class="btn btn-light" data-toggle="dropdown" title="Settings"><span class="oma-settings"></span></button>
                <div class="dropdown-menu dropdown-menu-right" id="stng">
                    {{--  <button type="button" class="dropdown-item" id="show_share_btn"><span class="oma-share-alt text-right"></span> Share Survey</button>  --}}
                    <button type="button" class="dropdown-item" id="show_delete_btn"><span class="oma-trash text-right"></span> Delete Survey</button>
                    <button type="button" class="dropdown-item" id="show_edit_btn"><span class="oma-check-square-o text-right"></span> Edit Survey</button>
                    <!-- <button type="button" class="dropdown-item"><span class="oma-edit"></span> Edit Survey</button> -->
                </div>
            </div>
            <button type="button" class="btn btn-light" title="Dashboard" id="home_btn"><span class="oma-home"></span></button>
        </div>

    </div>


    <div class="content-bdy">
        <!-- Search Bar  -->
        <div class="search-bar px-4" id="search_bar" style="display: none">
            <div class="inpt-group">
                <span class="inpt-icon" id="search_btn"><span class="oma-search"></span></span>
                <input class="inpt text-main-dark pl-4" placeholder="Search Survey Name">
            </div>
        </div>
        <div class="content-bdy-container flex flex-center" id="surveys_container">

            {{--  List the Surveys For the Current User  --}}

            @if($surveys->count < 1)
                <h3 class="title text-main-dark pt-3">{{"There Are No Surveys Here Yet."}}</h3>
            @else   
                @foreach($surveys as $survey)
                <div class="main-card" data-survey-id="{{ $survey->id }}" data-sealed="{{ $survey->sealed }}" onclick="location.assign('/surveys/{{ $survey->id }}')">
                    <div class="main-card-bdy bg-main-dark text-main-light"><span class="img-survey-alt"></span></div>
                    <div class="main-card-title bg-main-light-dark text-main-light">{{ $survey->title }}</div>
                </div>
                @endforeach
            @endif

            {{--  DELETE SURVEY FORM  --}}
            <form method="post" action="" id="survey_del_form">{{ csrf_field() }} {{ method_field('DELETE') }} </form>
                
        </div>

        {{--  show pagination links only if the surveys wrap to another page  --}}
        @if(!$surveys->count < 20)
            <div class="flex flex-center">{{ $surveys->links() }}</div>
        @endif
        

    </div>
</div>

@endsection

{{--  Custom Page Script  --}}
@section('scripts')
<script src=" {{ asset('js/surveys.js') }} "></script>
@endsection