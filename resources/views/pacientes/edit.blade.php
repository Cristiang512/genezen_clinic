@extends('layouts.app')

@section('content')
    @include('pacientes.form', ['paciente' => $paciente])
@endsection
