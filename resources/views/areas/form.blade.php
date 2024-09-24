@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h1 class="text-center mb-4 text-primary">{{ isset($area) ? 'Editar Área' : 'Agregar Nueva Área' }}</h1>
            
            <form action="{{ isset($area) ? route('areas.update', $area->id) : route('areas.store') }}" method="POST">
                @csrf
                @if(isset($area))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Área</label>
                    <input type="text" name="nombre" class="form-control" value="{{ isset($area) ? $area->nombre : old('nombre') }}" required>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($area) ? 'Actualizar Área' : 'Agregar Área' }}
                    </button>
                    <a href="{{ route('areas.index') }}" class="btn btn-secondary">Cancelar / Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Estilos adicionales -->
<style>
    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 10px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card {
        border-radius: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 30px;
    }

    .btn-secondary {
        padding: 10px 30px;
    }

    h1 {
        font-size: 2.5rem;
    }
</style>
@endsection
