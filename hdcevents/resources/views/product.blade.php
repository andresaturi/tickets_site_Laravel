@extends('layouts.main')

@section('title', 'Produto')

@section('content')

@if ($id == null) 
    <p>Nenhum produto Encontrado</p>
@else
    <p>Produto {{ $id }}</p>
@endif
@endsection