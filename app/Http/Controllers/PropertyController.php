<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Repositories\PropertyRepository;
use App\Street;
use App\Resident;

class PropertyController extends Controller
{

    public function __construct(PropertyRepository $propertyRepo)
    {
        $this->middleware('auth');
        $this->propertyRepo = $propertyRepo;
    }

    public function showPropertyResident(Request $request)
    {
        $resident = Resident::find($request->rid);
        if ($resident->property->id != $request->pid) {
            request()->session()->flash('error', 'Requested Resident does not stay in property!');
            return back();
        }
        return view('view_resident_details')->with('resident', $resident);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $properties = $user->properties;
        $streets = \App\Street::orderBy('details', 'asc')->get();

        return view('properties')
            ->with('streets', $streets)
            ->with('properties', $properties);
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
            'house_no' => 'required|max:255',
            'street_id' => 'required|max:255',
            'zone' => 'required|max:255',
            'building_type' => 'required',
            'no_of_apartments' => 'required|numeric',
        ]);
        $property = $this->propertyRepo->store($request);

        request()->session()->flash('message', 'Property has been added!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('show_property')->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $streets = Street::all();
        return view('edit_property')->with('streets', $streets)->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $validatedData = $request->validate([
            'house_no' => 'required|max:255',
            'street_id' => 'required|max:255',
            'zone' => 'required|max:255',
            'building_type' => 'required',
            'no_of_apartments' => 'required|numeric',
        ]);

        request()->session()->flash('message', 'Property has been updated!');
        $property = $this->propertyRepo->update($request, $property);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if ($property->residents()->count() > 0) {
            session()->flash('error', 'Sorry! Properties with residents can not be deleted.');

            return back();
        }
        $property->delete();

        session()->flash('status', 'Delete was successful');
        return redirect('/properties');
    }
}
