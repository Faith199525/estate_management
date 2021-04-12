<?php

namespace App\Repositories;

use App\Resident;
use Illuminate\Support\Facades\Storage;

class ResidentRepository
{
    public function getResident($id)
    {
        return Resident::find($id);
    }

    public function createResidentForUser($user, $property)
    {
        return Resident::create([
            'property_id' => $property->id,
            'user_id' => $user->id,
            'email' => $user->email,
            'fullname' => $user->name,
        ]);
    }

    public function store($request)
    {
        $resident = new Resident;
        
        if ($request->hasFile('photo')) {
            if ($resident->photo) {
                Storage::delete($resident->photo); // Delete the old photo from disk
                $resident->photo = $request->file('photo')->store('photos'); // Store new photo
            } else {
                $resident->photo = $request->file('photo')->store('photos');          
            }
        }

        $resident->fullname = $request->fullname;
        $resident->email = $request->email;
        $resident->dob = $request->dob;
        $resident->phone = $request->phone;
        $resident->occupation = $request->occupation;
        $resident->office_address = $request->office_address;
        $resident->marital_status = $request->marital_status;
        $resident->spouse_occupation = $request->spouse_occupation;
        $resident->no_of_occupants = $request->no_of_occupants;
        $resident->occupancy_start_date = $request->occupancy_start_date;
        $resident->no_of_vehicles = $request->no_of_vehicles;
        $resident->vehicle_type_and_registration_numbers = $request->vehicle_type_and_registration_numbers;
    
        $resident->user_id = $request->user_id;
        $resident->property_id = $request->property_id;

        $resident->save();

        return $resident;
    }

    public function update($request, $id)
    {
        $resident = $this->getResident($id);
        
        if ($request->hasFile('photo')) {
            if ($resident->photo) {
                Storage::delete($resident->photo); // Delete the old photo from disk
                $resident->photo = $request->file('photo')->store('photos'); // Store new photo
            } else {
                $resident->photo = $request->file('photo')->store('photos');          
            }
        }

        $resident->fullname = $request->fullname;
        $resident->email = $request->email;
        $resident->dob = $request->dob;
        $resident->phone = $request->phone;
        $resident->occupation = $request->occupation;
        $resident->office_address = $request->office_address;
        $resident->marital_status = $request->marital_status;
        $resident->spouse_occupation = $request->spouse_occupation;
        $resident->no_of_occupants = $request->no_of_occupants;
        $resident->occupancy_start_date = $request->occupancy_start_date;
        $resident->no_of_vehicles = $request->no_of_vehicles;
        $resident->vehicle_type_and_registration_numbers = $request->vehicle_type_and_registration_numbers;

        $resident->save();

        return $resident;
    }
}


