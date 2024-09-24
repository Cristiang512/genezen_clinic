<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['nombre']; // Nombre del área (Ej: Cardiología, Pediatría, etc.)

    // Relación: Un área tiene muchos pacientes
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
