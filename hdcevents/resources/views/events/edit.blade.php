@extends('layouts.main')

@section('title', 'Editar Evento')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="image-preview">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label for="date">Data do Evento</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="{{ $event->cidade }}">
        </div>        
            
        <div class="form-group">
            <label for="private">O Evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ $event->private == 1? "selected='selected'" : "" }}>Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description" placeholder="Descrição">{{ $event->description }}</textarea> <!-- Corrigido o fechamento da tag 'textarea' -->
        </div>
        <div class="form-group">
            <label for="variacao">
                Adicione as variação
            </label>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="cor">Cor
            </div>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="tamanho">Tamanho
            </div>            
        </div>
        <input type="submit" class="btn btn-primary" value="Atualizar">
    </form>
</div>


@endsection