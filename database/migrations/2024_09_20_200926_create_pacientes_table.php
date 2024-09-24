<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id(); // ID único del paciente
            // Información del paciente
            $table->string('nombre');
            $table->string('apellido');
            $table->string('identificacion')->unique(); // Identificación única del paciente (ej: DNI)
            $table->date('fecha_nacimiento')->nullable(); // Fecha de nacimiento
            $table->string('genero')->nullable(); // Género: Masculino, Femenino, Otro
            $table->integer('edad')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();

            // Llaves foráneas (relaciones con áreas y estados)
            $table->unsignedBigInteger('area_id'); // Relación con áreas
            $table->unsignedBigInteger('estado_id'); // Relación con estados

            // Datos relacionados a la agenda
            $table->date('fecha_cita'); // Fecha de la cita
            $table->time('hora_cita'); // Hora de la cita
            $table->text('observacion')->nullable(); // Observaciones sobre la cita

            $table->timestamps(); // Fechas de creación y actualización del registro

            // Definición de llaves foráneas
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('estado_id')->references('id')->on('estados');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
