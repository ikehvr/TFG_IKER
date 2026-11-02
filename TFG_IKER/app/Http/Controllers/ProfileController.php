<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Despliega la vista el formulario para editar el perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualiza la información del usuario.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('profile_photo')) {
            $destination = public_path('uploads/profile-photos');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $currentPhoto = $request->user()->profile_photo
                ? public_path($request->user()->profile_photo)
                : null;

            $filename = 'user-' . $request->user()->id . '-' . time() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
            $request->file('profile_photo')->move($destination, $filename);
            $request->user()->profile_photo = 'uploads/profile-photos/' . $filename;

            if ($currentPhoto && File::exists($currentPhoto)) {
                File::delete($currentPhoto);
            }
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta del usuario
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
}
