@extends('layouts.app')

@section('content')
<div class="d-flex" style="height: 100vh;">
    
    <!-- Video institucional (40%) -->
    <div class="col-6" style="flex: 0 0 40%;">
        <video id="videoPlayer" autoplay muted style="width: 100%; height: 100%; object-fit: cover;">
            <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>
    </div>

    <!-- Sección de la lista de pacientes -->
    <div class="col-6 d-flex justify-content-center align-items-center" style="background-color: #e3f2fd;">
        <div>
            <div class="text-center mb-4">
                <img src="{{ asset('images/logoClinic.png') }}" alt="Clínica Genezen" style="height: 120px;">
                <h1 class="display-4" style="color: #007bff;">Sala de Espera</h1>
            </div>
            <table class="table table-hover table-bordered text-center" id="tablaPacientes">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>PACIENTE</th>
                        <th>IDENTIFICACIÓN</th>
                        <th>ÁREA</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($paciente->fecha_cita)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($paciente->hora_cita)->format('g:i A') }}</td>
                            <td>{{ $paciente->nombre }}</td>
                            <td>****{{ substr($paciente->identificacion, -4) }}</td>
                            <td class="font-weight-bold text-uppercase"><strong>{{ $paciente->area->nombre }}</strong></td>
                            <td class="estado-{{ Str::slug($paciente->estado->nombre) }} font-weight-bold text-uppercase"><strong>{{ $paciente->estado->nombre }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

<!-- Script para cambiar videos en bucle -->
<script>
    // Lista de videos
    const videos = [
        "{{ asset('videos/video1.mp4') }}",
        "{{ asset('videos/video2.mp4') }}"
    ];

    let videoIndex = 0; // Índice del video actual

    const videoPlayer = document.getElementById('videoPlayer');
    const videoSource = document.getElementById('videoSource');

    // Función que cambia al siguiente video
    function playNextVideo() {
        videoIndex = (videoIndex + 1) % videos.length; // Pasar al siguiente video o volver al primero
        videoSource.src = videos[videoIndex]; // Cambiar la fuente del video
        videoPlayer.load(); // Recargar el video
        videoPlayer.play(); // Reproducir el nuevo video
    }

    // Cuando termina el video, cambia al siguiente
    videoPlayer.addEventListener('ended', playNextVideo);
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

    /* Asegúrate de que los dos lados ocupen el 50% de la pantalla */
    .d-flex > .col-6 {
        flex: 1;
        height: 100%;
    }

    /* Opcional: un borde entre las dos mitades */
    .col-6 {
        border-right: 1px solid #e0e0e0;
    }

    /* Estilos personalizados para el video */
    video {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

     /* Ajustar el video para cubrir toda la mitad */
    video {
        object-fit: cover;
    }

</style>
@endsection
