@extends('layouts.main')

@section('title', 'Cadastro de Produto')

@section('content')
<div class="container mt-8">
    <p>Ativo site</p>
    <label class="toggle-switch">
        <input type="checkbox">
        <span class="toggle-slider"></span>
    </label>
</div>
<div id="event-create-container" class="col-md-16 offset-md-3">
    <h2>Cadastro de produtos</h2>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="title">Nome</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento">
        </div>
        <div class="form-group">
            <label for="date">Validade (Opcional)</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>

        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
        </div>        
            
        <div class="form-group">
            <label for="private">Ativo</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description" placeholder="Descrição"></textarea> <!-- Corrigido o fechamento da tag 'textarea' -->
        </div>
        <div class="form-group">
            <label for="variacao">
                Adicione as variações
            </label>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="cor">Cor
            </div>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="tamanho">Tamanho
            </div>            
        </div>
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>


@endsection