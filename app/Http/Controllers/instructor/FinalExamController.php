<?php

namespace App\Http\Controllers\instructor;

use App\FinalExam;
use App\FinalMark;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FinalExamController extends Controller
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
    public function finalParticipants($id)
    {

        $exam = FinalExam::where('id', $id)->first();
        $answerScripts = FinalMark::where('instructor_id', Auth::user()->id)->where('exam_id', $id)->orderByDesc('id')->get();
        return view('instructor.content.finalParticipant', compact('answerScripts', 'exam'));
    }

    public function uploadFinalMarks(Request $request)
    {

        $request->validate([
            'marks'=>'required',
        ]);
        $mark = FinalMark::where('id', $request->marks_id)->first();
        $quiz = FinalExam::where('id', $mark->exam_id)->first();

        if ($request->marks > $quiz->marks)
        {
            Toastr::error('Sorry !! your uploaded marks cross the exam mark', 'Error');
        }else{
            $mark->marks = $request->marks;
            $mark->update();
            Toastr::success('Marks successfully Updated', 'Success');
        }

        return redirect()->back();
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
            $fileName = $quizName.'_finalExam.'.$file->getClientOriginalExtension();
            $path = 'assets/final/';
            $file->move($path, $fileName);
        }
        $quiz  = new FinalExam();
        $quiz->title = $request->title;
        $quiz->marks = $request->marks;
        $quiz->time = $request->time;
        $quiz->instructor_id = Auth::user()->id;
        $quiz->course_id = $request->course_id;
        $quiz->status = $request->status;
        $quiz->file = $path.$fileName;
        $quiz->save();
        Toastr::success('Final Exam successfully create', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalExam  $finalExam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $finalExam = FinalExam::find($id);
        return view('instructor.content.finalShow', compact('finalExam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalExam  $finalExam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $finalExam = FinalExam::find($id);
        return view('instructor.content.finalEdit', compact('finalExam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalExam  $finalExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $finalExam = FinalExam::find($id);
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
            $fileName = $quizName.'_final.'.$file->getClientOriginalExtension();
            $path = 'assets/final/';

            if (file_exists(public_path($finalExam->file))) {
                unlink(public_path($finalExam->file));
            }
            $file->move($path, $fileName);
            $quizFile = $path.$fileName;
        }else{
            $quizFile = $finalExam->file;
        }

        $finalExam->title = $request->title;
        $finalExam->marks = $request->marks;
        $finalExam->time = $request->time;
        $finalExam->status = $request->status;
        $finalExam->instructor_id = Auth::user()->id;
        $finalExam->file = $quizFile;

        $finalExam->update();

        Toastr::success('Final exam successfully Updated', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalExam  $finalExam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $finalExam = FinalExam::find($id);
        if (file_exists(public_path($finalExam->file)))
        {
            unlink(public_path($finalExam->file));
        }

        $finalExam->delete();

        Toastr::success('Final Exam successfully Deleted', 'Success');
        return redirect()->back();
    }
}
