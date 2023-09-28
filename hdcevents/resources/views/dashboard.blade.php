@extends('layouts.main')

@section('title', 'Dashbord')

@section('content')
<h1>Meus eventos</h1>

@if(count($events) > 0)

@else
<p>Voce nao tem nenhum evento, <a href="/events/create">\Criar um evento</a></p>
@endif

@endsection
