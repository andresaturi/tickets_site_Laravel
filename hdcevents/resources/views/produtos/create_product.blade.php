@extends('layouts.main')

@section('title', 'Cadastro de Produto')

@section('content')

<div id="event-create-container" class="col-md-16 offset-md-3">
    <h2>Cadastro de produtos</h2>
    <form action="/produtos" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria">
        </div>

        <div class="form-group">
            <label for="sub_categoria">Sub-Categoria</label>
            <input type="text" class="sub_categoria" id="sub_categoria" name="sub_categoria">
        </div>

        <div class="form-group">
            <label for="custo">Custo</label>
            <input type="text" class="custo" id="custo" name="custo">
        </div>

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="text" class="preco" id="preco" name="preco">
        </div>

        <div class="form-group">
            <label for="ativo_site">Ativo Site</label>
            <select name="ativo_site" id="ativo_site" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <input type="submit" class="btn btn-primary" value="Cadastrar">
    </form>
</div>


@endsection