<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{

    ##### ACCOUNTS HERE, USERS BELOW #####

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account.index')
            ->with('user', auth()->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('account.edit')
            ->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request)
    {
        auth()->user()->update([
            'description' => $request->input('description')
        ]);

        return redirect()->route('account.index')
            ->with('message', ['success', 'Your account has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->user()->delete();
        Auth::logout();

        return redirect()->route('login')
            ->with('message', ['danger', 'Your profile has been deleted!']);
    }



    ##### USERS #####

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersIndex()
    {
        return view('users.index')
            ->with('users', User::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return view('users.show')
            ->with('user', User::where('id', $user_id)->with(['posts', 'comments'])->firstOrFail());
    }
}
