<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('titulo') - Sistema Diocese do Rio de janeiro</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{url('assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">
<!-- DataTables CSS-->
  <link rel="stylesheet" href="{{url('assets/bundles/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">

  <!-- CSS Select2 -->
  <link rel="stylesheet" href="{{url('assets/bundles/select2/dist/css/select2.min.css')}}">

  <!-- carrosel -->

<link rel="stylesheet" href="{{url('assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{url('assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">




 
  
  <!-- Custom JS-->

  <!-- <link rel="text/javascript" href="{{URL::asset('js/jquery.mask.min.js')}}">
  <link rel="text/javascript" href="{{URL::asset('js/mask.js')}}"> -->


  <link rel='shortcut icon' type='image/x-icon' href="{{url('assets/img/favicon.ico')}}" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

<!-- navbar-->
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <!--<form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>-->
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <!--<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">John
                      Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Request for leave
                      application</span>
                    <span class="time">5 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-5.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                      Ryan</span> <span class="time messege-text">Your payment invoice is
                      generated.</span> <span class="time">12 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-4.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                      Smith</span> <span class="time messege-text">hii John, I have upload
                      doc
                      related to task.</span> <span class="time">30
                      Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-3.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                      Joshi</span> <span class="time messege-text">Please do as specify.
                      Let me
                      know if you have any query.</span> <span class="time">1
                      Days Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Client Requirements</span>
                    <span class="time">2 Days Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>-->
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notificações
                <div class="float-right">
                  <a href="#">Marcar todos como lido</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
												fa-user"></i>
                  </span> <span class="dropdown-item-desc"> Teste
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">Ver todos <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{url('assets/img/users/'.Auth::user()->image)}}"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Olá {{Auth::user()->name}}</div>
              <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Perfil
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Configurações
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{route('sair')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Sair
              </a>
            </div>
          </li>
        </ul>
      </nav>
	  
	  <!-- navbar--!>
     
	 <!-- sidebar-->
	 <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('home')}}">
              <img style="margin-top:5%" alt="image" src="{{url('assets/img/logo.png')}}" class="header-logo" /> 
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Painel</li>
            <li class="dropdown active">
              <a href="{{route('home')}}" class="nav-link">
                <i data-feather="monitor"></i><span>Dashboard</span>
              </a>
            </li>
            <li class="menu-header">Páginas</li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Usuários</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('usuarios') }}">Listar usuários</a></li>
                <li><a class="nav-link" href="alert.html">Adicionar usuário</a></li>
                <li><a class="nav-link" href="alert.html">Listar cargos</a></li>
                <li><a class="nav-link" href="alert.html">Adicionar cargo</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="archive"></i><span>Acervos</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('acervo') }}">Listar acervos</a></li>
                <li><a class="nav-link" href="{{ route('criar_acervo') }}">Adicionar acervo</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="archive"></i><span>Obras</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('obra') }}">Listar obras</a></li>
                <li><a class="nav-link" href="{{ route('criar_obra') }}">Adicionar obra</a></li>
              </ul>
            </li>
        </aside>
      </div>
      <!-- conteudo das páginas -->
        @yield('content')

	  
	  <!--conteudo -->
     
	  <footer>
		
		<!-- rodape-->
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{url('assets/js/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{url('assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{url('assets/bundles/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{url('assets/js/page/index.js')}}"></script>
  <script src="{{url('assets/js/page/owl-carousel.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{url('assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{url('assets/js/custom.js')}}"></script>
  <!-- DataTables JS -->
  <script src="{{url('assets/bundles/datatables/datatables.min.js')}}"></script>
  <script src="{{url('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{url('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{url('assets/js/page/datatables.js')}}"></script>
  <!-- Select2 JS -->
  <script src="{{url('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
  <!-- Sweetalerts JS -->
  <script src="{{url('assets/bundles/sweetalert/sweetalert.min.js')}}"></script>





</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>