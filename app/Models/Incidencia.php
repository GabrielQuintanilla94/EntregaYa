<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = ['conductor_id', 'entrega_id', 'tipo_incidencia', 'detalles'];

    // Relaciones para que el Administrador vea quién reportó
    public function conductor() {
        return $this->belongsTo(User::class, 'conductor_id');
    }

    public function entrega() {
        return $this->belongsTo(Entrega::class, 'entrega_id');
    }
}