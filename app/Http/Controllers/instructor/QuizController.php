<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Mark;
use App\Quiz;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuizController extends Controller
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
            'marks'=>'required',
            'time'=>'required',
            'status'=>'required',
            'file' => 'required|mimes:pdf,doc,docx',
        ]);

        $quizName = Str::slug($request->title);

        if ($request->hasFile('file'))
        {
            $file = $request->file('file');
            $fileName = $quizName.'_quiz.'.$file->getClientOriginalExtension();
            $path = 'assets/quiz/';
            $file->move($path, $fileName);
        }
        $quiz  = new Quiz();
        $quiz->title = $request->title;
        $quiz->marks = $request->marks;
        $quiz->time = $request->time;
        $quiz->instructor_id = Auth::user()->id;
        $quiz->chapter_id = $request->chapter_id;
        $quiz->status = $request->status;
        $quiz->file = $path.$fileName;
        $quiz->save();
        Toastr::success('Quiz successfully create', 'Success');
        return redirect()->back();
    }

    public function quizParticipants($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $answerScripts = Mark::where('instructor_id', Auth::user()->id)->where('quiz_id', $id)->orderByDesc('id')->get();
        return view('instructor.content.quizParticipant', compact('answerScripts', 'quiz'));
    }

    public function uploadQuizMark(Request $request)
    {

        $request->validate([
            'marks'=>'required',
        ]);
        $mark = Mark::where('id', $request->marks_id)->first();
        $quiz = Quiz::where('id', $mark->quiz_id)->first();

        if ($request->marks > $quiz->marks)
        {
            Toastr::error('Sorry !! your uploaded marks cross the quiz mark', 'Error');
        }else{
            $mark->marks = $request->marks;
            $mark->update();
            Toastr::success('Marks successfully Updated', 'Success');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('instructor.content.quizShow', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('instructor.content.quizEdit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {

        $request->validate([
            'title'=>'required',
            'marks'=>'required',
            'time'=>'required',
            'status'=>'required',
            'file' => 'mimes:pdf,doc,docx',
        ]);
        $quizName = Str::slug($request->title);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $quizName.'_quiz.'.$file->getClientOriginalExtension();
            $path = 'assets/quiz/';

            if (file_exists(public_path($quiz->file))) {
                unlink(public_path($quiz->file));
            }
            $file->move($path, $fileName);
            $quizFile = $path.$fileName;
        }else{
            $quizFile = $quiz->file;
        }

        $quiz->title = $request->title;
        $quiz->marks = $request->marks;
        $quiz->time = $request->time;
        $quiz->status = $request->status;
        $quiz->instructor_id = Auth::user()->id;
        $quiz->file = $quizFile;

        $quiz->update();

        Toastr::success('Quiz successfully Updated', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        if (file_exists(public_path($quiz->file)))
        {
            unlink(public_path($quiz->file));
        }

        $quiz->delete();

        Toastr::success('Quiz successfully Deleted', 'Success');
        return redirect()->back();
    }
}
