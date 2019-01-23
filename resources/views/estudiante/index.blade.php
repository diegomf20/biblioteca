@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-user-graduate"></i> Estudiantes </span>
    </div>
    <?=session('mensaje','')?>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h4>
                                    Lista de Estudiantes
                                </h4>
                            </div>
                            <div class="col-2">
                                <a class="btn btn-primary" href="{{route('estudiante.create')}}">
                                    <i class="far fa-plus-square"></i>
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('estudiante.index')}}" class="row pt-3" method=GET>
                            <div class="col-8 form-group">
                                <input name=nombre type="text" class="form-control" placeholder="Buscar por Nombre y Apellido" value="{{$search['nombre']}}">
                            </div>
                            <div class="col-2 form-group">
                                <button type=submit class="btn btn-info">Buscar</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class=>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>F.V. Carnet</th>
                                        <th>Editar</th>
                                    </tr>                                
                                </thead>
                                <tbody>
                                @foreach($estudiantes as $estudiante)
                                    <tr>
                                        <td>{{$estudiante->nombre}}</td>
                                        <td>{{$estudiante->apellido}}</td>
                                        <td>{{$estudiante->telefono}}</td>
                                        <td>{{$estudiante->fecha_vence}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{route('estudiante.edit',$estudiante->id)}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <div class="row">
                                <div class="col-12 justify-content-sm-center">
                                    {{ $estudiantes->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('script')

@endsection