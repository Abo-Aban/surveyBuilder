<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;
use \NumberFormatter;

class QuestionController extends Controller
{
    /* Question Show Function */
    public function show($sid, $qid){
        $quests = Survey::find($sid)->questions;
        $quest = $quests->forPage($qid, 1)->first();
        // if the question does not exists or the question id is invalid
        if(count($quest) < 1 || $qid < 1){
            return redirect("/surveys/$sid")->with('error', 'Question Not Found.');
        }
        // append the proper properties to the quest
        $this->prepare_question($qid, $quest, $quests);  
        $quest->qid = $qid;
        
        return view('questions.show')->with('quest', $quest);
     }

    /* Question Editing Function */
    public function edit($sid, $qid){
        $quests = Survey::find($sid)->questions;
        $quest = $quests->forPage($qid, 1)->first();
        $quest->qid = $qid;
        // if the question does not exists or the question id is invalid
        if(count($quest) < 1 || $qid < 1){
            return redirect("/surveys/$sid")->with('error', 'Question Not Found.');
        }

        // if the user is not authorized to medit this survey
        if( auth()->user()->id !== $quest->survey_id && auth()->user()->role !== 'admin' ){
            return redirect("/surveys/$sid")->with('error', 'Youre Not Authorized To Edit This Question.');
        }

        // append the proper properties to the quest
        $this->prepare_question($qid, $quest, $quests);  
        return view('questions.edit')->with('quest', $quest);
    }


    // Quesiton Deleting Function
    public function destroy($sid, $qid){
        $question = Question::find($qid);
        //$question->partici()->detach();
        $question->delete();

        return redirect("/surveys/$sid")->with('success', 'Question Deleted.');
    }


    public function create($sid){
        // get the survey
        $survey = Survey::find($sid);
        // append the count property
        $survey->count = $survey->questions->count();
        // append the new question num
        $survey->new_num = $survey->count + 1;
        // append the new question alpha num
        $survey->new_alpha_num = $this->alpha_num($survey->new_num);
        

        return view('questions.create', compact('survey'));
    }

    public function store(Request $request, $sid){
        $question = new Question;
        // return $request->all();

        $this->validate($request,[
            'question' => 'required|string',
            'alter_1' => 'required|string',
            'alter_2' => 'required|string',
        ]);

        $question->question_type = $request->input('question_type');
        $question->question = $request->input('question');
        $question->alters_count = $request->input('alters_count');
        $question->survey_id = $sid;

        $question->alter_1 = $request->input('alter_1');
        $question->alter_2 = $request->input('alter_2');


        // continue validating and store the rest of alternatives

        if($request->filled('alter_3')){
            $this->validate($request,[
                'alter_3' => 'required|string',
            ]);
            $question->alter_3 = $request->input('alter_3');
        }

        if($request->filled('alter_4')){
            $this->validate($request,[
                'alter_4' => 'required|string',
            ]);
            $question->alter_4 = $request->input('alter_4');
        }

        if($request->filled('alter_5')){
            $this->validate($request,[
                'alter_5' => 'required|string',
            ]);
            $question->alter_5 = $request->input('alter_5');
        }

        $question->save();

        return redirect("/surveys/$sid/questions/".Survey::find($sid)->questions->count()."/edit");

    }


    public function update(Request $request, $sid, $qid){
        // return $request->input('qid');
        $question = Question::find($qid);

        $this->validate($request,[
            'question' => 'required|string',
            'alter_1' => 'required|string',
            'alter_2' => 'required|string',
        ]);

        $question->question_type = $request->input('question_type');
        $question->question = $request->input('question');
        $question->alters_count = $request->input('alters_count');
        $question->survey_id = $sid;

        $question->alter_1 = $request->input('alter_1');
        $question->alter_2 = $request->input('alter_2');


        // continue validating and store the rest of alternatives

        if($request->filled('alter_3')){
            $this->validate($request,[
                'alter_3' => 'required|string',
            ]);
            $question->alter_3 = $request->input('alter_3');
        }

        if($request->filled('alter_4')){
            $this->validate($request,[
                'alter_4' => 'required|string',
            ]);
            $question->alter_4 = $request->input('alter_4');
        }

        if($request->filled('alter_5')){
            $this->validate($request,[
                'alter_5' => 'required|string',
            ]);
            $question->alter_5 = $request->input('alter_5');
        }

        $question->save();

        return redirect("/surveys/$sid/questions/".$request->input('qid')."/edit")->with('success', 'Saved Successfully.');

    }
    

    protected function prepare_question($qid, &$quest, &$quests){
        
        // join the alters into one array called alters
        $quest->alters = array($quest->alter_1, $quest->alter_2, $quest->alter_3, $quest->alter_4, $quest->alter_5); 
        
        // add question custom number property
        $quest->num = $qid;

        // add question custom alpha-number property
        $quest->alpha_num = $this->alpha_num($qid);

        // return some indicators as (first, last) 
        $quest->isFirst = ($qid == 1); // First Indicator
        $quest->isLast = ($qid == $quests->count()); // Last Indicator
        
        return $quest;
    }




    protected function alpha_num($n){
        $f = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        return $f->format($n);
    } 
}
