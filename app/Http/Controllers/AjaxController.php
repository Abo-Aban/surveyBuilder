<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Survey;
use App\User;

class AjaxController extends Controller
{
    
    // action to handle ajax survey_search requests
    public function search_surveys(Request $request){
        $title = $request['query'];
        $surveys = Survey::where('title', 'like', "%$title%")->get();
        return response()->json($surveys, 200);
    }

    // action to handle ajax user_search requests
    public function search_users(Request $request){
        $name = $request['query'];
        $users = User::where('role', '<>', 'admin')->where('name', 'like', "%$name%")->get();
        return response()->json($users, 200);
    }

    // action to handle ajax sort_users
    public function sort_users(Request $request){
        $users = User::where('role', '<>', 'admin')->orderBy('name', $request['sort'])->get();
        // $users = DB::table('users')->orderBy('name', $request['sort'])->get();
        return response()->json($users, 200);
    }

    //function to seal the survey before sharting it
    public function seal_survey(Request $request){
        // get the survey with the specified id and seal it
        $survey = Survey::find( ((int)$request['sid']) )->update(['sealed' => 'yes']);
        return response()->json(($survey), 200);

        return response()->ajax($survey->question, 200);
    }


}
