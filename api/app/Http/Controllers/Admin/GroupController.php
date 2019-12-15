<?php

namespace App\Http\Controllers\Admin;

use App\AcademicGroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
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
        return view('admin.groups.index', ['users' => User::students()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new AcademicGroup;
        $group->shorthand_code = $request->shorthand;
        $group->save();
        dd($group);
        return redirect(route('groups.index'))->with('success', "Added new group successfully");
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
        return view('admin.groups.edit', ['user' => $user, 'groups' => AcademicGroup::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
        if ($user->hasRole('STD')) {
            $newGroup = AcademicGroup::findOrFail($request->group);
            $user->academicGroup()->associate($newGroup);
            $user->save();
            return redirect(route('groups.index'))->with('success', 'Successfully updated student\'s ' . $user->name . ' group');

        }
        return redirect(route('groups.index'))->withErrors('User is not a student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
