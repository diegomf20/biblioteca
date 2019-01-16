@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-boxes"></i> Bloques </span>
    </div>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-8 col-lg-6">
                <div class="card mt-5 mb-3 pt-3">
                    <div class="card-heading">
                        <div class=col-12>
                            <a class="btn btn-primary mb-3" href="{{route('bloque.create')}}">Nuevo</a> 
                            <table class="table">
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
                                        <td><a class="btn btn-success" href="{{route('bloque.edit',$bloque->id)}}">Edit</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('script')

@endsection