@extends('layouts.main')

@section('title', 'André')

@section('content')

<div id='search-container' class="col md-12">
    <h1>Busque um evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar evento">

    </form>
    <div id="events-container" class="col-md-12">
        <h2>Próximos Eventos</h2>
        <p>Veja os eventos</p>
        <div id="cards-container" class="row">
            @foreach($events as $event)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="\img\events\{{ $event->image }}" class="img-fluid"alt="{{ $event->title }}" class="image">
                    <div class="card-body">
                        <p class="card-date">000 </p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">X partic.</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    </div>
</div>
@endsection