<?php

namespace App\Http\Controllers\Admin;

use App\Due;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $dues = Due::where('name', 'ilike', '%' . $request->q . '%')
                ->orWhere('details', 'ilike', '%' . $request->q . '%')
                ->orWhere('amount', 'ilike', '%' . $request->q . '%')
                ->orderBy('created_at', 'asc')
                ->paginate(20);
            return view('admin.dues.index')
                ->with('dues', $dues);
        }
        $dues = Due::orderBy('created_at', 'asc')->paginate(20);
        return view('admin.dues.index')
            ->with('dues', $dues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
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
            'name' => 'required|max:255',
            'type' => 'required',
            'payer' => 'required',
            'amount' => 'required|numeric',
        ]);

        $due = new Due;
        $due->name = $request->name;
        $due->details = $request->details;
        $due->type = $request->type; //Types are daily, weekly, monthly, yearly, oneTime dues
        $due->payer = $request->payer; //payers are residents, landlords, residentlandords
        $due->amount = $request->amount * 100; // Amount is saved in kobo
        $due->save();

        request()->session()->flash('message', 'Due has been added!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Due  $due
     * @return \Illuminate\Http\Response
     */
    public function show(Due $due)
    {
        return view('admin.dues.show')->with('due', $due);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Due  $due
     * @return \Illuminate\Http\Response
     */
    public function edit(Due $due)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Due  $due
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Due $due)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'payer' => 'required',
            'amount' => 'required|numeric',
        ]);

        $due->name = $request->name;
        $due->details = $request->details;
        $due->type = $request->type; //Types are daily, weekly, monthly, yearly, oneTime dues
        $due->payer = $request->payer; //payers are residents, landlords, residentlandords
        $due->amount = $request->amount * 100; // Amount is saved in kobo
        $due->save();

        request()->session()->flash('message', 'Due has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Due  $due
     * @return \Illuminate\Http\Response
     */
    public function destroy(Due $due)
    {
        $due->delete();

        request()->session()->flash('message', 'Due has been Deleted!');
        return redirect('admin/dues');
    }
}
