@extends('layouts.main')

@section('title', 'Dashbord')

@section('content')
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
            <th scope="row">{{ $loop->index +1 }}</th>
            <td><a href="/evens/{{ $event->id }}">{{ $event->title }}</a></td>
            <td>0</td>
            <td><a href="#">Editar</a><a href="#">Deletar</a></td>
                    
        </tr>
        @endforeach
    </tbody>
</table>

<p>Voce nao tem nenhum evento, <a href="/events/create">\Criar um evento</a></p>

@endsection

