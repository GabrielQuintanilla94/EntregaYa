<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    // Permitir guardar datos en estos campos
    protected $fillable = [
        'descripcion', 
        'direccion', 
        'nombre_contacto',   
        'celular_contacto',  
        'conductor_id', 
        'vehiculo_id', 
        'estado'
    ];

    // Funciones para conectar las tablas (Relaciones)
    public function conductor()
    {
        return $this->belongsTo(User::class, 'conductor_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}