<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invite;
use App\Mail\ResidentInviteCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\LandlordInviteCreated;

class InviteController extends Controller
{
    public function residentInviteForm()
    {
        // show the user a form to invite a new user by email
        $user = \Auth::user();

        return view('resident_invite')->with('properties', $user->properties);
    }

    public function landlordInviteForm()
    {
        // show the user a form to invite a new user by email 
        return view('admin.landlords.landlord_invite');
    }

    public function inviteResidents(Request $request)
    {
        // validate the incoming request data
        $validatedData = $request->validate([
            'emails' => 'required',
            'property' => 'required',
        ]);

        $emails = $request->emails;
        $emailArray = array_map('trim', explode(',', $emails));
        // $emailArray = preg_split("/ (,| ) /", $emails);

        $validEmails = [];
        $nonValidEmails = [];

        // process the Emails for vaidity
        foreach ($emailArray as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;

                do {
                    //generate a random string using Laravel's str_random helper
                    $token = str_random();
                } while (Invite::where('token', $token)->first()); //check if the token already exists and if it does, try again  

                $property = \App\Property::find($request->property);
                $invite = Invite::create([
                    'email' => $email,
                    'property_id' => $request->property,
                    'token' => $token,
                    'estate_id' => $property->estate_id
                ]);
                Mail::to($email)->send(new ResidentInviteCreated($invite));
            } else {
                $nonValidEmails[] = $email;
            }
        }

        return back()
            ->with('validEmails', $validEmails)
            ->with('nonValidEmails', $nonValidEmails);

    }

    public function inviteLandlords(Request $request)
    {
        // validate the incoming request data
        $validatedData = $request->validate([
            'emails' => 'required',
        ]);

        $emails = $request->emails;
        $emailArray = array_map('trim', explode(',', $emails));
        // $emailArray = preg_split("/ (,| ) /", $emails);

        $validEmails = [];
        $nonValidEmails = [];

        // process the Emails for vaidity
        foreach ($emailArray as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;

                do {
                    //generate a random string using Laravel's str_random helper
                    $token = str_random();
                } while (Invite::where('token', $token)->first()); //check if the token already exists and if it does, try again  
                
                $estate = \Auth::user()->with('estate'); //admin making the invite
                $invite = Invite::create([
                    'email' => $email,
                    'token' => $token,
                    'estate_id' => $estate->estate->id
                ]);
                Mail::to($email)->send(new LandlordInviteCreated($invite));
            } else {
                $nonValidEmails[] = $email;
            }
        }

        return back()
            ->with('validEmails', $validEmails)
            ->with('nonValidEmails', $nonValidEmails);

    }

    public function accept($token)
    {
        if (\Auth::check()) {
            return redirect('home')->with('error', 'You can not use an invite when you are curenty logged in. Kindly log out first');
        }
        // Look up the invite
        $invite = Invite::where('token', $token)->first();
        if (!$invite) {
            return view('errors.invalid_token');
        }
        if($user = \App\User::where('email', $invite->email)->first()){ //since a user can belong to multiple estate. If user is already registeref in the app
            $user->estate()->attach($invite->estate_id);
            $invite->delete();
            return redirect('/login');
        }
        \Session::put('invite-key', $token);

        return redirect('/register');
    }
}
