<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\McqQuiz;
use App\Question;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class McqQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'time'=>'required',
            'status'=>'required',
        ]);

        $quiz  = new McqQuiz();
        $quiz->title = $request->title;
        $quiz->time = $request->time;
        $quiz->chapter_id = $request->chapter_id;
        $quiz->status = $request->status;
        $quiz->save();
        Toastr::success('McqQuiz successfully create', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\McqQuiz  $mcqQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(McqQuiz $mcqQuiz)
    {
        $questions = Question::where('mcq_quiz_id',$mcqQuiz->id)->get();
        return view('instructor.content.mcqShow', compact('mcqQuiz', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\McqQuiz  $mcqQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit(McqQuiz $mcqQuiz)
    {
        return view('instructor.content.mcqQuizEdit', compact('mcqQuiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\McqQuiz  $mcqQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, McqQuiz $mcqQuiz)
    {
        $request->validate([
            'title'=>'required',
            'time'=>'required',
            'status'=>'required',
        ]);

        $mcqQuiz->title = $request->title;
        $mcqQuiz->time = $request->time;
        $mcqQuiz->status = $request->status;
        $mcqQuiz->Update();
        Toastr::success('McqQuiz successfully updated', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\McqQuiz  $mcqQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(McqQuiz $mcqQuiz)
    {
        $mcqQuiz->delete();

        Toastr::success('McqQuizQuiz successfully Deleted', 'Success');
        return redirect()->back();
    }
}
