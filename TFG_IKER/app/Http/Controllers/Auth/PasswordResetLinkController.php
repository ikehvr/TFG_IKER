<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Despliega la vista para ingresar el correo electrónico del usuario y solicitar un enlace de restablecimiento de contraseña.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Maneja un link de restablecimiento de contraseña entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Enviaremos el enlace de restablecimiento de contraseña. Una vez lo hayamos intentado
        // examinaremos el estado para determinar si se envió el enlace de restablecimiento de contraseña con éxito.
        // Finalmente, redigiremos al usuario de regreso a donde vino con un mensaje de éxito o error.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
