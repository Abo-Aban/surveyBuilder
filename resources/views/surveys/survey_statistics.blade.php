@extends('layouts.master') 

@section('content')
{{--  prepare the colors array  --}}
@php
    $main_colors = array('red', 'orange', 'green', 'blue', 'purple');
@endphp

<div class="content">

    @include('inc.messages')

    <div class="content-hdr text-main-dark">
        <div class="content-hdr-title">{{ $survey->title }} - Statistics</div>
        <div class="content-hdr-options">
            
            <button type="button" class="btn btn-light" title="Dashboard" id="home_btn"><span class="oma-home"></span></button>
        </div>

    </div>


    <div class="content-bdy">
        
        <div class="content-bdy-container flex flex-center" id="questions_container">

            <div class="alerty alerty-primary mb-3">
                <ul class="m-0 pl-4">
                    <li class="main-text-title">Survey Created By: {{ $survey->created_by() }}.</li>
                    <li>Survey Created In: {{ $survey->created_at->toFormattedDateString() }}.</li>
                    <li>Survey has: {{ $survey->questions->count() }} Qeustions.</li>
                    <li>[ {{ $survey->count }} ] User{{ ($survey->count > 1)?'s':'' }} Perticipated In This Survey.</li>
                </ul>
            </div>
            @php $c = 0; @endphp
            @if(count($questions) < 1)
                <h3 class="title text-main-dark pt-3">{{"There Are No Questions Here Yet."}}</h3>
            @else
                @foreach($questions as $question)
                    <div class="bg-main-white text-main-dark w-100 mb-3 p-4 cur-ptr" data-question-id="{{ $question->id }}" onclick="location.assign('{{ "/surveys/$survey->id/questions/" . ($c+1) . '/edit' }}')">

                        <div class="h5">
                            Q{{++$c}}) {{ $question->question}}.
                        </div>

                        @for($i = 1; $i <= $question->alters_count; ++$i)
                            {{--  {{dd($question)}}  --}}
                            @php
                                $partici_count = $question->partici->count();
                                $alterPartici_count = $question->partici->where('alter', $i)->count();
                            @endphp
                            <div class="ques-statistics">
                                <div class="progress float-left">
                                    {{--  show Number of partici on hover  --}}
                                    <div class="ques-partici w-100 bg-main-rose text-main-white text-center ">{{ $alterPartici_count }} Participants</div>

                                    @if($partici_count > 0)
                                        {{--  calculate the percentage of alter  --}}
                                        @php $alterPercent = number_format((float)$alterPartici_count / $partici_count * 100, 0, '.', '') @endphp
                                        <div class="progress-bar bg-main-{{ $main_colors[$i-1] }}" style="width: {{ $alterPercent }}%;">{{ $alterPercent }}%</div>
                                    @endif

                                </div>
                                <span class="ques-statistics-text float-left pl-3">{{ $question['alter_' . ($i)] }}</span>
                                {{--  <span class="ques-statistics-text float-left pl-3">Alternative No One Alternative No One Alternative No One Alternative No OneAlternative No One Alterna</span>  --}}
                            </div>
                        @endfor
                    </div>
                @endforeach
            @endif
            
            
        </div>

    </div>
</div>

@endsection

{{--  Custom Page Script  --}}
@section('scripts')
<script src=" {{ asset('js/surveys.js') }} "></script>
@endsection