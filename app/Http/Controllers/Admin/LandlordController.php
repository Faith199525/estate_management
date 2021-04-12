<?php

namespace App\Http\Controllers\Admin;

use App\Landlord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LandlordRepository;

class LandlordController extends Controller
{

    public function __construct(LandlordRepository $landlordRepo)
    {
        $this->middleware('auth');
        $this->landlordRepo = $landlordRepo;
    }


    public function getProfile()
    {
        $user = \Auth::user();

        if ($user->landlord) {
            $landlord = $user->landlord;
            return view('landlord')
                ->with('landlord', $landlord);
        } else {
            return back()
                ->with('error', 'You do not have a landlord profile. Tell Admin to activate you for a landlord profile');
        }
    }

    public function editProfile()
    {
        $user = \Auth::user();
        if ($user->landlord) {
            $landlord = $user->landlord;
            return view('landlord_edit')
                ->with('landlord', $landlord);
        } else {
            return back()
                ->with('error', 'You do not have a landlord profile. Tell Admin to activate you for a landlord profile');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $landlords = Landlord::where('fullname', 'ilike', '%' . $request->q . '%')
                ->orWhere('email', 'ilike', '%' . $request->q . '%')
                ->orderBy('fullname', 'asc')
                ->paginate(20);
            return view('admin.landlords.index')
                ->with('landlords', $landlords);
        }
        $landlords = Landlord::orderBy('fullname', 'asc')->paginate(20);
        return view('admin.landlords.index')
            ->with('landlords', $landlords);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function show(Landlord $landlord)
    {
        return view('admin.landlords.show')->with('landlord', $landlord);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function edit(Landlord $landlord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Landlord $landlord)
    {
        //
    }


    public function updateProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'occupation' => 'max:255',
            'address' => 'required',
            'agree' => 'required',
        ]);

        // return $id;

        $landlord = $this->landlordRepo->update($request, $id);

        return redirect('landlords-profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Landlord $landlord)
    {
        //
    }
}
