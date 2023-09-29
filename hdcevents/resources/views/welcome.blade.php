@extends('layouts.main')

@section('title', 'André')

@section('content')

@if(count($events) > 0) 
<div id='search-container' class="col md-12">
    @if($search)
    <h3>Buscando por "{{ $search }}"</h3>
    <a href="/">Limpar Busca</a>
    @else
    <h3>Busque um evento</h3>
    @endif
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar evento">
    </form>
    <div id="events-container" class="col-md-12">   
        <h2>Próximos Eventos</h2>
        <hr>
        <div id="cards-container" class="row">
            @foreach($events as $event)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="\img\events\{{ $event->image }}" class="img-fluid"alt="{{ $event->title }}" class="image">
                    <div class="card-body">
                        <p class="card-date">{{ date('d/m/y', strtotime($event->date)) }}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">{{ count($event->users )}} Participantes</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary btn-sm">Saber mais</a>
                    </div>
                </div>
            </div>
            @endforeach
            @elseif(count($events) == 0 && $search)
                <p class="container">
                    Nenhum evento encontrado
                    <a href="/">Limpar Busca</a>
                </p>
                
            @else
                <p class="container">Nenhum evento encontrado</p>
            @endif
        </div>
    </div>
</div>
@endsection