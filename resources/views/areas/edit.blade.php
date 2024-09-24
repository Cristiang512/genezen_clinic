@extends('layouts.app')

@section('content')
    @include('areas.form', ['area' => $area])
@endsection
