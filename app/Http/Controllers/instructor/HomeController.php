<?php

namespace App\Http\Controllers\instructor;

use App\ContactInformation;
use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \auth()->user()->id;
        $courses = Course::where('instructor_id', $id)->get();
        $data['students'] = 0;
        $data['reviews'] = 0;

        foreach ($courses as $course)
        {
            $data['students'] += $course->total_student;
            $data['reviews'] += $course->reviews;
        }
        return view('instructor.dashboard', $data);

    }

    public function changePassword()
    {
        return view('instructor.password.edit');
    }

    public function passwordUpdate(Request $request)
    {

        $request->validate([
            'old_pass'=>'required',
            'password' => 'required|confirmed|min:5',
        ]);
        $hashPassword = Auth::user()->password;
        if (Hash::check($request->old_pass, $hashPassword))
        {
            if (!Hash::check($request->password, $hashPassword))
            {
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->update();
                Auth::logout();
                Toastr::success('Your password successfully Updated', 'Success');
                return redirect()->back();

            }else{
                Toastr::error('New password same as old password', 'Error');
                return redirect()->back();
            }
        }else{
            Auth::logout();
            Toastr::error('New password same as old password', 'Error');
            return redirect()->back();
        }
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

    public function profile()
    {
        $id = Auth::user()->id;
        $info = User::where('id', $id)->first();
        $contact = ContactInformation::where('user_id', $id)->first();
        //return $contact;
        return view('instructor.profile.index', compact('info', 'contact'));
    }


    //edit profile
    public function profileEdit()
    {
        $id = Auth::user()->id;
        $info = User::where('id', $id)->first();
        $contact = ContactInformation::where('user_id', $id)->first();
        //return $contact;
        // $contact = DB::table('contact_info')->where('user_id','=', $id)->first();
        //$contact = DB::table('contact_info')->find($id);
        return view('instructor.profile.edit', compact('info', 'contact'));
    }

    //profile update
    public function profileUpdate($id, Request $request)
    {

        //return $request->whatsapp;
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required|min:11',
            'about_me'=>'required',
            'designation'=>'required',
            'facebook'=>'required|url',
            'youtube'=>'required|url',
            'twitter'=>'required|url',
            'instagram'=>'required|url',
            'whatsapp'=>'required|min:11',
            'image' => 'mimes:jpeg,png,jpg,JPG',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'_profile.'.$image->getClientOriginalExtension();
            $path = 'assets/images/profile/';

            if (file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $image->move($path, $imagename);
            $img = $path.$imagename;
        }else{
            $img = $user->image;
        }

        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->image = $img;

        $userInfo = ContactInformation::where('user_id', $id)->first();
        $userInfo->about_me = $request->about_me;
        $userInfo->designation = $request->designation;
        $userInfo->facebook = $request->facebook;
        $userInfo->youtube = $request->youtube;
        $userInfo->twitter = $request->twitter;
        $userInfo->instagram = $request->instagram;
        $userInfo->whatsapp = $request->whatsapp;


        $user->update();
        $userInfo->update();

        Toastr::success('Profile successfully updated', 'Success');
        return redirect()->route('instructor.profile');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
