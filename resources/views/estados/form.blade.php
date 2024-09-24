@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h1 class="text-center mb-4 text-primary">{{ isset($estado) ? 'Editar Estado' : 'Agregar Nuevo Estado' }}</h1>
            
            <form action="{{ isset($estado) ? route('estados.update', $estado->id) : route('estados.store') }}" method="POST">
                @csrf
                @if(isset($estado))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Estado</label>
                    <input type="text" name="nombre" class="form-control" value="{{ isset($estado) ? $estado->nombre : old('nombre') }}" required>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($estado) ? 'Actualizar Estado' : 'Agregar Estado' }}
                    </button>
                    <a href="{{ route('estados.index') }}" class="btn btn-secondary">Cancelar / Volver</a>
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
