<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Biblioteca</title>
  {{-- autocomplete --}}
  <link href="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.css')}}" rel="stylesheet">
  {{-- icon fontawesome--}}
  <link href="{{asset('css/all-fontawesome.min.css')}}" rel="stylesheet">  
  {{-- Booststrap  --}}
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> 
  
  {{-- css app --}}
  <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
  
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('img/icono.png')}}'/> 
  {{-- agregar esto para enviar el token en ajax --}}
  <meta name="csrf_token" content="{{csrf_token()}}"/>

</head>

<body class="fixed-nav sticky-footer bg" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{asset('logo.png')}}"  class=" nav-logo d-inline-block align-top" alt="">
        BIBLIOTECA
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <a class="nav-link" href="{{route('resumen.index')}}">
              <span class="nav-link-text"><i class="fas fa-book-reader"></i> Resumen</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <a class="nav-link" href="{{route('prestamo.index')}}">
              <span class="nav-link-text"><i class="fas fa-book-reader"></i> Prestamo</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <a class="nav-link" href="{{route('libro.index')}}">
              <span class="nav-link-text"><i class="fas fa-book"></i> Libro</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
              <a class="nav-link" href="{{route('estudiante.index')}}">
                <span class="nav-link-text"><i class="fas fa-user-graduate"></i> Estudiante</span>
              </a>
            </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <a class="nav-link" href="{{route('bloque.index')}}">
                <span class="nav-link-text"><i class="fas fa-boxes"></i>  Bloque</span>
            </a>
          </li>
        </ul>
              {{-- parte superior --}}
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user fa-fw"></i>
                {{ Auth::user()->name}} 
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('cerrar') }}"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Salir
            </a>
            <form id="logout-form" action="{{ route('cerrar') }}" method="POST" style="display: none;">
                {{-- <input type="text" name="ruta" id="ruta" value="pinos"> --}}
                {{ csrf_field() }}
            </form>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid" id="contenido">

        @if (session()->has('acceso'))
          <div class="myAlert-top alert alert-danger" >
            <strong> {{ session('acceso') }}</strong>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          </div>
        @endif 
      
      @yield('content') 
    </div>
    <!-- /.container-fluid-->
  </div>
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="text-center">
          <small>Copyright © 2019 - CORPORACION VESPRO</small>
        </div>
    </footer>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Realmente quiere salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="login.html">Salir</a>
          </div>
        </div>
      </div>
    </div>
    
    
  {{-- booststrap y jquery --}}
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script> 

  {{-- scripts app --}}
  <script src="{{asset('js/sb-admin.js')}}"></script> 
  @yield('script') 
  {{-- autocomplete --}}   
  <script src="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>

  <script>
    //DATOS GENERALES
    var csrf_token="{{csrf_token()}}";

    var URLactual = window.location;
    
    $(document).ready(function(){
        $(".navbar-sidenav .nav-item").each(function(){
          var a=$(this).children('a');
          var resultado=String(URLactual).indexOf(a.attr('href').substr(6));
          if(resultado>=0){
            $(this).addClass('active');
            var uls=$(this).parents('ul.sidenav-second-level');
            if(uls.length==1){
              uls.addClass('show');
            }
          }
        });
    });
  </script>
   @yield('scripts') 
  
</body>
</html>
