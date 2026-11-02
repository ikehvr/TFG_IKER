<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'asunto'  => 'required|string|max:150',
            'mensaje' => 'required|string|min:10|max:2000',
        ]);

        // Enviar email usando Mail::raw (funciona sin configuracion compleja)
        try {
            Mail::raw(
                "Mensaje de contacto desde JapanStyle\n\n" .
                "De: {$request->email}\n" .
                "Asunto: {$request->asunto}\n\n" .
                "Mensaje:\n{$request->mensaje}",
                function ($message) use ($request) {
                    $message->to('info@japanstyle.es')
                            ->replyTo($request->email)
                            ->subject('[JapanStyle] ' . $request->asunto);
                }
            );
            return back()->with('success', 'Mensaje enviado correctamente. ¡Te responderemos pronto!');
        } catch (\Exception $e) {
            // En desarrollo el mail va al log, no falla la página
            return back()->with('success', 'Mensaje recibido. ¡Te responderemos pronto!');
        }
    }
}
