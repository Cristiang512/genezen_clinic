@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Estados</h1>
        <div>
            <a href="{{ route('estados.create') }}" class="btn btn-primary">Agregar Estado</a>
            <a href="{{ route('areas.index') }}" class="btn btn-secondary">Gestionar Áreas</a>
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Gestionar Paciente</a>
        </div>
        
    </div>

    <table class="table table-bordered mt-3">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Nombre del Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estados as $estado)
                <tr>
                    <td>{{ $estado->id }}</td>
                    <td>{{ $estado->nombre }}</td>
                    <td>
                        <a href="{{ route('estados.edit', $estado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('estados.destroy', $estado->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
    /* Tabla estilizada con colores de clínica */
    .table {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table thead th {
        background-color: #0044cc; /* Azul oscuro */
        color: white;
        text-transform: uppercase;
        font-weight: bold;
        text-align: center;
        border: none;
    }

    .table tbody td {
        text-align: center;
        color: #333;
        padding: 12px;
        border-top: 1px solid #e0e0e0;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f8f9fa; /* Azul muy claro */
    }

    .table tbody tr:nth-child(even) {
        background-color: white; /* Fondo blanco */
    }

    /* Estilos especiales para el área y el estado */
    .table tbody td.area,
    .table tbody td.estado {
        font-weight: bold;
        font-size: 1.1em;
        color: #0044cc; /* Azul */
        text-transform: uppercase;
    }

    body {
        background-color: #c5def6; /* Color de fondo suave */
    }

    .card {
        background-color: #ffffff; /* Fondo blanco suave para el contenido */
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    /* Estilos para los títulos y los botones */
    h1 {
        font-size: 2rem;
        color: #0044cc; /* Azul más oscuro para los títulos */
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-warning {
        background-color: #ffcc00;
        border-color: #ffcc00;
        color: black;
    }

    .btn-danger {
        background-color: #ff4444;
        color: white;
    }
</style>
@endsection
