@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-user-graduate"></i> Estudiantes </span>
    </div>
    <?=session('mensaje','')?>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-10">
                <div class="row mt-3">
                    <div class="col-sm-8">
                        <h4>
                            Lista de Estudiantes
                            <a class="btn btn-primary mb-3" href="{{route('libro.create')}}">Nuevo</a> 
                        </h4>
                    </div>
                </div>
                <div class="row mb-3 pt-3">
                    <div class=col-12>
                        <table class="table table-striped table-bordered">
                            <thead class=>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Fecha Vence</th>
                                    <th>Edit</th>
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
                                        <a class="btn btn-success btn-sm" href="{{route('estudiante.edit',$estudiante->id)}}">
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