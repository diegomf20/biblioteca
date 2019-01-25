 <!DOCTYPE html>
 <html lang="es">
 
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Biblioteca</title>
 
   {{-- Booststrap  --}}
   <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> 
   {{-- icon fontawesome--}}
   <link href="{{asset('css/all-fontawesome.min.css')}}" rel="stylesheet">  
   {{-- datatable booststrap --}}
   <link href="{{asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet">
   {{-- css app --}}
   <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
   {{-- icon --}}
   <link rel='shortcut icon' type='image/x-icon' href='{{asset('img/icono.png')}}'/> 
   {{-- agregar esto para enviar el token en ajax --}}
   <meta name="csrf_token" content="{{csrf_token()}}"/>
 
 </head>
 
 <body id="#" class="" >
   <!-- Navigation-->
   <div class="login">
     <div class="modal-dialog h text-center">
         <div class="col-sm-9 col-10 main-section">
             <div class="modal-content h">
                 <div class="col-12 user-img">
                     <img src="{{asset('img/logo.png')}}" style="background-color: #fff" alt="">
                 </div>
                 <div class="col-12 form-input">
                     <form  method="POST" action="{{ route('postlogin') }}" id="login">
                         {{ csrf_field() }}
                          <div class="form-group">
                             <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' input-error' : '' }}" name="email" value="{{ old('email') }}" required  placeholder="Ingrese email"> {{-- autofocus --}}
                              @if ($errors->has('email'))
                                 <span class='error'>
                                     <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                             @endif
                         </div>
                         <div class="form-group{{ $errors->has('password') ? ' input-error' : '' }}">
                             <input id="password" type="password" class="form-control" name="password" required placeholder="Ingrese contraseña">
 
                             @if ($errors->has('password'))
                                 <span class="error">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                             @endif
                         </div>
 
                         <button type="submit" class="btn btn-lg btn-success"> LOGIN</button>                        
                     </form>
                 </div>
             </div>
         </div>
 
     </div>
 </div>
   {{-- booststrap y jquery --}}
   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
   {{-- scripts app --}}
   <script src="{{asset('js/sb-admin.js')}}"></script>
   
 </body>
 
 </html>
 