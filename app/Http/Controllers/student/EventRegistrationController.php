<?php

namespace App\Http\Controllers\student;

use App\Event;
use App\EventRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = EventRegistration::where('user_id', auth()->user()->id)->orderByDesc('id')->get();
        return view('student.event.index', compact('events'));
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
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('student.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventRegistration $eventRegistration)
    {
        //
    }
}
