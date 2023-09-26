@extends('layouts.main')

@section('title', 'Produtos')

@section('content')

@if($busca != '')
<p>Voce está buscando por {{ $busca }}</p>
@endif

@endsection