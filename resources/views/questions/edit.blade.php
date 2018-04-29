@extends('layouts.master2')
@section('content')

    <h1 class="main-title main-title-main text-center mt-5">Survey Builder</h1>
    <p class="main-title main-title-sub text-center">{{ $quest->survey->title }}</p>
    <form method="post" action="/surveys/{{$quest->survey_id}}/questions/{{$quest->id}}" id="quest_form">
        <input name="qid" value="{{$quest->qid}}" type="hidden">
        <div class="mt-2">
            <div class="box box-lg bg-main-light text-main-dark">
                <div class="box-hdr">
                    <span class="quest-title">Question {{ $quest->alpha_num.' ('.$quest->num.'):' }}</span>
                    <span class="quest-type float-right">
                        <span class="alters-span">
                            <span class="lead">No of Alternatives:</span>
                            <select class="lead text-main-dark" name="alters_count" id="no_of_alters">
                                @for($i = 2; $i <= 5; ++$i)
                                    <option value="{{ $i }}" {{ ($i == $quest->alters_count)? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </span>
                        
                        <span class="type-span">
                            <span class="lead">Type:</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-sm text-main-dark quest-type-btn {{ ($quest->question_type == 'mcq')?'active':'' }}" data-question-type="mcq" title="Multiple Choice Question"><span class="oma-checkbox-checked"></span></button>
                                <button type="button" class="btn btn-light btn-sm text-main-dark quest-type-btn {{ ($quest->question_type == 'scq')?'active':'' }}" data-question-type="scq" title="One Choise Question"><span class="oma-radio-checked"></span></button>
                                <input type="hidden" name="question_type" id="question_type" value="{{ $quest->question_type }}">
                            </div>
                        </span>
                    </span>
                </div>
                <div class="box-bdy">

                    @include('inc.messages')

                    <div class="bg-main-white ques-text">
                        <textarea class="inpt text-main-dark mb-0 v-growable" name="question">{{ $quest->question }}</textarea>
                    </div>

                    <div id="alters">
                        @for($i = 1; $i <= $quest->alters_count; ++$i)
                            <div class="inpt-lbl w-100">
                                <div class="bg-main-white ques-alter p-0 m-0 mt-2"><input type="text" name="alter_{{ $i }}" class="inpt px-3 text-main-dark" placeholder="Alternative" value="{{ $quest->alters[$i-1] }}"></div>
                            </div>
                        @endfor
                    </div>

                </div>
                <div class="box-ftr text-center">
                    <button type="button" class="main-btn main-btn-dark" id="back_survey" onclick="location.assign('{{ url('/surveys/'.$quest->survey_id) }}')">Back</button>
                    <button type="submit" class="main-btn main-btn-dark" id="save_survey" >Save</button>
                    <button type="button" class="main-btn main-btn-dark" {{ ($quest->isFirst)?'disabled':'' }} onclick="location.assign('{{ url('/surveys/'.$quest->survey_id.'/questions/'.($quest->num-1).'/edit') }}')">Previous</button>
                    @if(!$quest->isLast)
                        <button type="button" class="main-btn main-btn-dark" onclick="location.assign('{{ url('/surveys/'.$quest->survey_id.'/questions/'.($quest->num+1).'/edit') }}')">Next</button>
                    @else
                        <button type="button" class="main-btn main-btn-dark" onclick="location.assign('{{ url('/surveys/'.$quest->survey_id.'/questions/') }}')">New</button>
                    @endif
                </div>
            </div>
        </div>
        {{ method_field('put') }}
        {{ csrf_field() }}
    </form>



@endsection

{{--  Custom Page Scripts  --}}
@section('scripts')
    <script src="{{ asset('js/jquery.ns-autogrow.min.js') }}"></script>
    <script src="{{ asset('js/new_question.js') }}"></script>
@endsection