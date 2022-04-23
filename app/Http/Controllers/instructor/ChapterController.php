<?php

namespace App\Http\Controllers\instructor;

use App\Chapter;
use App\Course;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ChapterController extends Controller
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
            'name'=>'required',
        ]);

        $chapter = new Chapter();
        $chapter->name = $request->name;
        $chapter->course_id = $request->course_id;
        $chapter->save();

        Course::find($request->course_id)->increment('chapter');

        Toastr::success('Chapter successfully create', 'Success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        //return $chapter;

        $request->validate([
            'name'=>'required',
        ]);

        $chapter->name = $request->name;
        $chapter->update();

        Toastr::success('Chapter successfully update', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {

        Course::find($chapter->course_id)->decrement('chapter', 1);
        $chapter->delete();
        Toastr::success('Chapter successfully Deleted', 'Success');
        return redirect()->back();
    }
}
