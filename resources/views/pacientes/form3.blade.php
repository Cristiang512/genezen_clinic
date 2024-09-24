@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($paciente) ? 'Editar Paciente' : 'Agregar Paciente' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Formulario para crear o editar un paciente -->
    <form action="{{ isset($paciente) ? route('pacientes.update', $paciente->id) : route('pacientes.store') }}" method="POST">
        @csrf

        @if(isset($paciente))
            @method('PUT')
        @endif

        <!-- Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ isset($paciente) ? $paciente->nombre : old('nombre') }}" required>
        </div>

        <!-- Apellido -->
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ isset($paciente) ? $paciente->apellido : old('apellido') }}" required>
        </div>

        <!-- Identificación -->
        <div class="form-group">
            <label for="identificacion">Identificación</label>
            <input type="text" name="identificacion" class="form-control" value="{{ isset($paciente) ? $paciente->identificacion : old('identificacion') }}" required>
        </div>

        <!-- Fecha de nacimiento -->
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ isset($paciente) ? $paciente->fecha_nacimiento : old('fecha_nacimiento') }}" required>
        </div>

        <!-- Género -->
        <div class="form-group">
            <label for="genero">Género</label>
            <select name="genero" class="form-control" required>
                <option value="" disabled {{ !isset($paciente) ? 'selected' : '' }}>Selecciona un género</option>
                <option value="Masculino" {{ (isset($paciente) && $paciente->genero == 'Masculino') ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ (isset($paciente) && $paciente->genero == 'Femenino') ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ (isset($paciente) && $paciente->genero == 'Otro') ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <!-- Edad -->
        <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" name="edad" class="form-control" value="{{ isset($paciente) ? $paciente->edad : old('edad') }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ isset($paciente) ? $paciente->email : old('email') }}">
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ isset($paciente) ? $paciente->telefono : old('telefono') }}">
        </div>

        <!-- Dirección -->
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ isset($paciente) ? $paciente->direccion : old('direccion') }}">
        </div>

        <!-- Área de servicio -->
        <div class="form-group">
            <label for="area_id">Área de Servicio</label>
            <select name="area_id" class="form-control" required>
                <option value="" disabled {{ !isset($paciente) ? 'selected' : '' }}>Selecciona un área de servicio</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ (isset($paciente) && $paciente->area_id == $area->id) ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Estado -->
        <div class="form-group">
            <label for="estado_id">Estado</label>
            <select name="estado_id" class="form-control" required>
                <option value="" disabled {{ !isset($paciente) ? 'selected' : '' }}>Selecciona un estado</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" {{ (isset($paciente) && $paciente->estado_id == $estado->id) ? 'selected' : '' }}>
                        {{ $estado->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fecha de cita -->
        <div class="form-group">
            <label for="fecha_cita">Fecha de la Cita</label>
            <input type="date" name="fecha_cita" class="form-control" value="{{ isset($paciente) ? $paciente->fecha_cita : old('fecha_cita') }}" required>
        </div>

        <!-- Hora de cita en formato 12 horas con AM/PM -->
        <div class="form-group">
            <label for="hora_cita">Hora de la Cita</label>
            <input type="text" name="hora_cita" class="form-control" id="horaCita" placeholder="02:30 PM" value="{{ isset($paciente) ? $paciente->hora_cita : old('hora_cita') }}" required>
        </div>

        <!-- Observación -->
        <div class="form-group">
            <label for="observacion">Observación</label>
            <textarea name="observacion" class="form-control">{{ isset($paciente) ? $paciente->observacion : old('observacion') }}</textarea>
        </div>

        <!-- Botón de guardar paciente -->
        <button type="submit" class="btn btn-success">{{ isset($paciente) ? 'Actualizar' : 'Guardar' }} Paciente</button>

        <!-- Botón de volver al listado o cancelar -->
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar / Volver al Listado</a>
    </form>
</div>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Inicializar Flatpickr para el campo de hora -->
<script>
    flatpickr("#horaCita", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12 horas con AM/PM
    });
</script>
@endsection
