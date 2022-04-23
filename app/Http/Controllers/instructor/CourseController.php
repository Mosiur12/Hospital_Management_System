<?php

namespace App\Http\Controllers\instructor;

use App\Category;
use App\Chapter;
use App\Course;
use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->paginate(5);
        return view('instructor.course.index', compact('courses'));
    }


    public function content($id)
    {
        $chapters = Chapter::where('course_id', $id)->get();
        $data['course_id'] = $id;
        $data['course_name'] = Course::where('id', $id)->pluck('title')->first();

        //return $data['course_name'];

        return view('instructor.content.index', compact('chapters'), $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', '1')->orderBy('name', 'ASC')->get();
        return view('instructor.course.create', compact('categories'));
    }

    public function review($id)
    {
        $reviews = Review::where('course_id', $id)->get();
        return view('instructor.course.review', compact('reviews'));
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
            'short_desc'=>'required',
            'course_details'=>'required',
            'category_id'=>'required',
            'course_fee'=>'required',
            'offer_price'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
            'status'=>'required'
        ]);

        /*total_course*/

        $image = $request->file('image');
        $imagename = time().'_course.'.$image->getClientOriginalExtension();
        $path = 'assets/images/course/';
        $image->move($path, $imagename);

        $uerId = Auth::user()->id;

        $data = new Course();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->short_desc = $request->short_desc;
        $data->course_details = $request->course_details;
        $data->course_fee = $request->course_fee;
        $data->offer_price = $request->offer_price;
        $data->category_id = $request->category_id;
        $data->instructor_id = $uerId;
        $data->image = $path.$imagename;
        $data->status = $request->status;

        $data->save();

        User::find($uerId)->increment('total_course');

        Toastr::success('Course successfully create', 'Success');
        return redirect()->route('instructor.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('instructor.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $categories = Category::where('status', '1')->orderBy('name', 'ASC')->get();
        return view('instructor.course.edit', compact('categories', 'course'));
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
        $request->validate([
            'title'=>'required',
            'short_desc'=>'required',
            'course_details'=>'required',
            'category_id'=>'required',
            'course_fee'=>'required',
            'offer_price'=>'required',
            'image' => 'mimes:jpeg,png,jpg,JPG',
            'status'=>'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'_course.'.$image->getClientOriginalExtension();
            $path = 'assets/images/course/';

            if (file_exists(public_path($course->image))) {
                unlink(public_path($course->image));
            }
            $image->move($path, $imagename);
            $img = $path.$imagename;
        }else{
            $img = $course->image;
        }

        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->short_desc = $request->short_desc;
        $course->course_details = $request->course_details;
        $course->course_fee = $request->course_fee;
        $course->offer_price = $request->course_fee;
        $course->category_id = $request->category_id;
        $course->instructor_id = Auth::user()->id;
        $course->image = $img;
        $course->status = $request->status;

        //return $data;
        $course->update();
        Toastr::success('Course successfully updated', 'Success');
        return redirect()->route('instructor.courses.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        $uerId = Auth::user()->id;
        User::find($uerId)->decrement('total_course', 1);

        if (file_exists(public_path($course->image)))
        {
            unlink(public_path($course->image));
        }

        Toastr::success('Course successfully Deleted', 'Success');

        return redirect()->route('instructor.courses.index');
    }
}
