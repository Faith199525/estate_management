<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Estate;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EstateController extends Controller
{

    public function home()
    {
        return view('superAdmin.home');
    }

    public function estate()
    {
        $estates = Estate::all();
        return view('superAdmin.estates.index')->with('estates', $estates);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'app_name' => 'required|max:255',
            'full_name' => 'required|max:255',
            'full_address' => 'required|max:255',
            'username' => 'required|max:225',
            'email' =>  'required|max:225, email|unique:users',
        ]);

        $estate = new Estate();
        $estate->app_name = $request->app_name;
        $estate->full_name = $request->full_name;
        $estate->full_address = $request->full_address;
        $estate->save();

        //create estate admin
        $user = new \App\User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make(str_random('EstateAdmin'));
        $user->save();

        $user->estate()->attach($estate->id);

        //create setting for estate
        $setting = new Setting();
        $setting->estate_id = $estate->id;
        $setting->save();

        //Assign admin role 
        $access = new \App\Access;
        $access->role_id = \App\Role::where('name', 'Admin')->first()->id;
        $user->access()->save($access);

        request()->session()->flash('message', 'Estate has been added!');
        return back();
		
    }

    public function show($id)
    {
        $estate = Estate::where('id', $id)->with('user.access')
                    ->whereHas('user.access', function($query){
                        $query->where('role_id', \App\Role::where('name', 'Admin')->first()->id);
                    })
                    ->first();
 
        return view('superAdmin.estates.show')->with('estate', $estate);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'short_name' => 'required|max:255',
            'full_address' => 'required|max:255',
        ]);
        
        $estate = Estate::find($id);
        $estate->app_name = $request->app_name;
        $estate->full_name = $request->full_name;
        $estate->full_address = $request->full_address;
        $estate->save();

        return redirect('/central/estate');
    }

    public function add($id, Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:225',
            'email' =>  'required|max:225, email|unique:users',
        ]);

        $user = new \App\User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make(str_random('EstateAdmin'));
        $user->save();

        $user->estate()->attach($id);

        //Assign admin role 
        $access = new \App\Access;
        $access->role_id = \App\Role::where('name', 'Admin')->first()->id;
        $user->access()->save($access);

        return redirect('/central/estate');
    }

    public function disableAdmin(Type $var = null)
    {
        # code...
    }

    public function destroy(Type $var = null)
    {
        # code...
    }

}
