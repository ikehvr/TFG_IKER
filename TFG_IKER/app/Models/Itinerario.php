<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerario extends Model
{
    protected $fillable = [
        'titulo', 'slug', 'descripcion_corta', 'descripcion_larga',
        'duracion_dias', 'categoria', 'presupuesto', 'primera_vez',
        'precio_desde', 'imagen_principal', 'destino_principal',
        'recomendado', 'activo',
    ];

    protected $casts = [
        'recomendado'  => 'boolean',
        'activo'       => 'boolean',
        'precio_desde' => 'decimal:2',
    ];

    public function destinos()
    {
        return $this->belongsToMany(Destino::class, 'itinerario_destinos')
                    ->withPivot('orden')
                    ->orderBy('pivot_orden');
    }

    public function reservas() { return $this->hasMany(Reserva::class); }
    public function resenas()  { return $this->hasMany(Resena::class); }

    // Scopes para filtros
    public function scopeActivo($q)     { return $q->where('activo', true); }
    public function scopeDestacado($q)  { return $q->where('recomendado', true); }

    public function scopeDuracion($q, $dias)
    {
        if ($dias == '7')  return $q->where('duracion_dias', '<=', 7);
        if ($dias == '14') return $q->where('duracion_dias', '<=', 14);
        if ($dias == '21') return $q->where('duracion_dias', '>=', 15);
        return $q;
    }

    public function scopeEstilo($q, $v)
    {
        if ($v && $v != 'todos') return $q->where('categoria', $v);
        return $q;
    }

    public function scopePresupuesto($q, $v)
    {
        if ($v && $v != 'todos') return $q->where('presupuesto', $v);
        return $q;
    }

    public function scopePrimeraVez($q, $v)
    {
        if ($v && $v != 'todos') return $q->where('primera_vez', $v);
        return $q;
    }
}
