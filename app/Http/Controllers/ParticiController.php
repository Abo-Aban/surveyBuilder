<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Question;
use App\Partici;

class ParticiController extends Controller
{
    public function store(Request $request, $sid, $qid){
        $q = Question::find($qid);
        // in case of MCQ question
        if( $q->question_type == 'mcq'){
            for($i = 1; $i <= $q->alters_count; ++$i){
                if($request->has('alter_'.$i)){
                    $p = new Partici;
                    $p->survey_id = $sid;
                    $p->question_id = $qid;
                    $p->alter = $request->input('alter_'.$i);
                    $p->save();
                }
            }
        // in case of single answer question
        }else{
            $p = new Partici;
            $p->survey_id = $sid;
            $p->question_id = $qid;
            $p->alter = $request->input('alter_1');
            $p->save();
        }
        $ss = Survey::find($sid)->questions->count();
        $n=  intval($request->input('qid'));
        if($n == $ss){
            return redirect("/surveys/$sid/end");
        }else{
            // return $n;
            return redirect("/surveys/$sid/questions/" . ++$n);
        }

    }
}
