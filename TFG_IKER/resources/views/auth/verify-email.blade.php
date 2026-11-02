<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Gracias por registrarte. Antes de empezar, verifica tu correo electrónico haciendo clic en el enlace que te acabamos de enviar. Si no lo has recibido, te enviaremos otro sin problema.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            Hemos enviado un nuevo enlace de verificación al correo electrónico indicado durante el registro.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Reenviar correo de verificación
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
