<?php

namespace App\Http\Controllers\instructor;

use App\Audio;
use App\Chapter;
use App\Course;
use App\Http\Controllers\Controller;
use App\Lecture;
use App\Pdf;
use App\Ppt;
use App\Resource;
use App\User;
use App\Video;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LectureController extends Controller
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
            'name'=>'required'
        ]);

        try {

            $lecture = new Lecture();
            $lecture->name = $request->name;
            $lecture->chapter_id = $request->chapter_id;

            $lec = Str::slug($lecture->name);

            $course_id = Chapter::where('id', $request->chapter_id)->first();

            if ($lecture->save())
            {
                Course::find($course_id->course_id)->increment('lecture');

                if ($request->hasFile('audio'))
                {
                    $file = $request->file('audio');
                    $fileName = $lec.'_audio.'.$file->getClientOriginalExtension();
                    $path = 'assets/audio/';
                    $file->move($path, $fileName);

                    $audio = new Audio();
                    $audio->file = $path.$fileName;
                    $audio->lecture_id = $lecture->id;
                    $audio->save();
                }
                if ($request->hasFile('video'))
                {
                    $file = $request->file('video');
                    $fileName = $lec.'_video.'.$file->getClientOriginalExtension();
                    $path = 'assets/video/';
                    $file->move($path, $fileName);

                    $audio = new Video();
                    $audio->file = $path.$fileName;
                    $audio->lecture_id = $lecture->id;
                    $audio->save();

                    Course::find($course_id->course_id)->increment('total_video');
                }
                if ($request->hasFile('pdf'))
                {
                    $file = $request->file('pdf');
                    $fileName = $lec.'_pdf.'.$file->getClientOriginalExtension();
                    $path = 'assets/pdf/';
                    $file->move($path, $fileName);

                    $audio = new Pdf();
                    $audio->file = $path.$fileName;
                    $audio->lecture_id = $lecture->id;
                    $audio->save();
                }
                if ($request->hasFile('ppt'))
                {
                    $file = $request->file('ppt');
                    $fileName = $lec.'_ppt.'.$file->getClientOriginalExtension();
                    $path = 'assets/ppt/';
                    $file->move($path, $fileName);

                    $audio = new Ppt();
                    $audio->file = $path.$fileName;
                    $audio->lecture_id = $lecture->id;
                    $audio->save();
                }
                if ($request->hasFile('resource'))
                {
                    $file = $request->file('resource');
                    $fileName = $lec.'_resource.'.$file->getClientOriginalExtension();
                    $path = 'assets/resource/';
                    $file->move($path, $fileName);

                    $audio = new Resource();
                    $audio->file = $path.$fileName;
                    $audio->lecture_id = $lecture->id;
                    $audio->save();
                }

                Toastr::success('Lecture successfully create', 'Success');
                return redirect()->back();
            }
        }catch(\Exception $exception){

            Toastr::error($exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        $audio = Audio::where('lecture_id', $lecture->id)->first();
        $video = Video::where('lecture_id', $lecture->id)->first();
        $pdf = Pdf::where('lecture_id', $lecture->id)->first();
        $ppt = Ppt::where('lecture_id', $lecture->id)->first();
        $resource = Resource::where('lecture_id', $lecture->id)->first();
        $chapter = Chapter::where('id', $lecture->chapter_id)->first();
        return view('instructor.content.show', compact('lecture','audio','video','pdf','ppt','resource', 'chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        $audio = Audio::where('lecture_id', $lecture->id)->first();
        $video = Video::where('lecture_id', $lecture->id)->first();
        $pdf = Pdf::where('lecture_id', $lecture->id)->first();
        $ppt = Ppt::where('lecture_id', $lecture->id)->first();
        $resource = Resource::where('lecture_id', $lecture->id)->first();
        $chapter = Chapter::where('id', $lecture->chapter_id)->first();
        return view('instructor.content.edit', compact('lecture','audio','video','pdf','ppt','resource', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        $request->validate([
            'name'=>'required',
            /*'audio' => 'mimes:audio/mpeg,mpga,mp3',
            'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm|max:307200',
            'ppt' => 'mimes:ppt, pptx,doc,docx',
            'pdf' => 'mimes:pdf,doc,docx',
            'resource' => 'mimes:zip,rar',*/
        ]);

        try {

            $lecture->name = $request->name;
            $lec = Str::slug($lecture->name);

            if ($lecture->update())
            {
                if ($request->hasFile('audio'))
                {
                    $file = $request->file('audio');
                    $fileName = $lec.'_audio.'.$file->getClientOriginalExtension();
                    $path = 'assets/audio/';


                    $audio = Audio::where('lecture_id', $lecture->id)->first();

                    if ($audio)
                    {
                        $audio->file = $path.$fileName;

                        if (file_exists(public_path($audio->file)))
                        {
                            unlink(public_path($audio->file));
                        }
                        $file->move($path, $fileName);
                        $audio->update();
                    }else{
                        $file->move($path, $fileName);
                        $audio = new Audio();
                        $audio->file = $path.$fileName;
                        $audio->lecture_id = $request->lecture_id;
                        $audio->save();
                    }

                }

                if ($request->hasFile('video'))
                {

                    $file = $request->file('video');
                    $fileName = $lec.'_video.'.$file->getClientOriginalExtension();
                    $path = 'assets/video/';

                    $video = Video::where('lecture_id', $lecture->id)->first();
                    if ($video){
                        $video->file = $path.$fileName;
                        if (file_exists(public_path($video->file)))
                        {
                            unlink(public_path($video->file));
                        }
                        $file->move($path, $fileName);
                        $video->update();
                    }else{
                        $file->move($path, $fileName);
                        $video = new Video();
                        $video->file = $path.$fileName;
                        $video->lecture_id = $lecture->id;
                        $video->save();
                    }

                }

                if ($request->hasFile('pdf'))
                {
                    $file = $request->file('pdf');
                    $fileName = $lec.'_pdf.'.$file->getClientOriginalExtension();
                    $path = 'assets/pdf/';


                    $pdf = Pdf::where('lecture_id', $lecture->id)->first();
                    if ($pdf)
                    {
                        $pdf->file = $path.$fileName;
                        if (file_exists(public_path($pdf->file)))
                        {
                            unlink(public_path($pdf->file));
                        }
                        $file->move($path, $fileName);
                        $pdf->update();
                    }else{
                        $file->move($path, $fileName);
                        $pdf = new Pdf();
                        $pdf->file = $path.$fileName;
                        $pdf->lecture_id = $lecture->id;
                        $pdf->save();
                    }

                }

                if ($request->hasFile('ppt'))
                {
                    $file = $request->file('ppt');
                    $fileName = $lec.'_ppt.'.$file->getClientOriginalExtension();
                    $path = 'assets/ppt/';


                    $ppt = Ppt::where('lecture_id', $lecture->id)->first();
                    if ($ppt)
                    {
                        $ppt->file = $path.$fileName;
                        if (file_exists(public_path($ppt->file)))
                        {
                            unlink(public_path($ppt->file));
                        }
                        $file->move($path, $fileName);
                        $ppt->update();
                    }else{
                        $file->move($path, $fileName);
                        $ppt = new Ppt();
                        $ppt->file = $path.$fileName;
                        $ppt->lecture_id = $lecture->id;
                        $ppt->save();
                    }

                }
                if ($request->hasFile('resource'))
                {
                    $file = $request->file('resource');
                    $fileName = $lec.'_resource.'.$file->getClientOriginalExtension();
                    $path = 'assets/resource/';


                    $resource = Resource::where('lecture_id', $lecture->id)->first();
                    if ($resource)
                    {
                        $resource->file = $path.$fileName;
                        if (file_exists(public_path($resource->file)))
                        {
                            unlink(public_path($resource->file));
                        }
                        $file->move($path, $fileName);
                        $resource->update();
                    }else{
                        $file->move($path, $fileName);
                        $resource = new Resource();
                        $resource->file = $path.$fileName;
                        $resource->lecture_id = $lecture->id;
                        $resource->save();
                    }

                }

                Toastr::success('Lecture successfully updated', 'Success');
                return redirect()->back();
            }
        }catch(\Exception $exception){

            Toastr::error($exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
        $chapter_id = $lecture->chapter_id;
        $course_id = Chapter::where('id', $chapter_id)->first();

        Course::find($course_id->course_id)->decrement('lecture', 1);

        $audio = Audio::where('lecture_id', $lecture->id)->first();
        if (file_exists(public_path($audio->file)))
        {
            unlink(public_path($audio->file));
        }

        $video = Video::where('lecture_id', $lecture->id)->first();
        if (file_exists(public_path($video->file)))
        {
            unlink(public_path($video->file));
            Course::find($course_id->course_id)->decrement('total_video', 1);
        }

        $ppt = Ppt::where('lecture_id', $lecture->id)->first();
        if (file_exists(public_path($ppt->file)))
        {
            unlink(public_path($ppt->file));
        }

        $pdf = Pdf::where('lecture_id', $lecture->id)->first();
        if (file_exists(public_path($pdf->file)))
        {
            unlink(public_path($pdf->file));
        }

        $resource = Resource::where('lecture_id', $lecture->id)->first();
        if (file_exists(public_path($resource->file)))
        {
            unlink(public_path($resource->file));
        }

        $lecture->delete();

        Toastr::success('Lecture successfully Deleted', 'Success');
        return redirect()->back();
    }
}
