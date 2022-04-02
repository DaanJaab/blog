<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
     * @param  string  $slug
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $user = User::find(auth()->user()->id);
        $user->update([
            'description' => $request->input('description')
        ]);

        return redirect()->route('account.index')
            ->with('message', ['success', 'Your account has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = User::find(auth()->user()->id);
        Auth::logout();
        $user->delete();

        return redirect()->route('login')
            ->with('message', ['danger', 'Your profile has been deleted!']);
    }
}
