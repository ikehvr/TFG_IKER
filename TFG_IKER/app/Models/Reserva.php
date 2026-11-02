<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id', 'itinerario_id', 'fecha_salida', 'n_viajeros',
        'precio_unitario', 'total', 'estado', 'stripe_payment_intent', 'payment_method',
        'payment_last4', 'receipt_number', 'paid_at', 'notas',
    ];

    protected $casts = ['fecha_salida' => 'date', 'paid_at' => 'datetime', 'total' => 'decimal:2'];

    public function user()       { return $this->belongsTo(User::class); }
    public function itinerario() { return $this->belongsTo(Itinerario::class); }

    public function estadoLabel(): string
    {
        return match($this->estado) {
            'confirmada' => 'Confirmada',
            'completada' => 'Completada',
            'cancelada'  => 'Cancelada',
            default      => 'Pendiente',
        };
    }

    public function cancelable(): bool
    {
        return in_array($this->estado, ['pendiente', 'confirmada'])
            && $this->fecha_salida->isFuture();
    }

    public function paymentMethodLabel(): string
    {
        return match($this->payment_method) {
            'card' => 'Tarjeta bancaria',
            default => 'Pendiente de pago',
        };
    }
}
