@extends('layouts.app')

@section('content')
<div class="container text-center">
    <!-- Logo grande y encabezado principal -->
    <div class="mb-4">
        <img src="{{ asset('images/logoClinic.png') }}" alt="Clínica Genezen" style="height: 150px;"> <!-- Tamaño del logo ajustado -->
        <h1 class="display-3 mt-3">Sala de Espera</h1>
    </div>

    <!-- Tabla de pacientes -->
    <table class="table table-hover table-bordered text-center" id="tablaPacientes">
        <thead class="bg-primary text-white">
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Identificación</th>
                <th>Área</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($paciente->fecha_cita)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($paciente->hora_cita)->format('g:i A') }}</td>
                    <td>{{ $paciente->nombre }}{{ $paciente->apellido }}</td>
                    <td>****{{ substr($paciente->identificacion, -4) }}</td>
                    <td><strong>{{ $paciente->area->nombre }}</strong></td>
                    {{-- <td class="estado-{{ strtolower($paciente->estado->nombre) }}">{{ $paciente->estado->nombre }}</td> --}}
                    <td><strong>{{ $paciente->estado->nombre }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- JavaScript para actualizar la lista automáticamente -->
<script>
    function actualizarTabla() {
        fetch('{{ route('pacientes.salaEspera') }}')
            .then(response => response.text())
            .then(html => {
                // Obtener solo el tbody de la respuesta y actualizar solo esa parte
                const nuevaTabla = new DOMParser().parseFromString(html, 'text/html').querySelector('tbody').innerHTML;
                document.querySelector('#tablaPacientes tbody').innerHTML = nuevaTabla;
            })
            .catch(error => console.error('Error actualizando la tabla:', error));
    }

    // Actualizar la tabla cada 15 segundos
    setInterval(actualizarTabla, 15000);
</script>


<style>
    /* Aumentar el tamaño del logo */
    img {
        height: 150px; /* Ajusta según sea necesario */
    }

    /* Encabezados grandes y agradables */
    h1.display-3 {
        color: #007bff;
        font-size: 3.5rem;
        font-weight: bold;
    }

    .lead {
        font-size: 1.5rem;
        color: #333;
    }

    /* Tabla estilizada */
    .table {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        background-color: #0044cc;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
        font-size: 1.25rem;
    }

    .table tbody td {
        text-align: center;
        font-size: 1.5rem;
        padding: 20px;
        color: #333;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    /* Color de fondo general */
    body {
        background-color: #e0f7fa; /* Azul claro relajante */
    }
</style>
@endsection
