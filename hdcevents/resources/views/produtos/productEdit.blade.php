@extends('layouts.main')

@section('title', 'Editar Produto')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h2>Editar Produto</h2>
    <form action="/produtos/update/{{ $produto->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/products/{{ $produto->image }}" alt="{{ $produto->nome }}" class="image-preview">
        </div>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}">
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $produto->categoria }}">
        </div>

        <div class="form-group">
            <label for="sub_categoria">Sub-Categoria</label>
            <input type="text" class="sub_categoria" id="sub_categoria" name="sub_categoria" value="{{ $produto->sub_categoria }}">
        </div>

        <div class="form-group">
            <label for="custo">Custo</label>
            <input type="text" class="custo" id="custo" name="custo" value="{{ $produto->custo }}">
        </div>

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="text" class="preco" id="preco" name="preco" value="{{ $produto->preco }}">
        </div>

        <div class="form-group">
            <label for="ativo_site">Ativo Site</label>
            <select name="ativo_site" id="ativo_site" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ $produto->ativo_site == 1? "selected='selected'" : "" }}>Sim</option>
            </select>
        </div>


        <input type="submit" class="btn btn-primary" value="Atualizar">
    </form>
</div>

@endsection