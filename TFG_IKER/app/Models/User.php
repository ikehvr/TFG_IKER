<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'rol', 'profile_photo'];
    protected $hidden   = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function reservas() { return $this->hasMany(Reserva::class); }
    public function resenas()  { return $this->hasMany(Resena::class); }
    public function isAdmin(): bool { return $this->rol === 'admin'; }

    public function profilePhotoUrl(): ?string
    {
        return $this->profile_photo ? asset($this->profile_photo) : null;
    }
}
