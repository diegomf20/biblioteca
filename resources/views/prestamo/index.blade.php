@extends('layouts.admin')

@section('content')
    <div class="titulo">
        <span><i class="fas fa-boxes"></i> Prestamos </span>
    </div>
    <?=session('mensaje','')?>
    <div class="col-12 mt-3 mb-3">
        <div class="row">
            <div class="col-sm-8">
                <h4>Listas de Prestamos</h4>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-info" href="{{ route('prestamo.create') }}">Nuevo Prestamo</a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <table class="table">
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
                        <td>{{ $prestamo->estudiante->nombre }}</td>
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
@endsection
@section('script')

@endsection