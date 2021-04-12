<?php

namespace App\Http\Controllers\Admin;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Fetch User created staffs
     *
     * @return $staffs
     */
    public function userStaffs(Request $request)
    {
        $staffs = $request->user()->staffs()->orderBy('created_at', 'desc')->paginate(20);

        return view('main.staffs.index')
            ->with('staffs', $staffs);
    }

    /**
     * update Status of a staff
     *
     * @param Request $request
     * @return $staff
     */
    public function updateStatus(Request $request)
    {
        $staff  = Staff::find($request->id);
        $staff->status = $request->status;
        $staff->save();

        $request->session()->flash('info', "Status has been updated!");
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $staffs = Staff::where('name', 'ilike', '%' . $request->q . '%')
                ->orWhere('details', 'ilike', '%' . $request->q . '%')
                ->orWhere('job', 'ilike', '%' . $request->q . '%')
                ->orWhere('state', 'ilike', '%' . $request->q . '%')
                ->orWhere('phone', 'ilike', '%' . $request->q . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('admin.staffs.index')
                ->with('staffs', $staffs);
        }
        $staffs = Staff::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.staffs.index')
            ->with('staffs', $staffs);
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
            'name' => 'required|max:255',
            'photo' => 'required|image|max:200',
            'gender' => 'required|max:255',
            'job' => 'required|max:255',
            'state' => 'max:255',
            'phone' => 'max:255',
            'email' => 'max:255',
        ]);


        $staff = new Staff;

        if ($request->hasFile('photo')) {
            if ($staff->photo) {
                \Storage::delete($staff->photo); // Delete the old photo from disk
                $staff->photo = $request->file('photo')->store('photos'); // Store new photo
            } else {
                $staff->photo = $request->file('photo')->store('photos');
            }
        }

        $staff->name = $request->name;
        $staff->gender = $request->gender;
        $staff->state = $request->state;
        $staff->phone = $request->phone;
        $staff->job = $request->job;
        $staff->email = $request->email;
        $staff->details = $request->details;

        $staff->host_id = $request->user()->id;
        $staff->save();

        $request->session()->flash('status', 'Staff has been Registered!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return view('main.staffs.show ')->with('staff', $staff);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function showAdmin(Request $request)
    {
        $staff = Staff::find($request->id);
        return view('admin.staffs.show ')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|max:255',
            'photo' => 'image|max:200',
            'gender' => 'required|max:255',
            'job' => 'required|max:255',
            'state' => 'max:255',
            'phone' => 'max:255',
            'email' => 'max:255',
        ]);

        if ($request->hasFile('photo')) {
            if ($staff->photo) {
                \Storage::delete($staff->photo); // Delete the old photo from disk
                $staff->photo = $request->file('photo')->store('photos'); // Store new photo
            } else {
                $staff->photo = $request->file('photo')->store('photos');
            }
        }
        $staff->name = $request->name;
        $staff->gender = $request->gender;
        $staff->state = $request->state;
        $staff->phone = $request->phone;
        $staff->job = $request->job;
        $staff->email = $request->email;
        $staff->details = $request->details;
        $staff->save();

        $request->session()->flash('status', 'Staff has been Registered!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        if ($staff->photo) {
            \Storage::delete($staff->photo); // Delete the old photo from disk
        }
        $staff->delete();

        request()->session()->flash('message', 'Staff has been Deleted!');
        return redirect('/staffs');
    }
}
