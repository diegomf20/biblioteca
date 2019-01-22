@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-boxes"></i> Bloques </span>
    </div>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-8 col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10 col-sm-8"><h4>Lista de Bloques</h4></div>
                            <div class="col-2 col-sm-4">
                                <a class="btn btn-primary float-right" href="{{route('bloque.create')}}">
                                    <i class="far fa-plus-square"></i>
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Filas</th>
                                    <th>Editar</th>
                                </tr>                                
                            </thead>
                            <tbody>
                                @foreach($bloques as $bloque)
                                    <tr>
                                        <td>{{$bloque->nombre_bloque}}</td>
                                        <td>{{$bloque->filas}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{route('bloque.edit',$bloque->id)}}">
                                                <i class="fas fa-edit"></i>
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