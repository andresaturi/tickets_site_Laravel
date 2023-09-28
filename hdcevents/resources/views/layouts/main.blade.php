<!doctype html>
<html lang="pt-BR">
  <head>
  	<title>@yield('title')</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo asset('css\style.css')?>" rel="stylesheet">

  </head>

  <body>

  <!--Barra superior-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="/">Teste</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            @guest
            <a href="/login">login</a>
            <a href="/register">cadastrar</a>
            @endguest
            @auth
            <li class="nav-item">
                <a class="btn" href="#">
                    <p> <?php echo auth()->user()->name; ?>
                        <i class="fa-solid fa-user"></i>
                    </p>             
                </a>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <a href="/logout"
                    class="btn btn-danger btn-sm"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </form>
            </li>
            @endauth          
        </ul>
      </div>
    </nav>
    <!--Barra Lateral-->
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>

        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="/"><span class="fa fa-home mr-3"></span>
                    Página Inicial
                </a>
            </li>
            <li>
                <a href="/events/create">
                    <span class="fa fa-sticky-note mr-3"></span>
                    Criar Evento
                </a>
            </li>
            <li>
                <a href="{% url 'listar-produtos' %}" class="nav-link">
                    <span class="fa fa-paper-plane mr-3"></span>
                    Produtos
                </a>
            </li>
            <li>
                <a href="{% url 'listar-manuais' %}"><span class="fa fa-sticky-note mr-3"></span>
                    Manuais
                </a>
            </li>
            <li>
                <a href="{% url 'listar-chamados-admin' %}" class="nav-link">
                    <span class="fa fa-paper-plane mr-3"></span>
                    Chamados
                </a>
            </li>
            <li>
                <a href="#"><span class="fa fa-sticky-note mr-3"></span> Sobre a LCS-i</a>
            </li>
        </ul>
    </nav>

  <div id="content" class="p-4 p-md-5 pt-5">
 <main>
    <div class="container-fluid">
        <div class="row">
            @if(session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif
            @yield('content')
        </div>
    </div>
 </main>
  </div>
</div>
<footer>
    <p> copyright 2023</p>
</footer>
    <script src="<?php echo asset('js/jquery.min.js')?>"></script>
    <script src="<?php echo asset('js/popper.js')?>"></script>
    <script src="<?php echo asset('js/bootstrap.min.js')?>"></script>
    <script src="<?php echo asset('js/main.js')?>"></script>
    <script src="https://kit.fontawesome.com/c0e52ba84a.js" crossorigin="anonymous"></script>

</body>

</html>