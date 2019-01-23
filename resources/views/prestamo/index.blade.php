@extends('layouts.admin')

@section('content')
    <div class="titulo">
        <span><i class="fas fa-book-reader"></i> Préstamos </span>
    </div>
    <?=session('mensaje','')?>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h4>Listas de Préstamos</h4>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-info float-right" href="{{ route('prestamo.create') }}">
                            <i class="far fa-plus-square"></i> Nuevo Prestamo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('prestamo.index')}}" class="row pt-3" method=GET>
                    <div class="col-8 form-group">
                        <input name=nombre type="text" class="form-control" placeholder="Buscar por Nombre y Apellido" value="{{$search['nombre']}}">
                    </div>
                    <div class="col-2 form-group">
                        <button type=submit class="btn btn-info">Buscar</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha de Prestamo</th>
                                <th>Fecha de Entrega</th>
                                <th>Titulo</th>
                                <th>Nombre de Estudiante</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->fecha_prestamo }}</td>
                                    <td>{{ $prestamo->fecha_entrega }}</td>
                                    <td>{{ $prestamo->libro->titulo }}</td>
                                    <td>{{ $prestamo->estudiante->nombre }} {{ $prestamo->estudiante->apellido }}</td>
                                    <td>
                                        @if ($prestamo->estado=="P")
                                            <form action="{{route('prestamo.update',$prestamo->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">PRESTADO</button>    
                                            </form>
                                        @else
                                            ENTREGADO
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 justify-content-sm-center">
                        {{ $prestamos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection