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
  {{-- datatable booststrap --}}
  <link href="{{asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet">
  {{-- fonts --}}
  <link href="https://fonts.googleapis.com/css?family=Warnes" rel="stylesheet">
  {{-- imprimir pdf  --}}
  <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">
  
  {{-- css app --}}
  <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
  
  {{-- calendario --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css"> --}}

  <link rel='shortcut icon' type='image/x-icon' href='{{asset('img/dolar.png')}}'/> 
  {{-- agregar esto para enviar el token en ajax --}}
  <meta name="csrf_token" content="{{csrf_token()}}"/>

</head>

<body class="fixed-nav sticky-footer bg" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('home')}}">
        <img src="{{asset('logo.png')}}"  class=" nav-logo d-inline-block align-top" alt="">
        {{ Auth::user()->empresa->nombre}}
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Caja">
            <a class="nav-link" href="{{route('operaciones.cajahoy')}}">
              <i class="fas fa-home"></i> <span class="nav-link-text"> Caja</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Operaciones">
            <a class="nav-link" href="{{route('ingreso.create')}}">
              <i class="fas fa-folder-minus"></i> <span class="nav-link-text"> Operaciones</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Operaciones">
            <a class="nav-link" href="{{route('transferencia.index')}}">
              <i class="fas fa-folder-minus"></i> <span class="nav-link-text">Transferencia Caja/Banco</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="informes">
            <a class="nav-link collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
              <i class="fas fa-search"></i> <span class="nav-link-text">Informes</span>
              <i class="fas fa-angle-double-down fa-rigth"></i>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Operaciones hoy ">
                <a class="nav-link" href="{{route('operaciones.hoy')}}">
                  <i class="far fa-file-alt"></i> <span class="nav-link-text">Operaciones hoy</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Ingresos">
              <a class="nav-link" href="{{route('operaciones.ingresos')}}">
                  <i class="far fa-arrow-alt-circle-right"></i>
                  <span class="nav-link-text">Ingresos</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="egresos">
                <a class="nav-link" href="{{route('operaciones.egresos')}}">
                  <i class="far fa-arrow-alt-circle-left"></i>
                  <span class="nav-link-text">Egresos</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Depositos">
                <a class="nav-link" href="{{route('operaciones.depositos')}}">
                  <i class="fas fa-arrow-alt-circle-right"></i>
                  <span class="nav-link-text">Depositos</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Transferencias">
                <a class="nav-link" href="{{route('operaciones.transferencias')}}">
                  <i class="fas fa-arrow-alt-circle-left"></i>
                  <span class="nav-link-text">Transferencias</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Afiliados">
            <a class="nav-link" href="{{route('afiliado.index')}}">
              <i class="fa fa-fw fa-users"></i>
              <span class="nav-link-text">Afiliados</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Proveedores">
            <a class="nav-link" href="{{route('proveedor.index')}}">
              <i class="fa fa-fw fa-user-tag"></i>
              <span class="nav-link-text">Proveedores</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
            <a class="nav-link" href="{{route('user.index')}}">
              <i class="fa fa-fw fa-users-cog"></i>
              <span class="nav-link-text">Usuarios</span>
            </a>
          </li>
  
  
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Conceptos">
            <a class="nav-link collapsed" data-toggle="collapse" href="#concepto" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-wrench"></i>
              <span class="nav-link-text">Conceptos</span>
              <i class="fas fa-angle-double-down fa-rigth"></i>
            </a>
            <ul class="sidenav-second-level collapse" id="concepto">
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Concepto Ingresos ">
                <a class="nav-link" href="{{route('concepto.index')}}">
                  <i class="fas fa-location-arrow"></i>
                  <span class="nav-link-text">Concepto Ingresos</span>
                </a>
              </li>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Conceptos Egresos">
                <a class="nav-link" href="{{route('concepto_egreso.index')}}">
                  <i class="far fa-arrow-alt-circle-right"></i>
                  <span class="nav-link-text">Concepto Egreso</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
            <a class="nav-link" href="{{route('empresa.admin', Auth::user()->empresa_id)}}">
              <i class="fa fa-fw fa-users-cog"></i>
              <span class="nav-link-text">Configuraciones</span>
            </a>
          </li>
          @if (Auth::user()->rol_id==4 )
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
              <a class="nav-link" href="{{route('empresa.index')}}">
                <i class="fa fa-fw fa-users-cog"></i>
                <span class="nav-link-text">Empresa</span>
              </a>
            </li>
          @endif
          
        </ul>
      {{-- parte superior --}}
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user fa-fw"></i>
            {{ Auth::user()->name  }} {{--{{ Auth::user()->apellido  }}
            {{-- {{ Auth::user()->rol->nombre }} --}}
            {{-- {{ Auth::user()->hasRol('Gerente') }} --}}

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
 
  

  {{-- datateble--}}
  <script src="{{asset('js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('js/sb-admin-datatables.js')}}"></script>

  {{-- js para numeros --}}
  <script src="{{asset('js/jquery.number.min.js')}}"></script> 
  {{-- scripts app --}}
  <script src="{{asset('js/sb-admin.js')}}"></script> 
  @yield('script') 
  {{-- autocomplete --}}   
  <script src="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script> --}}
  {{-- calendario --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/locale-all.js"></script>


  {{-- imprimir pdf --}}
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

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
