@extends('layouts.app')
@section('title','Pol&iacute;tica de Privacidad - JapanStyle')

@section('content')
<div class="container py-5" style="max-width:860px">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Inicio</a></li>
            <li class="breadcrumb-item active">Pol&iacute;tica de Privacidad</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-sm" style="border-radius:12px">
        <div class="card-body p-5">

            <h1 class="fw-bold mb-2">Pol&iacute;tica de Privacidad</h1>
            <p class="text-muted small mb-5">&Uacute;ltima actualizaci&oacute;n: {{ date('d/m/Y') }}</p>

            <div style="line-height:1.8;color:#444">

                <h5 class="fw-bold mt-4 mb-2">1. Responsable del tratamiento</h5>
                <p>
                    El responsable del tratamiento de los datos personales recogidos en este sitio web es
                    <strong>JapanStyle</strong>, con correo electronico de contacto
                    <a href="mailto:info@japanstyle.es" class="text-danger">info@japanstyle.es</a>.
                </p>

                <h5 class="fw-bold mt-4 mb-2">2. Datos que recogemos</h5>
                <p>Recogemos los siguientes datos personales:</p>
                <ul>
                    <li><strong>Datos de registro:</strong> nombre completo y direccion de correo electronico.</li>
                    <li><strong>Datos de reservas:</strong> fecha de salida, numero de viajeros e informacion esencial del pago para confirmar la compra y emitir el recibo.</li>
                    <li><strong>Datos de contacto:</strong> correo electronico, asunto y mensaje cuando utilizas el formulario de contacto.</li>
                    <li><strong>Datos de uso:</strong> informacion tecnica como la IP, tipo de navegador y paginas visitadas, recogida de forma anonima.</li>
                </ul>

                <h5 class="fw-bold mt-4 mb-2">3. Finalidad del tratamiento</h5>
                <p>Utilizamos tus datos para:</p>
                <ul>
                    <li>Gestionar tu cuenta y autenticacion en la plataforma.</li>
                    <li>Procesar y gestionar tus reservas de itinerarios.</li>
                    <li>Responder a tus consultas a traves del formulario de contacto.</li>
                    <li>Mejorar nuestros servicios y la experiencia de usuario.</li>
                    <li>Cumplir con obligaciones legales.</li>
                </ul>

                <h5 class="fw-bold mt-4 mb-2">4. Base legal del tratamiento</h5>
                <p>
                    El tratamiento de tus datos se basa en la ejecucion del contrato de reserva (Art. 6.1.b RGPD),
                    el consentimiento que otorgas al registrarte (Art. 6.1.a RGPD) y el cumplimiento de obligaciones
                    legales (Art. 6.1.c RGPD).
                </p>

                <h5 class="fw-bold mt-4 mb-2">5. Conservacion de los datos</h5>
                <p>
                    Conservamos tus datos personales mientras mantengas una cuenta activa en JapanStyle.
                    Los datos de reservas se conservan durante el tiempo necesario para cumplir con las
                    obligaciones legales y contables. Puedes solicitar la eliminacion de tu cuenta en cualquier momento
                    desde la seccion "Mi perfil".
                </p>

                <h5 class="fw-bold mt-4 mb-2">6. Comparticion de datos con terceros</h5>
                <p>No vendemos ni cedemos tus datos personales a terceros. Unicamente los compartimos con:</p>
                <ul>
                    <li><strong>Proveedores tecnicos de pago y servicios asociados:</strong> para confirmar reservas y emitir comprobantes de compra cuando sea necesario.</li>
                    <li><strong>Plataformas colaboradoras como Skyscanner:</strong> cuando el usuario decide salir del sitio para comparar vuelos o alojamientos en plataformas externas.</li>
                    <li><strong>Autoridades competentes:</strong> cuando sea requerido por ley.</li>
                </ul>

                <h5 class="fw-bold mt-4 mb-2">7. Tus derechos</h5>
                <p>De acuerdo con el RGPD, tienes derecho a:</p>
                <ul>
                    <li><strong>Acceso:</strong> conocer que datos personales tenemos sobre ti.</li>
                    <li><strong>Rectificacion:</strong> corregir datos inexactos o incompletos.</li>
                    <li><strong>Supresion:</strong> solicitar la eliminacion de tus datos ("derecho al olvido").</li>
                    <li><strong>Portabilidad:</strong> recibir tus datos en un formato estructurado.</li>
                    <li><strong>Oposicion:</strong> oponerte al tratamiento de tus datos.</li>
                    <li><strong>Limitacion:</strong> solicitar la limitacion del tratamiento.</li>
                </ul>
                <p>
                    Para ejercer cualquiera de estos derechos, contacta con nosotros en
                    <a href="mailto:info@japanstyle.es" class="text-danger">info@japanstyle.es</a>.
                    Tambien tienes derecho a presentar una reclamacion ante la
                    <a href="https://www.aepd.es" target="_blank" class="text-danger">Agencia Espanola de Proteccion de Datos (AEPD)</a>.
                </p>

                <h5 class="fw-bold mt-4 mb-2">8. Cookies</h5>
                <p>
                    Este sitio web utiliza cookies tecnicas necesarias para el funcionamiento de la plataforma
                    (sesion de usuario, token CSRF de seguridad). No utilizamos cookies de seguimiento ni publicitarias.
                </p>

                <h5 class="fw-bold mt-4 mb-2">9. Seguridad</h5>
                <p>
                    Implementamos medidas tecnicas y organizativas para proteger tus datos personales contra
                    el acceso no autorizado, la perdida o la alteracion, incluyendo el cifrado de contrasenas
                    mediante bcrypt y el uso de HTTPS.
                </p>

                <h5 class="fw-bold mt-4 mb-2">10. Cambios en esta politica</h5>
                <p>
                    Podemos actualizar esta politica de privacidad periodicamente. Te notificaremos cualquier
                    cambio significativo por correo electronico o mediante un aviso en la plataforma.
                </p>

                <div class="mt-5 p-4 rounded-3" style="background:#f8f4ef">
                    <p class="mb-1" style="font-size:.88rem"><strong>Contacto para asuntos de privacidad:</strong></p>
                    <p class="mb-0" style="font-size:.88rem">
                        <i class="fas fa-envelope me-2" style="color:#BC002D"></i>
                        <a href="mailto:info@japanstyle.es" class="text-danger">info@japanstyle.es</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-outline-danger">Volver al inicio</a>
    </div>
</div>
@endsection
