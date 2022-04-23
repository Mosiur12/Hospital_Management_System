<?php

namespace App\Http\Controllers\student;

use App\Audio;
use App\Chapter;
use App\Course;
use App\FinalExam;
use App\FinalMark;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MarkController;
use App\Mark;
use App\Pdf;
use App\Ppt;
use App\Quiz;
use App\Resource;
use App\Video;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $course = Course::where('id', $id)->pluck('title')->first();
        session(['course_id' => $id]);
        session(['course_name' => $course]);

        return view('learning.content.index');
    }

    public function video($id)
    {
        $video = Video::where('lecture_id', $id)->pluck('file')->first();
        $resource= Resource::where('lecture_id', $id)->pluck('file')->first();
        $ppt = Ppt::where('lecture_id', $id)->pluck('file')->first();
        return response()->json(['video'=>$video,'resource'=>$resource, 'ppt'=>$ppt],200);
    }

    public function audio($id)
    {
        $audio = Audio::where('lecture_id', $id)->pluck('file')->first();
        return response()->json($audio, 200);
    }

    public function pdf($id)
    {
        $pdf = Pdf::where('lecture_id', $id)->pluck('file')->first();
        return response()->json($pdf, 200);
    }

    public function ppt($id)
    {
        $ppt = Ppt::where('lecture_id', $id)->pluck('file')->first();
        return response()->json($ppt, 200);
    }

    /*public function quiz($id)
    {
        $quiz = Quiz::where('id', $id)->select('id','file')->first();
        return response()->json($quiz, 200);
    }*/

    public function quiz($id, $couseId)
    {
        $stdId = Auth::user()->id;
        $marks = Mark::where('student_id', $stdId)->where('quiz_id', $id)->where('status', "1")->first();

        $course['name'] = Course::where('id', $couseId)->pluck('title')->first();
        $chapters = Chapter::where('course_id', $couseId)->get();

        if ($marks) {
            $quiz = Quiz::where('id', $id)->first();
            return view('learning.content.quizResult', compact('quiz', 'marks', 'chapters'), $course);
        } else {
            $quiz = Quiz::where('id', $id)->first();
            return view('learning.content.quiz', compact('quiz', 'chapters'), $course);
        }
    }

    public function final($id)
    {
        $stdId = Auth::user()->id;
        $marks = FinalMark::where('student_id', $stdId)->where('exam_id', $id)->where('status', "1")->first();
        $course['course'] = Course::where('id', \session('course_id'))->select('id','title')->first();
        $final = FinalExam::where('id', $id)->first();

        if ($marks) {
            return view('learning.content.finalResult', compact('marks', 'final'), $course);
        } else {
            return view('learning.content.final', compact('final'), $course);
        }
    }

    public function quizUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx',
        ]);
        $id = Auth::user()->id;
        $quizId = $request->quiz_id;

        $image = $request->file('file');
        $imagename = $id.'_'.$quizId.'_answer.'.$image->getClientOriginalExtension();
        $path = 'assets/answer/';
        $image->move($path, $imagename);

        $marks = new Mark();
        $marks->file = $path.$imagename;
        $marks->student_id = $id;
        $marks->instructor_id = $request->instructor_id;
        $marks->quiz_id = $request->quiz_id;
        $marks->status = "1";
        $marks->save();

        Toastr::success('Answer Script successfully submitted', 'Success');
        return redirect()->back();
    }

    public function finalUpload(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx',
        ]);
        $id = Auth::user()->id;
        $examId = $request->exam_id;

        $image = $request->file('file');
        $imagename = $id.'_'.$examId.'_answer.'.$image->getClientOriginalExtension();
        $path = 'assets/answer/final';
        $image->move($path, $imagename);

        $marks = new FinalMark();
        $marks->file = $path.$imagename;
        $marks->student_id = $id;
        $marks->instructor_id = $request->instructor_id;
        $marks->exam_id = $examId;
        $marks->status = "1";
        $marks->save();

        /*$chapter = Chapter::where('id', $request->chapter_id)->first();
        $course = Course::where('id', $chapter->course_id)->pluck('id')->first();*/

        Toastr::success('Answer Script successfully submitted', 'Success');
        return redirect()->back();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
