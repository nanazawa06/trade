<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Cloudinary;
use App\Models\Area;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $areas = Area::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'areas' => $areas,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        //$request->user()->fill($request->validated());
        $request->user()->fill($request->safe()->only(['name', 'email']));
        
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $path = null;
        if ($request->hasFile('picture')) {
            $path = Cloudinary::upload($request->file('picture')->getRealPath())->getSecurePath();
            $request->user()->profile_icon = $path;
        }
        
        if ($request->input('profile')){
            $request->user()->profile = $request->input('profile');
        }
        
        if ($request->input('area')){
            $request->user()->area_id = $request->input('area');
        }
        
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
