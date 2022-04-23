<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Team;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
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
            'name' => 'required',
            'designation' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,JPG',
            'status' => 'required',
        ]);

        $image = $request->file('image');
        $imagename = $request->name.'_team.'.$image->getClientOriginalExtension();
        $path = 'assets/images/team/';
        $image->move($path, $imagename);

        $data = new Team();
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->image = $path.$imagename;
        $data->status = $request->status;

        $data->save();

        Toastr::success('Team Member successfully create', 'Success');

        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'image' => 'mimes:jpeg,png,jpg,JPG',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = $request->name.'_team.'.$image->getClientOriginalExtension();
            $path = 'assets/images/team/';

            if (file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }
            $image->move($path, $imagename);
            $img = $path.$imagename;
        }else{
            $img = $team->image;
        }

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->image = $img;
        $team->status = $request->status;

        $team->update();

        Toastr::success('Team Member Information successfully Updated', 'Success');

        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {

        if (file_exists(public_path($team->image)))
        {
            unlink(public_path($team->image));
        }

        $team->delete();

        Toastr::success('Team Member successfully Deleted', 'Success');

        return redirect()->route('admin.teams.index');
    }
}
