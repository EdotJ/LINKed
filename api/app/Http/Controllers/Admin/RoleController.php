<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('hasRole:ADM');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index', ['users' => User::all()]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(!$user->hasRole("ADM"))
        {
            return view('admin.roles.edit', ['user' => $user, 'roles' => Role::all()]);
        }
        else
            return redirect(route('roles.index'))->withErrors("You cannot change administrator's role");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $role = Role::findOrFail($request->role);
        $user->role()->associate($role);
        $user->save();
        return redirect(route('roles.index'))->with('success', 'Successfully updated user role');
    }


    /**
     * @param User $user
     */
    public function disable(User $user)
    {
        if ($user->isBlocked()) {
            $user->is_blocked = 0;
            $user->save();
            return redirect(route('roles.index'))->with('success', 'Successfully unblocked user ' . $user->name);
        }
        $user->is_blocked = 1;
        $user->save();
        return redirect(route('roles.index'))->with('success', 'Successfully blocked user ' . $user->name);
    }
}
