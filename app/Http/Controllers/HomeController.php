<?php

namespace App\Http\Controllers;

use App\Street;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This is a quick link to the faq page
     */
    public function guide()
    {
        return view('guide');
    }

    public function estate()
    {
        $user = \Auth::user()->with('estate');
        //\Session::put('estate', $estate);
        if(count($user->estate) == 1){
            \Session::put('current_estate', $estate);
            
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $profileStatus = [];

        // Check if the landlord profile has been completed
        $landlordProfile = $user->landlord;
        if ($landlordProfile &&  array_except($landlordProfile, ['created_at', 'updated_at','deleted_at'])) {
            $profileStatus['isLandlord'] = true;

            // Checks if users landlord profile has been completed
            if (! in_array(null, $landlordProfile->toArray(), true)) {
                $profileStatus['landlordProfileCompleted'] = true;
            }
        }

        // check if user has properties
        if ($user->properties->isNotEmpty()) {
            $profileStatus['hasProperties'] = true;
        }

        // checks that user has tenants attached to properties
        if ($user->tenants()->isNotEmpty()) {
            $profileStatus['hasResidents'] = true;
        }

        // Checks if user has a resident profile
        if ($user->residents->isNotEmpty()) {
            $profileStatus['isResident'] = true;

            // Checks if users resident profile has been completed
            $residentProfile = $user->residents->first();
            if ($residentProfile && array_except($residentProfile, ['created_at', 'updated_at','deleted_at'])) {
                if (! in_array(null, $residentProfile->toArray(), true)) {
                    $profileStatus['residentProfileCompleted'] = true;
                }
            }
        }


        $properties = $user->properties;
        $streets = \App\Street::orderBy('details', 'asc')->get();
        return view('home')->with('properties', $properties)
            ->with('profileStatus', $profileStatus)
            ->with('streets', $streets);
     
    }
}
