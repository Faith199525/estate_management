<?php

namespace App\Http\Controllers\Admin;

use App\Street;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $streets = Street::where('details', 'ilike', '%' . $request->q . '%')
                ->orderBy('details', 'asc')
                ->paginate(20);
            return view('admin.streets.index')
                ->with('streets', $streets);
        }
        $streets = Street::orderBy('details', 'asc')->paginate(20);
        return view('admin.streets.index')
        ->with('streets', $streets);
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
        $validatedData = $request->validate([
            'details' => 'required',
        ]);
        $street = new Street;
        $street->details = $request->details;
        $street->save();

        request()->session()->flash('message', 'Street has been added!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function show(Street $street)
    {
        return view('admin.streets.show')->with('street', $street);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function edit(Street $street)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Street $street)
    {
        $validatedData = $request->validate([
            'details' => 'required',
        ]);

        $street->details = $request->details;
        $street->save();

        request()->session()->flash('message', 'Street has been updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function destroy(Street $street)
    {
        if ($street->properties->isNotEmpty()) {
            request()->session()
                ->flash('error', 'Could not delete Street. There are properties on this street! Try editing details instead.');
            return back();
        }

        $street->delete();

        request()->session()->flash('message', 'Street has been Deleted!');
        return redirect('admin/streets');
    }
}
