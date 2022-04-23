<?php

namespace App\Http\Controllers\student;

use App\Exam;
use App\Http\Controllers\Controller;
use App\McqQuiz;
use App\Question;
use App\Results;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Examcontroller extends Controller
{
    public function question($id)
    {

        $userId=Auth::user()->id;
        $result=Results::where('user_id', $userId)->where('quiz_id',$id)->first();
        $quiz=McqQuiz::find($id);

        $data['id'] = $id;

        if (!$result){
            return view('learning.mcqQuiz.start', compact('quiz'), $data);
        }else{
            $exams=Exam::where('user_id', $userId)->where('quiz_id',$id)->get();
            $questions=Question::where('mcq_quiz_id',$id)->get();
            return view('learning.mcqQuiz.details',compact('exams','quiz','questions','result'));
        }
        //return $id;
    }

    public function startNewQuiz($id)
    {

        $quiz=McqQuiz::where('id', $id)->where('status', '1')->first();
        $questions = Question::where('mcq_quiz_id', $id)->inRandomOrder()->get();
        return view('learning.mcqQuiz.question', compact('questions','quiz'));
    }

    public function examPost(Request $request)
    {
        $userId=Auth::user()->id;
        $date=date('Y-m-d');
        $yes=0;
        $no=0;
        $data=$request->all();

        for($i=1; $i<=$request->index;$i++){
            if(isset($data['questions_id'.$i])){
                $exam=new Exam();
                $question=Question::where('id',$data['questions_id'.$i])->get()->first();
                if($question->answer==$data['ans'.$i])
                {
                    $result[$data['questions_id'.$i]]='Yes';
                    $exam->is_ans="yes";
                    $yes++;
                }else{
                    $result[$data['questions_id'.$i]]='No';
                    $exam->is_ans="No";
                    $no++;
                }
                $exam->user_id= $userId;
                $exam->quiz_id= $question->mcq_quiz_id;
                $exam->questions_id=$data['questions_id'.$i];
                $exam->ans=$data['ans'.$i];

                $exam->save();

            }

        }

        if($res=Results::where('user_id',$userId)->where('quiz_id',$request->quizes_id)->first()){

        }else{
            $res=new Results();
        }
        $res->user_id= $userId;
        $res->quiz_id= $request->quizes_id;
        $res->date= $date;
        $res->yes_ans=$yes;
        $res->total_mark=$yes;
        $res->no_ans=$no;
        $res->save();

        Toastr::success('Quiz Successfully Submitted', 'Success');
        return redirect()->route('student.myQuiz', $request->quizes_id);


    }
}
