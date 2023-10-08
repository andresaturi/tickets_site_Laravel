@extends('layouts.main')

@section('title', 'Dashbord')

@section('content')

@if(count($events) > 0)
<h1>Meus eventos</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td scope="row">{{ $loop->index +1 }}</td>
            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
            <td>{{ count($event->users) }}</td>
            <td>
                <a href="/events/edit/{{ $event->id }}" class="btn btn-info-edit-btn">Editar</a>
                <form action="/events/{{ $event->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger-delete-btn">
                        Deletar
                    </button>
                </form>
                
            </td>
                    
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Voce nao tem nenhum evento, <a href="/events/create">Criar um evento</a></p>
@endif

@if(count($eventasparticipant) > 0)
<h2>Eventos que estou participando</h2>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventasparticipant as $event)
        <tr>
            <td scope="row">{{ $loop->index +1 }}</td>
            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
            <td>{{ count($event->users) }}</td>
            <td>
                <form action="/events/leave/{{ $event->id }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger delete-btn">
                        Sair do evento
                    </button>
                </form>
             
            </td>
                    
        </tr>
        @endforeach
    </tbody>
</table>
@else
<hr>
<p>Voce nao está participando de nenhum evento</p>
@endif
@endsection

