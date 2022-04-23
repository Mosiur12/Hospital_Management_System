<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Option;
use App\Question;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        //return $request;

        $this->validate($request,[
            'answer'=>'required',
            'status'=>'required',
            'mcq_quiz_id'=>'required',
            'option'=>'required',
            'file' => 'mimes:jpeg,png,jpg,JPG',
        ]);

        $data=$request->all();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imagename = time().'_question.'.$image->getClientOriginalExtension();
            $path = 'assets/images/question/';
            $image->move($path, $imagename);
            $data['image'] = $path.$imagename;
        }

        $question= Question::create($data);

        if(count($request->option) > 0) {
            foreach ($request->option as $item => $v) {
                $optionData = array(
                    'questions_id' => $question->id,
                    'option' => $request->option[$item]
                );
                Option::insert($optionData);
            }
        }

        Toastr::success('Question successfully Created', 'Success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $options = Option::where('questions_id', $question->id)->get();
        return view('instructor.content.mcqEdit', compact('question', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request,[
            'answer'=>'required',
            'status'=>'required',
            'option'=>'required',
            'file' => 'mimes:jpeg,png,jpg,JPG',
        ]);

        $new_data=$request->all();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imagename = time().'_question.'.$image->getClientOriginalExtension();
            $path = 'assets/images/question/';
            $image->move($path, $imagename);
            $new_data['image'] = $path.$imagename;
        }else{
            $new_data['image'] = $question->image;
        }

        $question->update($new_data);

        if(count($request->option_id) > 0) {
            foreach ($request->option_id as $item=>$v) {
                $datad=array(
                    'option'=>$request->option[$item]
                );
                $dbazar=Option::where('id',$request->option_id[$item])->first();
                $dbazar->update($datad);
            }
        }
        Toastr::success('Question successfully updated', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ($question->image != null)
        {
            if (file_exists(public_path($question->image)))
            {
                unlink(public_path($question->image));
            }
        }

        $question->delete();
        Toastr::success('Mcq question successfully Deleted', 'Success');
        return redirect()->back();
    }
}
