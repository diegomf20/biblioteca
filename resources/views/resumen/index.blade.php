@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-user-graduate"></i> Resumen </span>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        El Libro Más Leido del Mes de {{$mes_actual}}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Prestado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top as $item)
                                <tr>
                                    <td>{{ $item->titulo }}</td>
                                    <td>{{ $item->autor }}</td>
                                    <td>{{ $item->prestado }} veces</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Top de Lector del Mes de {{$mes_actual}} 
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Lector</th>
                                    <th>Leidos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topLector as $item)
                                <tr>
                                    <td>{{ $item->nombre }} {{ $item->apellido }}</td>
                                    <td>{{ $item->prestado }} Libros</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        Libros Pendientes
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Lector</th>
                                    <th>Telefono</th>
                                    <th>Fecha de Entrega</th>
                                    <th>Nombre del Libro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestamoPendiente as $item)
                                <tr>
                                    <td>{{ $item->Estudiante->nombre }} {{ $item->estudiante->apellido }}</td>
                                    <td>{{ $item->Estudiante->telefono }}</td>
                                    <td>{{ $item->fecha_entrega}}</td>
                                    <td>{{ $item->libro->titulo}}</td>
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

@section('scripts')
    
@endsection