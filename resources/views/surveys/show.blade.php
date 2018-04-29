@extends('layouts.master') 

@section('content')

<div class="content">

    @include('inc.messages')

    {{--  <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg">
      Launch
    </button>  --}}
    
    <!-- Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
            </button>
                    <h4 class="modal-title text-main-dark" id="modelTitleId"><span class="oma-share-alt ml-3 mr-2"></span>Share Survey</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="text" class="inpt text-main-dark text-center" id="share_url" placeholder="Survey URL" value="{{ $shareURL }}">
                        {{--  <button class="main-btn main-btn-dark w-100" id="generate_qr">Generate QR Code</button>  --}}
                        <div id="share_url_qr" class="mt-2" style="margin-left: calc(50% - 100px)"></div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="main-btn main-btn-light-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">{{ $survey->title }} - Questions</div>
        <div class="content-hdr-options">
            <button type="button" class="btn btn-light" title="Add Question"  onclick="location.assign('{{ "/surveys/$survey->id/questions" }}')"><span class="oma-plus"></span></button>
            {{--  <button type="button" class="btn btn-light" title="Add Question" onclick="location.assign('/surveys/{{ $survey->id }}/questions/')"><span class="oma-plus"></span></button>  --}}
            
            {{--  hide if the survey has no questions  --}}
            @if($survey->questions->count() > 0)
                <button type="button" class="btn btn-light" title="Show" onclick="location.assign('{{ "/surveys/$survey->id/start" }}')"><span class="oma-eye"></span></button>
            @endif
            
            {{--  <button type="button" class="btn btn-light" id="show_search_bar" title="Search"><span class="oma-search"></span></button>  data-target="#shareModal"  --}}
            <!-- Settings dropdown menu -->
            <div class="dropdown settings-dropdown">
                <button type="button" class="btn btn-light" data-toggle="dropdown" title="Settings"><span class="oma-settings"></span></button>
                <div class="dropdown-menu dropdown-menu-right" id="stng2">
                    @if($survey->questions->count() > 0)
                        @if($survey->user_id != Auth::user()->id)
                        @elseif($survey->sealed == 'no')
                            <button type="button" class="dropdown-item" id="seal_btn" data-survey-id="{{ $survey->id }}" title="Seal Survey"><span class="oma-lock4 text-right"></span> Seal Survey</button>
                        @else
                            <button type="button" class="dropdown-item" id="share_btn" title="Share Survey" data-toggle="modal"><span class="oma-share-alt text-right"></span> Share Survey</button>
                        @endif
                    @endif
                    <button type="button" class="dropdown-item" id="delete_btn"><span class="oma-trash text-right"></span> Delete Survey</button>
                    @if($survey->questions->count() > 0 && $survey->sealed !== 'yes') <button type="button" class="dropdown-item" id="edit_btn" onclick="location.assign('/surveys/{{ $survey->id }}/questions/1/edit')"><span class="oma-check-square-o text-right"></span> Edit Survey</button> @endif
                    <form method="post" action="/surveys/{{ $survey->id }}" id="survey_del_form">{{ csrf_field() }} {{ method_field('DELETE') }} </form>
                </div>
            </div>
            <button type="button" class="btn btn-light" title="Dashboard" id="home_btn"><span class="oma-home"></span></button>
        </div>

    </div>


    <div class="content-bdy">
        
        <div class="content-bdy-container flex flex-center" id="questions_container">

            {{--  List the Surveys For the Current User  --}}
            <?php $qid = 1; ?>
            @if(count($survey->questions) < 1)
                <h3 class="title text-main-dark pt-3">{{"There Are No Questions Here Yet."}}</h3>
            @else   
                {{--  @foreach($survey->questions as $question)  --}}
                @for($qid = 0; $qid < count($survey->questions) ;++$qid)
                    <div class="bg-main-white text-main-dark w-100 mb-2 p-3 cur-ptr" data-question-id="{{ $survey->questions[$qid]->id }}" onclick="location.assign('{{ "/surveys/$survey->id/questions/" . ($qid+1) . '/edit' }}')">
                        <span class="quest-del-btn"><span class="oma-close"></span></span>
                        <div class="w-95">{{ $survey->questions[$qid]->question }}</div>
                    </div>
                @endfor
                {{--  @endforeach  --}}
            @endif

            {{--  DELETE QUESTION FORM  --}}
            <input type="hidden" value="/surveys/{{ $survey->id }}/questions/" id="del_path">
            <form method="post" action="" id="quest_del_form">{{ csrf_field() }} {{ method_field('DELETE') }} </form>            
                
        </div>

    </div>
</div>

@endsection

{{--  Custom Page Script  --}}
@section('scripts')
<script src=" {{ asset('js/qrcode.min.js') }} "></script>
<script src=" {{ asset('js/surveys.js') }} "></script>
@endsection