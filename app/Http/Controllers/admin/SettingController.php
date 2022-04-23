<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::first();
        return view('admin.setting.index', compact('data'));
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //dd($setting->facebook_url);
        return view('admin.setting.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'facebook_url'=>'required|url',
            'youtube_url'=>'required|url',
            'twitter_url'=>'required|url',
            'google_plus_url'=>'required|url',
            'google_map'=>'required|url',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required|email',
            'short_desc'=>'required',
            'our_history'=>'required',
            'our_mission'=>'required',
            'our_vision'=>'required',
            'about_us'=>'required',
            'terms'=>'required',
            'privacy'=>'required',
            'platform_name'=>'required',
            'developer_name'=>'required',
            'developer_link'=>'required|url',
            'featured_image' => 'mimes:jpeg,png,jpg,JPG',
            'logo' => 'mimes:jpeg,png,jpg,JPG',
            'favicon' => 'mimes:jpeg,png,jpg,JPG',
        ]);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imagename = time().'_featured_image.'. $image->getClientOriginalExtension();
            $path = 'assets/images/setting/';
            if (file_exists(public_path($setting->featured_image))) {
                unlink(public_path($setting->featured_image));
            }
            $image->move($path, $imagename);
            $featured_image = $path.$imagename;
        }else{
            $featured_image = $setting->featured_image;
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imagename = time().'_logo.'. $image->getClientOriginalExtension();
            $path = 'assets/images/setting/';
            //return $setting->logo;
            if (file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }
            $image->move($path, $imagename);
            $logo = $path.$imagename;
        }else{
            $logo = $setting->logo;
        }

        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $imagename = time().'_favicon.'. $image->getClientOriginalExtension();
            $path = 'assets/images/setting/';
            if (file_exists(public_path($setting->favicon))) {
                unlink(public_path($setting->favicon));
            }
            $image->move($path, $imagename);
            $favicon = $path.$imagename;
        }else{
            $favicon = $setting->favicon;
        }

        $setting->facebook_url = $request->facebook_url;
        $setting->youtube_url = $request->youtube_url;
        $setting->twitter_url = $request->twitter_url;
        $setting->google_plus_url = $request->google_plus_url;
        $setting->google_map = $request->google_map;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->short_desc = $request->short_desc;
        $setting->our_history = $request->our_history;
        $setting->our_mission = $request->our_mission;
        $setting->our_vision = $request->our_vision;
        $setting->about_us = $request->about_us;
        $setting->terms = $request->terms;
        $setting->privacy = $request->privacy;
        $setting->platform_name = $request->platform_name;
        $setting->developer_name = $request->developer_name;
        $setting->developer_link = $request->developer_link;
        $setting->featured_image = $featured_image;
        $setting->logo = $logo;
        $setting->favicon = $favicon;

        $setting->update();

        Toastr::success('Setting successfully Updated', 'Success');
        return redirect()->route('admin.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
