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
            <td><a href="/evens/{{ $event->id }}">{{ $event->title }}</a></td>
            <td>0</td>
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
@endsection

