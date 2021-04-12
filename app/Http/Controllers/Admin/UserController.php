<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Access;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('admin.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $users = User::where('name', 'ilike', '%' . $request->q . '%')
                ->orWhere('email', 'ilike', '%' . $request->q . '%')
                ->orderBy('name', 'asc')
                ->paginate(20);
            return view('admin.users.index')
                ->with('users', $users);
        }
        $users = User::orderBy('name', 'asc')->paginate(20);
        return view('admin.users.index')
            ->with('users', $users);
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

    public function role(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ]);

        //TODO: Check that the innitiator has the permission to grant role
        if ($request->role) {
            $user = User::find($request->id);
            $access = $user->access;
            if ($access) {
                if ($request->role == 'remove') {
                    $access->delete();
                } else {
                    $access->role_id = $request->role;
                    $access->save();
                }

                request()->session()->flash('message', 'User Role has been updated!');

                return back();
            } else {
                $access = new Access;
                $access->role_id = $request->role;
                $user->access()->save($access);

                request()->session()->flash('message', 'User has been granted Role!');

                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        if (! auth()->user()->hasPermission('grant_admin_role')) {
            $roles = $roles->reject(function ($value, $key)
            {
                return $value->name == "Admin";
            });
        }

        $payments = $user->payments()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.show')
            ->with('roles', $roles)
            ->with('user', $user)
            ->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
