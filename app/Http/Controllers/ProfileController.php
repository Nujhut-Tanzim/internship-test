<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
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
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function upload(Request $request)
    {
        
        $request->validate([
            'image' => 'required|image',
        ]);

        
        if ($request->hasFile('image')) {
            
            $file = $request->file('image');
        
        $img_name = time() . '_' . $file->getClientOriginalName();
        
       
        $file->move(public_path('uploads'), $img_name); 
        $user = User::find(auth()->id());

        $user->update(['image' => 'uploads/' . $img_name]); 

        return response()->json([
            'success' => true,
            'image_url' => asset('uploads/' . $img_name), 
        ]);
        }

        return response()->json(['success' => false]);
    }

}
