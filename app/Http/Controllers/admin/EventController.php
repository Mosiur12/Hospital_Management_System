<?php

namespace App\Http\Controllers\admin;

use App\Event;
use App\EventRegistration;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function registration($id)
    {
        $registrationUser = EventRegistration::where('event_id', $id)->get();
        return view('admin.event.registration', compact('registrationUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $speakers = User::where('user_type', 'instructor')->get();
        return view('admin.event.create', compact('speakers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        /*dd($request);*/
        /*$product_json = json_encode($request->event_speaker);
        $product_json = json_decode($product_json);
        dd($product_json);*/

        $request->validate([
            'title'=>'required',
            'place'=>'required',
            'location'=>'required|url',
            'total_seat'=>'required',
            'desc'=>'required',
            'short_desc'=>'required',
            'event_date'=>'required',
            'event_time'=>'required',
            'event_speaker'=>'required',
            'img' => 'required|mimes:jpeg,png,jpg,JPG',
            'status'=>'required'
        ]);




        $image = $request->file('img');
        $imagename = time().'_event.'.$image->getClientOriginalExtension();
        $path = 'assets/images/event/';
        $image->move($path, $imagename);

        $event = new Event();
        $event->title = $request->title;
        $event->place = $request->place;
        $event->location = $request->location;
        $event->total_seat = $request->total_seat;
        $event->short_desc = $request->short_desc;
        $event->desc = $request->desc;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->event_speaker = json_encode($request->event_speaker);
        $event->img = $path.$imagename;
        $event->status = $request->status;
        $event->save();

        Toastr::success('Event successfully create', 'Success');
        return redirect()->route('admin.events.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('admin.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $speakers = User::where('user_type', 'instructor')->get();
        return view('admin.event.edit', compact('speakers', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        $request->validate([
            'title'=>'required',
            'place'=>'required',
            'location'=>'required|url',
            'total_seat'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'event_date'=>'required',
            'event_time'=>'required',
            'event_speaker'=>'required',
            'img' => 'mimes:jpeg,png,jpg,JPG',
            'status'=>'required'
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imagename = time().'_event.'.$image->getClientOriginalExtension();
            $path = 'assets/images/event/';

            if (file_exists(public_path($event->img))) {
                unlink(public_path($event->img));
            }
            $image->move($path, $imagename);
            $img = $path.$imagename;
        }else{
            $img = $event->img;
        }

        $event->title = $request->title;
        $event->place = $request->place;
        $event->location = $request->location;
        $event->total_seat = $request->total_seat;
        $event->short_desc = $request->short_desc;
        $event->desc = $request->desc;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->event_speaker = $request->event_speaker;
        $event->img = $img;
        $event->status = $request->status;
        $event->update();

        Toastr::success('Event successfully Updated', 'Success');
        return redirect()->route('admin.events.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (file_exists(public_path($event->img)))
        {
            unlink(public_path($event->img));
        }
        $event->delete();

        Toastr::success('Event successfully Deleted', 'Success');
        return redirect()->route('admin.events.index');
    }
}
