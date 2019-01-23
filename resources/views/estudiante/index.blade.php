@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-user-graduate"></i> Estudiantes </span>
    </div>
    <?=session('mensaje','')?>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-8">
                <div class="card">
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
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('script')

@endsection