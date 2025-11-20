<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Career;
use Auth;
use Session;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::orderBy('created_at', 'DESC')->get();
        return view('admins.careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::guard('admin')->user()->id;
        
        //validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'description'   => 'required',
            'requirements' => 'nullable',
            'location'     => 'nullable|max:255',
            'type'         => 'nullable|max:255',
            'department'   => 'nullable|max:255',
            'salary_min'   => 'nullable|numeric',
            'salary_max'   => 'nullable|numeric',
            'deadline'     => 'nullable|date',
            'status'       => 'required|in:0,1'
        ));

        //store in the database
        $career = new Career;
        $career->title = $request->title;
        $career->description = $request->description;
        $career->requirements = $request->requirements;
        $career->location = $request->location;
        $career->type = $request->type;
        $career->department = $request->department;
        $career->salary_min = $request->salary_min;
        $career->salary_max = $request->salary_max;
        $career->deadline = $request->deadline;
        $career->status = $request->status;
        $career->created_by = $user_id;
        $career->save();

        //session flashing
        Session::flash('success', 'Career successfully created!');

        //return to the show page
        return redirect()->route('career.show', $career->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $career = Career::findOrFail($id);
        return view('admins.careers.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $career = Career::findOrFail($id);
        return view('admins.careers.edit', compact('career'));
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
        $user_id = Auth::guard('admin')->user()->id;
        
        //validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'description'   => 'required',
            'requirements' => 'nullable',
            'location'     => 'nullable|max:255',
            'type'         => 'nullable|max:255',
            'department'   => 'nullable|max:255',
            'salary_min'   => 'nullable|numeric',
            'salary_max'   => 'nullable|numeric',
            'deadline'     => 'nullable|date',
            'status'       => 'required|in:0,1'
        ));

        //save the data to the database
        $career = Career::findOrFail($id);
        $career->title = $request->title;
        $career->description = $request->description;
        $career->requirements = $request->requirements;
        $career->location = $request->location;
        $career->type = $request->type;
        $career->department = $request->department;
        $career->salary_min = $request->salary_min;
        $career->salary_max = $request->salary_max;
        $career->deadline = $request->deadline;
        $career->status = $request->status;
        $career->updated_by = $user_id;
        $career->save();

        //session flashing
        Session::flash('success', 'Career successfully updated!');

        //return to the show page
        return redirect()->route('career.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        //session flashing
        Session::flash('success', 'Career successfully deleted!');

        //return to the index page
        return redirect()->route('career.index');
    }
}

