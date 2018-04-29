@extends('layouts.master2')

@section('content')

    <h1 class="main-title main-title-main text-center mt-5">Survey Builder</h1>
    <p class="main-title main-title-sub text-center">{{ $quest->survey->title }}</p>

    <div class="mt-2">
        <div class="box box-lg bg-main-light text-main-dark">
            <div class="box-hdr">
                <span class="quest-title">Question {{ $quest->alpha_num.' ('.$quest->num.'):' }}</span>
                <input type="hidden" name="question_type" id="question_type" value="{{ $quest->question_type }}">
            </div>
            <div class="box-bdy">

                @include('inc.messages')

                <div class="bg-main-white ques-text" id="ques_stmnt">
                    <div class="inpt text-main-dark mb-0">{{ $quest->question }}</div>
                </div>
                <p class="m-0"><small class="ques-type-stmnt pl-2">
                    @if($quest->question_type == 'mcq') <span class="mr-1 oma-checkbox-checked"></span> Please Choose One Or More
                    @else <span class="mr-1 oma-radio-checked"></span> Please Choose One
                    @endif Of The Following.
                </small></p>
                <form method="post" action="/partici/{{ $quest->survey_id }}/{{ $quest->id }}">{{ csrf_field()}}
                <input name="qid" value="{{$quest->qid}}" type="hidden">
                    
                <div id="alters">
                    @for($i = 1; $i <= $quest->alters_count; ++$i)
                        <div class="ques-chk">
                            <label class="inpt-lbl chk">
                                <div class="bg-main-white ques-alter">{{ $quest->alters[$i-1] }}</div>
                                @if($quest->question_type == 'mcq') <input type="checkbox" name="alter_{{$i}}" value="{{$i}}">
                                @else <input type="radio" name="alter_1" value="{{$i}}">
                                @endif
                                <span class="chk-mrk"></span>
                            </label>
                        </div>
                    @endfor
                </div>

            </div>
            <div class="box-ftr text-center">
                {{--  <button class="main-btn main-btn-dark" id="back_survey" onclick="location.assign('{{ url('/surveys/'.$quest->survey_id) }}')">Back</button>  --}}
                {{--  <button class="main-btn main-btn-dark" id="save_survey" disabled>Save</button>  --}}
                {{--  <button type="button" class="main-btn main-btn-dark" {{ ($quest->isFirst)?'disabled':'' }} onclick="location.assign('{{ url('/surveys/'.$quest->survey_id.'/questions/'.($quest->num-1)) }}')">Previous Question  --}}
                    
                </button>
                @if(!$quest->isLast)
                    <button type="submit" name="next_btn" id="next_btn" class="main-btn main-btn-dark" onclick="location.assign('{{ url('/surveys/'.$quest->survey_id.'/questions/'.($quest->num+1)) }}')">Next Question
                    </button>
                @else
                    <button type="submit" name="next_btn" id="next_btn" class="main-btn main-btn-dark" onclick="location.assign('{{ url('/surveys/'.$quest->survey_id.'/end') }}')">Finish Survey</button>
                @endif
            </div>
        </form>
        </div>
    </div>



@endsection


{{--  Custom Page Scripts  --}}
@section('scripts')
    <script src="{{ asset('js/question.js') }}"></script>
@endsection