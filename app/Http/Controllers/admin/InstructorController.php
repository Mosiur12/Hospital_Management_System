<?php

namespace App\Http\Controllers\admin;

use App\ContactInformation;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();
        return view('admin.instructor.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
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
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:5',
            'status' => 'required',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->user_type = $request->user_type;
        $data->password = Hash::make($request->password);
        $data->status = $request->status;


        if ($data->save())
        {
            $info = new ContactInformation();
            $info->user_id = $data->id;
            $info->facebook = 'www.facebook.com';
            $info->twitter = 'www.twitter.com';
            $info->instagram = 'www.instagram.com';
            $info->youtube = 'www.youtube.com';
            $info->whatsapp = '01700000000';
            $info->about_me = 'About Me';

            $info->save();
            Toastr::success('Instructor Successfully create', 'Success');
            return redirect()->route('admin.instructors.index');
        }else{
            Toastr::error('Instructor Failed to create', 'Error');
            return redirect()->route('admin.instructors.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $contact = ContactInformation::where('user_id', $id)->first();
        return view('admin.instructor.show', compact('user','contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.instructor.edit', compact('user'));
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

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'status' => 'required',
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password)
        {
            $user->password = Hash::make($request->password);
        }

        $user->status = $request->status;

        $user->update();
        Toastr::success('Instructor Successfully Updated', 'Success');

        return redirect()->route('admin.instructors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=User::find($id)->delete();

        if ($res){
            Toastr::success('Instructor successfully Deleted', 'Success');
        }else{
            Toastr::error('Instructor fail to Deleted', 'Error');
        }

        return redirect()->route('admin.instructors.index');
    }
}
