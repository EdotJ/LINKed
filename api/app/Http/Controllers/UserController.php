<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect(route('home'))->withErrors('Couldn\'t find the user');
        }

        return view('user.profile', ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit()
    {
        return view('user.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->headline = $request->headline;
        $user->phone_number = $request->phone_number;
        $user->birthday = $request->birthday;
        $user->interests = $request->interests;
        if ($user->hasRole('STD')) {
            $user->study_programme = $request->study_programme;
            $user->year = $request->year;
        }
        if ($user->hasRole('CDE') || $user->hasRole('LEC')) {
            if ($user->hasRole('CDE')) {
                $user->company = $request->company;
            }
            $user->title = $request->title;
        }
        $user->description = $request->description;
        $user->save();
        return redirect(route('user.profile', ['id' => Auth::user()->id]))->with('success', "Successfully updated your profile");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
