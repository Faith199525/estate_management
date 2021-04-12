<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Resident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ResidentRepository;
use App\Property;
use App\Landlord;
use App\Street;
use App\User;

class ResidentController extends Controller
{
    public function __construct(ResidentRepository $residentRepo)
    {
        $this->middleware('auth');
        $this->residentRepo = $residentRepo;
    }

    public function activateLandlordResidentProfile(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'required',
        ]);

        $user = \Auth::user();
        $property = Property::find($request->property_id);
        $residentProfile = $this->residentRepo->createResidentForUser($user, $property);

        $request->session()->flash('message', 'Success! A resident profile has been activated for you. Kindly update your details');
        return redirect('/resident-profile/' . $residentProfile->id. '/edit');
    }

    public function getProfile()
    {
        $user = \Auth::user();

        $residents = $user->residents;
        if ($residents->isNotEmpty()) {
            return view('resident')
                ->with('residents', $residents);
        } else {
            return back()
                ->with('error', 'You do not have a resident profile. Tell your Landlord to activate you for a resident profile');
        }
    }

    public function editProfile($id)
    {
        $resident = Resident::find($id);
        if ($resident->user->id != \Auth::user()->id) {
            return back()->with('error', 'You do not have the necessary permissions to access that resident profile');
        }

        return view('resident_edit')
            ->with('resident', $resident);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $residents = Resident::where('fullname', 'ilike', '%' . $request->q . '%')
                ->orWhere('email', 'ilike', '%' . $request->q . '%')
                ->orderBy('fullname', 'asc')
                ->paginate(20);
            return view('admin.residents.index')
                ->with('residents', $residents);
        }
        $residents = Resident::orderBy('fullname', 'asc')->paginate(20);
        return view('admin.residents.index')
            ->with('residents', $residents);
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

    public function addResidentProfile()
    {
        $streets = Street::all();
        $resident = new Resident();
        $landlord = new Landlord();
        return view('admin.residents.add_resident')
            ->with('resident', $resident)
            ->with('streets', $streets)
            ->with('landlord', $landlord);
    }

    // This is ony accesible to the Admin
    public function createResidentProfile(Request $request)
    {
        $validatedData = $request->validate([
            'landlord_fullname' => 'required|max:255',
            'landlord_phone' => 'max:255',
            'landlord_email' => 'required|max:255',
            // 'landlord_address' => 'required',

            'house_no' => 'required|max:255',
            'street_id' => 'required|max:255',

            'photo' => 'image|max:200',
            'fullname' => 'required|max:255',
            'email' => 'required|max:255',
            'dob' => 'required|max:255',
            'phone' => 'required|max:255',
            'occupation' => 'required|max:255',
            'office_address' => 'required',
            'marital_status' => 'required|max:255',
            'spouse_occupation' => 'required|max:255',
            'no_of_occupants' => 'required|max:255|numeric',
            'occupancy_start_date' => 'required|max:255',
            'no_of_vehicles' => 'required|max:255|numeric',
            'vehicle_type_and_registration_numbers' => 'required',
        ]);

        $landordUser = User::firstOrCreate([
            'email' => $request->landlord_email,
        ], [
            'name' => $request->landlord_fullname,
            'password' => Hash::make(str_random(8)),
        ]);

        $residentUser = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->fullname,
            'password' => Hash::make(str_random(8)),
        ]);


        if ($landordUser->landlord) {
            $landlord = $landordUser->landlord;
        } else {
            $landlord = new Landlord;
            $landlord->user_id = $landordUser->id;
            $landlord->fullname = $request->landlord_fullname;
            $landlord->phone = $request->landlord_phone;
            $landlord->email = $request->landlord_email;
            $landlord->address = $request->landlord_address;
            $landlord->save();
        }

        $property = Property::firstOrCreate([
            'landlord_id' => $landlord->id,
            'street_id' => $request->street_id,
            'house_no' => $request->house_no,
        ], [
            'address' => $request->house_no . ', ' . \App\Street::find($request->street_id)->details,
        ]);

        if (Resident::where('user_id', $residentUser->id)->where('property_id', $property->id)->first()) {
            $request->session()->flash('error', "Data of User with Email Address: {$residentUser->email} and Residence at {$property->address} already exists in database!");
            return back();
        } else {
            $request->request->add(['user_id' => $residentUser->id, 'property_id' => $property->id]);
            $resident = $this->residentRepo->store($request);
            // $resident = $this->residentRepo->store($request->all() + ['user_id' => $residentUser->id, 'property_id' => $property->id]);

            $request->session()->flash('message', "{$resident->fullname}'s Data Upload was Successful!");
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        return view('admin.residents.show')->with('resident', $resident);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resident $resident)
    {
        //
    }

    public function updateProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'photo' => 'image|max:200',
            'fullname' => 'required|max:255',
            'email' => 'required|max:255',
            'dob' => 'required|max:255',
            'phone' => 'required|max:255',
            'occupation' => 'required|max:255',
            'office_address' => 'required',
            'marital_status' => 'required|max:255',
            'spouse_occupation' => 'required|max:255',
            'no_of_occupants' => 'required|max:255|numeric',
            'occupancy_start_date' => 'required|max:255',
            'no_of_vehicles' => 'required|max:255|numeric',
            'vehicle_type_and_registration_numbers' => 'required',
        ]);

        $resident = $this->residentRepo->update($request, $id);

        $request->session()->flash('message', 'Update Successful!');

        return redirect('resident-profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resident $resident)
    {
        //
    }
}
