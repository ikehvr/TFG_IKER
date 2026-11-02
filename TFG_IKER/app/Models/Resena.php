<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $table = 'resenas';
    protected $fillable = ['user_id', 'itinerario_id', 'puntuacion', 'comentario', 'verificada'];
    protected $casts    = ['verificada' => 'boolean'];

    public function user()       { return $this->belongsTo(User::class); }
    public function itinerario() { return $this->belongsTo(Itinerario::class); }
}
