<?php

namespace App\Http\Controllers\Admin;

use App\Incident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class IncidentController extends Controller
{
    /**
     * Fetch User created incidents
     *
     * @return $incidents
     */
    public function userIncidents(Request $request)
    {
        $incidents = $request->user()->incidents()->orderBy('created_at', 'desc')->paginate(20);

        return view('incidents')
            ->with('incidents', $incidents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $incidents = Incident::where('title', 'ilike', '%' . $request->q . '%')
                ->orWhere('details', 'ilike', '%' . $request->q . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            return view('admin.incidents.index')
                ->with('incidents', $incidents);
        }
        $incidents = Incident::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.incidents.index')
            ->with('incidents', $incidents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 404;
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
            'title' => 'required|max:255',
            'details' => 'required'
        ]);

        $incident = new Incident;
        $incident->title = $request->title;
        $incident->details = $request->details;
        $incident->user_id = $request->user()->id;
        $incident->save();

        $request->session()->flash('status', 'Incident has been sent!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        return view('admin.incidents.show ')->with('incident', $incident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function edit(Incident $incident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incident $incident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        //
    }
}
