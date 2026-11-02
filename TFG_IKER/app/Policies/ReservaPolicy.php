<?php

namespace App\Policies;

use App\Models\Reserva;
use App\Models\User;

class ReservaPolicy
{
    public function view(User $user, Reserva $reserva): bool
    {
        return $user->id === $reserva->user_id || $user->isAdmin();
    }

    public function update(User $user, Reserva $reserva): bool
    {
        return $user->id === $reserva->user_id || $user->isAdmin();
    }
}
