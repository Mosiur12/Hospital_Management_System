<?php

namespace App\Http\Controllers\admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('is_approve')->paginate(8);
        return view('admin.course.index', compact('courses'));
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

    public function searchCourse(Request $request)
    {
        $search = $request->search;
        $courses = Course::where('title', $search)->orWhere('title', 'LIKE', '%'.$search.'%')->orderBy('title')->paginate(8);
       return view('admin.course.search', compact('courses'));
    }

    public function review($id)
    {
        $reviews = Review::where('course_id', $id)->get();
        return view('admin.course.review', compact('reviews'));
    }

    public function reviewUpdate($id)
    {
        $review = Review::where('id', $id)->first();
        if ($review->status == "0")
        {
            $review->status = "1";
        }else{
            $review->status = "0";
        }
        $review->update();
        Toastr::success('Course review successfully update', 'Success');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //return $request->update;
        if ($request->update == 'approved'){
            if ($course->is_approve == '0')
            {
                $course->is_approve = '1';
                $course->update();
                Toastr::success('Course successfully Approved', 'Success');
            }else{
                $course->is_approve = '0';
                $course->update();
                Toastr::success('Course successfully UnApproved', 'Success');
            }
        }

        if ($request->update == 'featured'){
            if ($course->is_featured == '0')
            {
                $course->is_featured = '1';
                $course->update();
                Toastr::success('Course successfully Featured', 'Success');
            }else{
                $course->is_featured = '0';
                $course->update();
                Toastr::success('Course successfully Un Featured', 'Success');
            }
        }

        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
