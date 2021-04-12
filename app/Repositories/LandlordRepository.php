<?php

namespace App\Repositories;

use App\Landlord;
use App\User;

class LandlordRepository
{
    public function getLandlord($id)
    {
        return Landlord::find($id);
    }

    // public function getOrCreateLandlordFromUser(User $user)
    // {
    //     $landlord = $user->landlord;

    //     if ($landlord) {
    //         return $landlord;
    //     } else {
    //         return $this->createLandlordForUser($user);
    //     }
    // }

    public function createLandlordForUser($user)
    {
        return Landlord::create([
            'user_id' => $user->id, 
            'email' => $user->email,
            'fullname' => $user->name,
        ]);
    }

    public function update($request, $id)
    {
        $landlord = $this->getLandlord($id);

        $landlord->fullname = $request->fullname;
        $landlord->phone = $request->phone;
        $landlord->email = $request->email;
        $landlord->address = $request->address;
        $landlord->current_residential_address = $request->current_residential_address;
        $landlord->occupation = $request->occupation;
        $landlord->office_address = $request->office_address;
        $landlord->save();

        return $landlord;
    }


}


