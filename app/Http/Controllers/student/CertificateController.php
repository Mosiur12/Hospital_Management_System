<?php

namespace App\Http\Controllers\student;

use App\Certificate;
use App\Course;
use App\Http\Controllers\Controller;

use App\User;
use Barryvdh\DomPDF\PDF as PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $complete = Certificate::where('student_id', $id)->get();
        return view('student.certificate.index', compact('complete'));
    }

    public function finish($id)
    {
        $stdId = Auth::user()->id;
        $isDone = Certificate::where('course_id', $id)->where('student_id', $stdId)->first();
        if ($isDone)
        {
            Toastr::success('Already Complete This Course', 'Success');
            return redirect()->route('student.courses.index');
        }else{
            $complete = new Certificate();
            $complete->course_id = $id;
            $complete->student_id = $stdId;
            $complete->status = "1";
            $complete->save();
            Toastr::success('Congratulations !! Course successfully complete', 'Success');
            return redirect()->route('student.courses.index');
        }

    }

    public function certificate($id)
    {
        $certificate = Certificate::where('id', $id)->first();
        $course = Course::where('id', $certificate->course_id)->select('title')->first();
        $user = User::where('id', $certificate->student_id)->select('name')->first();
        $url = asset('frontend')."/images/cirtificate.png";


        $data = [
            'name'=>$user,
            'course'=>$course,
            'date'=>$certificate->created_at,
            'url' => $url
        ];

        $pdf = \Barryvdh\DomPDF\Facade::loadView('student.certificate.certificate', $data);
        return $pdf->download('certificate.pdf');
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
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
