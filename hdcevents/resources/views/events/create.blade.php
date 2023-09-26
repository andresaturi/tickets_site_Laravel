@extends('layouts.main')

@section('title', 'Cadastrar Evento')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu Evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento">
        </div>

        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
        </div>        
            
        <div class="form-group">
            <label for="private">O Evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description" placeholder="Descrição"></textarea> <!-- Corrigido o fechamento da tag 'textarea' -->
        </div>

        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>


@endsection