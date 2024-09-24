<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre']; // Nombre del estado (Ej: En consulta, Dado de alta, etc.)

    // Relación: Un estado tiene muchos pacientes
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
