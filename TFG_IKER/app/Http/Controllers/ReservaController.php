<?php

namespace App\Http\Controllers;

use App\Mail\ReservaConfirmadaMail;
use App\Models\Reserva;
use App\Models\Itinerario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'itinerario_id' => 'required|exists:itinerarios,id',
            'fecha_salida'  => 'required|date|after:today',
            'n_viajeros'    => 'required|integer|min:1|max:20',
        ]);

        $it = Itinerario::activo()->findOrFail($request->itinerario_id);

        $reserva = Reserva::create([
            'user_id'         => Auth::id(),
            'itinerario_id'   => $it->id,
            'fecha_salida'    => $request->fecha_salida,
            'n_viajeros'      => $request->n_viajeros,
            'precio_unitario' => $it->precio_desde,
            'total'           => $it->precio_desde * $request->n_viajeros,
            'estado'          => 'pendiente',
        ]);

        return redirect()->route('reservas.show', $reserva)
                         ->with('success', 'Reserva creada. Completa el pago para confirmarla.');
    }

    public function show(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        $reserva->load('itinerario', 'user');
        return view('reservas.show', compact('reserva'));
    }

    public function checkout(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);

        if ($reserva->estado !== 'pendiente') {
            return redirect()->route('reservas.show', $reserva)
                ->with('error', 'Esta reserva ya ha sido procesada.');
        }

        $reserva->load('itinerario', 'user');

        return view('reservas.checkout', compact('reserva'));
    }

    public function pagar(Request $request, Reserva $reserva)
    {
        $this->authorizeReserva($reserva);

        if ($reserva->estado !== 'pendiente') {
            return back()->with('error', 'Esta reserva ya ha sido procesada.');
        }

        $data = $request->validate([
            'titular'        => 'required|string|max:100',
            'email_factura'  => 'required|email|max:255',
            'numero_tarjeta' => 'required|string|min:13|max:25',
            'caducidad'      => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvc'            => 'required|digits_between:3,4',
            'acepta'         => 'accepted',
        ], [
            'acepta.accepted' => 'Debes aceptar el tratamiento seguro del pago para continuar.',
        ]);

        $last4 = substr($this->normalizeCardNumber($data['numero_tarjeta']), -4);
        $transactionId = 'pay_' . Str::upper(Str::random(12));
        $receiptNumber = 'R-' . now()->format('Ymd') . '-' . str_pad((string) $reserva->id, 6, '0', STR_PAD_LEFT);

        $reserva->update([
            'estado'                => 'confirmada',
            'stripe_payment_intent' => $transactionId,
            'payment_method'        => 'card',
            'payment_last4'         => $last4,
            'receipt_number'        => $receiptNumber,
            'paid_at'               => now(),
            'notas'                 => 'Pago confirmado para ' . $data['titular'] . ' (' . $data['email_factura'] . ').',
        ]);

        $reserva->loadMissing('itinerario', 'user');
        Mail::to($reserva->user->email)->send(new ReservaConfirmadaMail($reserva));

        return redirect()->route('reservas.recibo', $reserva)
            ->with('success', 'Pago realizado. Ya puedes consultar tu recibo.');
    }

    public function recibo(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);

        if ($reserva->estado === 'pendiente') {
            return redirect()->route('reservas.checkout', $reserva)
                ->with('error', 'Completa el pago antes de generar el recibo.');
        }

        $reserva->load('itinerario', 'user');

        return view('reservas.recibo', compact('reserva'));
    }

    public function cancelar(Reserva $reserva)
    {
        $this->authorizeReserva($reserva);
        if (!$reserva->cancelable()) {
            return back()->with('error', 'No se puede cancelar esta reserva.');
        }
        $reserva->update(['estado' => 'cancelada']);
        return redirect()->route('dashboard')->with('success', 'Reserva cancelada.');
    }

    protected function authorizeReserva(Reserva $reserva): void
    {
        if (Auth::id() !== $reserva->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
    }

    protected function normalizeCardNumber(string $cardNumber): string
    {
        return preg_replace('/\D+/', '', $cardNumber) ?? '';
    }
}
