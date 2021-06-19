<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Activitylog\Models\Activity;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $data = [
            'user' => Auth::user(),
            'logs' => Activity::where('causer_id', Auth::user()->id)->latest()->get()
        ];

        return view('profile.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $data = [
            'user' => Auth::user(),
        ];

        return view('profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if ($request->password) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user())],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            ]);
        }

        if ($request->file('photo')) {
            $request->validate([
                'photo' => ['image', 'max:2048']
            ]);
        }


        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->file('photo')) {
            $old = Auth::user()->getMedia('images')->first();
            if ($old) {
                $old->delete();
            }
            $user->addMediaFromRequest('photo')->toMediaCollection('images');
        }
        $user->save();

        activity()
            ->causedBy(Auth::user())
            ->log('Successfully update profile');

        session()->flash('success', 'Successfully update profile');

        return redirect()->route('profile.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function resetPhoto()
    {
        $old = Auth::user()->getMedia('images')->first();
        if ($old) {
            $old->delete();
        }

        activity()
            ->causedBy(Auth::user())
            ->log('Successfully reset profile photo');

        session()->flash('success', 'Successfully reset profile photo');

        return redirect()->route('profile.show');
    }
}
