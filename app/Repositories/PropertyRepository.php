<?php
namespace App\Repositories;

use App\Property;

class PropertyRepository
{
    public function getPropety($id)
    {
        return Property::find($id);
    }

    public function store($request)
    {
        $landlord = \Auth::user()->landlord;

        $property = new Property;
        $property->house_no = $request->house_no;
        $property->street_id = $request->street_id;
        $property->zone = $request->zone;
        $property->address = $request->house_no . ', ' . \App\Street::find($request->street_id)->details . ', zone ' . $request->zone;
        $property->building_type = $request->building_type;
        $property->no_of_apartments = $request->no_of_apartments;

        $landlord->properties()->save($property);



        return $property;
    }

    public function update($request, $property)
    {
        $property->house_no = $request->house_no;
        $property->street_id = $request->street_id;
        $property->zone = $request->zone;
        $property->address = $request->house_no . ', ' . \App\Street::find($request->street_id)->details . ', zone ' . $request->zone;
        $property->building_type = $request->building_type;
        $property->no_of_apartments = $request->no_of_apartments;
        $property->save();

        return $property;
    }
}


