@extends('layouts.master2')
@section('content')

    <h1 class="main-title main-title-main text-center mt-5">Survey Builder</h1>
    <p class="main-title main-title-sub text-center">{{ $survey->title }}</p>
    <form method="post" action="/surveys/{{$survey->id}}/questions" id="quest_form">
        <div class="mt-2">
            <div class="box box-lg bg-main-light text-main-dark">
                <div class="box-hdr">
                    <span class="quest-title">Question {!! $survey->new_alpha_num.' ('.$survey->new_num.') <small>[new]</small>:' !!}</span>
                    <span class="quest-type float-right">
                        <span class="alters-span">
                            <span class="lead">No of Alternatives:</span>
                            <select class="lead text-main-dark" name="alters_count" id="no_of_alters">
                                @for($i = 2; $i <= 5; ++$i)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </span>
                        
                        <span class="type-span">
                            <span class="lead">Type:</span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-sm text-main-dark quest-type-btn active"  data-question-type="mcq" title="Multiple Choice Question"><span class="oma-checkbox-checked"></span></button>
                                <button type="button" class="btn btn-light btn-sm text-main-dark quest-type-btn"  data-question-type="scq" title="One Choise Question"><span class="oma-radio-checked"></span></button>
                                <input type="hidden" name="question_type" id="question_type" value="mcq">
                            </div>
                        </span>
                    </span>
                </div>
                <div class="box-bdy">

                    @include('inc.messages')

                    <div class="bg-main-white ques-text">
                        <textarea class="inpt text-main-dark mb-0 v-growable" name="question">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat ad quae ex! Alias culpa velit ullam? Dolore, repellat modi? Porro quod distinctio nisi quas impedit autem reiciendis neque mollitia iusto?</textarea>
                    </div>

                    <div id="alters">
                        @for($i = 1; $i <= 2; ++$i)
                            <div class="inpt-lbl w-100">
                                <div class="bg-main-white ques-alter p-0 m-0 mt-2"><input type="text" name="alter_{{ $i }}" class="inpt px-3 text-main-dark" placeholder="Alternative"></div>
                            </div>
                        @endfor
                    </div>

            </div>
                
            <div class="box-ftr text-center">
                <button type="button" class="main-btn main-btn-dark" id="back_survey" onclick="location.assign('{{ url('/surveys/'.$survey->id) }}')">Finish</button>
                <button type="submit" class="main-btn main-btn-dark" id="save_survey" >Save</button>
                <button type="button" class="main-btn main-btn-dark" {{ ($survey->new_num == 1)?'disabled':'' }} onclick="location.assign('{{ url('/surveys/'.$survey->id.'/questions/'.($survey->new_num-1).'/edit') }}')">Previous</button>
                {{--  <button type="button" class="main-btn main-btn-dark" onclick="location.assign('{{ url('/surveys/'.$survey->id.'/questions') }}')">New Question</button>  --}}
            </div>
                
        </div>
    </div>
    {{ csrf_field() }}
    </form>



@endsection


{{--  Custom Page Scripts  --}}
@section('scripts')
    <script src="{{ asset('js/jquery.ns-autogrow.min.js') }}"></script>
    <script src="{{ asset('js/new_question.js') }}"></script>
@endsection