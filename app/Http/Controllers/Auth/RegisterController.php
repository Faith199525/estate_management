<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\LandlordRepository;
use App\Repositories\ResidentRepository;
use App\Repositories\PropertyRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LandlordRepository $landlord, ResidentRepository $resident, PropertyRepository $property)
    {
        $this->middleware('guest');
        $this->landlord = $landlord;
        $this->resident = $resident;
        $this->property = $property;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'agree' => ['required'],
        ]);

        if (!$invite = \App\Invite::where('token', \Session::get('invite-key'))->first()) {
            return view('errors.invalid_token');
        }

        $validator->after(function ($validator) use ($data, $invite) {
            if ($data['email'] != $invite->email) {
                $validator->errors()->add('email', 'Invite email is different from what you are using');
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $invite = \App\Invite::where('token', \Session::get('invite-key'))->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->estate()->attach($invite->estate_id);

        if ($invite->property_id) {
            $property = $this->property->getPropety($invite->property_id);
            $this->resident->createResidentForUser($user, $property);
        } else {
            $this->landlord->createLandlordForUser($user);
        }

        $invite->delete();

        return $user;
    }
}
