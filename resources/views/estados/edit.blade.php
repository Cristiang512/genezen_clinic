@extends('layouts.app')

@section('content')
    @include('estados.form', ['estado' => $estado])
@endsection
