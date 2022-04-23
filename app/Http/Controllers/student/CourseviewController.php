<?php

namespace App\Http\Controllers\student;

use App\Courseview;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseviewController extends Controller
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
        //
    }

    public function view($id)
    {
        $stdId = Auth::user()->id;
        $result = Courseview::where('student_id', $stdId)->where('lecture_id', $id)->first();

        if ($result){
            Toastr::success('This Lecture Already View', 'Success');
            return response()->json("This Lecture Already View", 200);
        }else{
            $courseView = new Courseview();
            $courseView->student_id = $stdId;
            $courseView->lecture_id = $id;
            $courseView->save();
            Toastr::success('Lecture successfully complete', 'Success');
            return response()->json("Lecture successfully complete", 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Courseview  $courseview
     * @return \Illuminate\Http\Response
     */
    public function show(Courseview $courseview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courseview  $courseview
     * @return \Illuminate\Http\Response
     */
    public function edit(Courseview $courseview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courseview  $courseview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courseview $courseview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courseview  $courseview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courseview $courseview)
    {
        //
    }
}
