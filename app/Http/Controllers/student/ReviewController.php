<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
            'title' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);

        $review = new Review();
        $review->title = $request->title;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->status = "1";
        $review->student_id = Auth::user()->id;
        $review->course_id = $request->course_id;
        $review->save();

        Toastr::success('Course Review successfully given', 'Success');
        return redirect()->route('student.courses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::where('student_id', Auth::user()->id)->where('course_id', $id)->first();
        if ($review)
        {
            return redirect()->route('student.reviews.edit', $review->id);
        }else{
            $data['course_id'] = $id;
            return view('student.review.create', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('student.review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'title' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);
        $review->title = $request->title;
        $review->comment = $request->comment;
        $review->rating = $request->rating;

        $review->update();

        Toastr::success('Course Review successfully update', 'Success');
        return redirect()->route('student.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
