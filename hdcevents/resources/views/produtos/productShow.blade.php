@extends('layouts.main')

@section('title', 'Produtos')

@section('content')

<div class="col-md-10 offset-md-1">
    <a href="/produtos">Voltar</a>
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/products/{{ $produto->image }}" class="img-fluid" alt="{{ $produto->nome }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $produto->nome }}</h1>
                <p class="event-city">R$ {{ $produto->preco }}</p> 
                            
            </div>
            <div class="col-md-12" id="description-container">
                <p>nada aqui</p>
            </div>   
        </div>
    </div>

@endsection