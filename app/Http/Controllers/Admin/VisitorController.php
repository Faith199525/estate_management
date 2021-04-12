<?php

namespace App\Http\Controllers\Admin;

use App\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    /**
     * Fetch User created visitors
     *
     * @return $visitors
     */
    public function userVisitors(Request $request)
    {
        $visitors = $request->user()->visitors()->orderBy('created_at', 'desc')->paginate(20);

        return view('visitors')
            ->with('visitors', $visitors);
    }

    /**
     * update Status of a visitor
     *
     * @param Request $request
     * @return $visitor
     */
    public function updateStatus(Request $request)
    {
        $visitor  = Visitor::find($request->id);
        $visitor->status = $request->status;
        $visitor->save();

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
            $visitors = Visitor::where('name', 'ilike', '%' . $request->q . '%')
                ->orWhere('details', 'ilike', '%' . $request->q . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('admin.visitors.index')
                ->with('visitors', $visitors);
        }
        $visitors = Visitor::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.visitors.index')
            ->with('visitors', $visitors);
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
            'expected_date' => 'required|date',
            'details' => 'required'
        ]);

        $visitor = new Visitor;
        $visitor->name = $request->name;
        $visitor->details = $request->details;
        $visitor->expected_date = $request->expected_date;
        $visitor->user_id = $request->user()->id;
        $visitor->save();

        $request->session()->flash('status', 'Visitor Notification has been sent!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        return view('admin.visitors.show ')->with('visitor', $visitor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
