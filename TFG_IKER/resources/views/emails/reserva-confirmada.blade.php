<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de compra</title>
</head>
<body style="margin:0;padding:0;background:#f6f3ef;font-family:Arial,Helvetica,sans-serif;color:#1a1a1a;">
    <div style="max-width:680px;margin:0 auto;padding:32px 16px;">
        <div style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.08);">
            <div style="background:#1a1a1a;padding:28px 32px;">
                <div style="font-size:28px;font-weight:700;color:#ffffff;letter-spacing:0.03em;">JAPAN<span style="color:#BC002D;">STYLE</span></div>
                <p style="margin:10px 0 0;color:rgba(255,255,255,0.72);font-size:14px;">Tu compra se ha confirmado correctamente.</p>
            </div>

            <div style="padding:32px;">
                <h1 style="margin:0 0 14px;font-size:24px;color:#1a1a1a;">Hola, {{ $reserva->user->name }}.</h1>
                <p style="margin:0 0 24px;font-size:15px;line-height:1.7;color:#4b4b4b;">
                    Hemos recibido el pago de tu itinerario y ya puedes consultar tu recibo desde tu cuenta.
                    A continuación te dejamos el resumen de la compra.
                </p>

                <div style="background:#f8f4ef;border-radius:12px;padding:22px 24px;margin-bottom:24px;">
                    <h2 style="margin:0 0 16px;font-size:18px;color:#1a1a1a;">Resumen de la reserva</h2>
                    <p style="margin:0 0 10px;font-size:14px;"><strong>Itinerario:</strong> {{ $reserva->itinerario->titulo }}</p>
                    <p style="margin:0 0 10px;font-size:14px;"><strong>Destino principal:</strong> {{ $reserva->itinerario->destino_principal }}</p>
                    <p style="margin:0 0 10px;font-size:14px;"><strong>Fecha de salida:</strong> {{ $reserva->fecha_salida->translatedFormat('d \\d\\e F \\d\\e Y') }}</p>
                    <p style="margin:0 0 10px;font-size:14px;"><strong>Viajeros:</strong> {{ $reserva->n_viajeros }}</p>
                    <p style="margin:0 0 10px;font-size:14px;"><strong>Total pagado:</strong> {{ number_format((float) $reserva->total, 2, ',', '.') }} €</p>
                    <p style="margin:0 0 10px;font-size:14px;"><strong>Número de recibo:</strong> {{ $reserva->receipt_number }}</p>
                    <p style="margin:0;font-size:14px;"><strong>Referencia de pago:</strong> {{ $reserva->stripe_payment_intent }}</p>
                </div>

                <p style="margin:0 0 24px;font-size:15px;line-height:1.7;color:#4b4b4b;">
                    Si necesitas cualquier aclaración, puedes responder a este correo o escribirnos a
                    <a href="mailto:info@japanstyle.es" style="color:#BC002D;text-decoration:none;">info@japanstyle.es</a>.
                </p>

                <a href="{{ route('reservas.recibo', $reserva) }}"
                   style="display:inline-block;background:#BC002D;color:#ffffff;text-decoration:none;padding:14px 24px;border-radius:8px;font-weight:700;font-size:14px;">
                    Ver mi recibo
                </a>
            </div>
        </div>
    </div>
</body>
</html>
