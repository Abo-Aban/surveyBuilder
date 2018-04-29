<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Survey;
use App\Question;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show all surevys in case of admin
        if(Auth::user()->role == 'admin'){
            if(Survey::count() > 0) $surveys = Survey::orderBy('title')->paginate(20);
            else{
                // redirect to the dashbord with error message indicating that there are no surveys
                return redirect()->route('home')->with('error', 'No Surveys.');
            }
        }else{
            if(Auth::user()->surveys->count() > 0) $surveys = Auth::user()->surveys->paginate(20);
            else{
                // redirect to create a new survey
                return redirect('/surveys/create');
            }
        }
        
        // send the total number of the surveys
        $surveys->count = Survey::count();

        // return dd($surveys);
        return view('surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the inputs before insering them into database
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:25'
        ]);

        // $request->validate([

        // ]);

        $survey = new Survey();
        $survey->user_id = $request->input('user_id');
        $survey->title = $request->input('title');
        $survey->description = $request->input('description');
        $survey->save();

        // redirect to the new survey to start adding questions
        return redirect('/surveys/'.$survey->id.'/questions');
        // return redirect()->route('surveys.index')->with('success', 'Survey Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = Survey::find($id);

        //the survey couldn't be found
        if(count($survey) < 1){
            return redirect("/surveys")->with('error', "The Survey Couldn't Be Found.");
        }

        // check if the user is authorized to view this survey
        if(Auth::user()->role != 'admin' && $survey->user_id != $id){
            // return Auth::user()->id . "  " .  $id;
            return redirect()->route('surveys.index')->with('error', "You Are Not Authorized To View This Survey.");
        }

        // return the share url of the survey along with response
        $shareURL = url("/surveys/$survey->id"."/start");
        // $questions = $survey->questions;
        return view('surveys.show', compact('survey', 'shareURL'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::find($id);
        return view('surveys.edit')->with('survey', $survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::find($id);
        //$survey->questions()->detach();
        $survey->delete();
        return redirect()->route('surveys.index')->with('success', 'Survey Deleted Successfully.');
    }


    // return the survey_start view
    public function start($sid){
        $survey = Survey::find($sid);
        return view('surveys.survey_start', compact('survey'));
    }

    // return the survey_end view
    public function end($sid){
        $survey = Survey::find($sid);
        // increase the number of participants by one
        // check if the survey is sealed 
        if($survey->sealed !== 'no'){
            $survey->count++;
            $survey->save();
        }
        //

        return view('surveys.survey_end', compact('survey'));
    }


    public function show_statistics($sid){
        // return request()->ip_mod();
        $survey = Survey::find($sid);
        $questions = $survey->questions;
        
        // get the total no of participants on the survey
        $totalParticiCount = 0;        
        foreach($questions->all() as $question){
            // add the question participant 
            $totalParticiCount += $question->partici->count();
        }
        // $totalParticiCount = $survey->count;

        return view('surveys.survey_statistics', compact('survey', 'questions', 'totalParticiCount'));
    }

    public function statistics(){
        // show all surevys in case of admin
        if(Auth::user()->role == 'admin'){
            if(Survey::count() > 0) $surveys = Survey::orderBy('title')->paginate(20);
            else{
                // redirect to the dashbord with error message indicating that there are no surveys
                return redirect()->route('home')->with('error', 'No Surveys.');
            }
        }else{
            if(Auth::user()->surveys->count() > 0) $surveys = Auth::user()->surveys->paginate(20);
            else{
                // redirect to create a new survey
                return redirect('/surveys/create');
            }
        }
        
        // send the total number of the surveys
        $surveys->count = Survey::count();

        // return dd($surveys);
        return view('surveys.statistics', compact('surveys'));
    }

}