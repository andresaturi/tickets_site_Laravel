@extends('layouts.main')

@section('title', 'Produtos')

@section('content')

<a href="produtos/create" class="btn btn-primary btn-sm align-right">Novo Produto</a>
@if(count($produtos) > 0) 

<div id='search-container' class="col-md-12">
    <!--if(search)
    <h3>Buscando por " search }}"</h3>
    <a href="/">Limpar Busca</a>
    else
    <h3>Busque um Produto</h3>
    endif
-->
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar evento">
    </form>
    <div id="events-container" class="col-md-12">   
        <div id="cards-container" class="row">
            @foreach($produtos as $produto)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="\img\products\{{ $produto->image }}" class="img-fluid"alt="" class="image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <a href="/produtos/{{ $produto->id }}" class="btn btn-primary btn-sm">Ver</a>
                        <a href="/produtos/edit/{{ $produto->id }}" class="btn btn-secondary btn-sm">Editar</a>
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