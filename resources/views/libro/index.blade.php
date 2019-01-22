@extends('layouts.admin')

@section('content')
<?=session('mensaje','')?>
    <div class=titulo>
        <span><i class="fas fa-boxes"></i> Libros </span>
    </div>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10 col-sm-8"><h4>Lista de Libros</h4></div>
                            <div class="col-2 col-sm-4">
                                <a class="btn btn-primary float-right" href="{{route('libro.create')}}">
                                    <i class="far fa-plus-square"></i>
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('libro.index')}}" method=GET>
                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <select class="form-control">
                                        <option value="">TODOS</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->nombre_categoria}}">{{$categoria->nombre_categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <input type="text" class="form-control" placeholder="Buscar por Autor">
                                </div>
                                <div class="col-4 form-group">
                                    <input type="text" class="form-control" placeholder="Buscar por Titulo">
                                </div>
                                <div class="col-1 form-group">
                                    <button type=submit class="btn btn-primary float-right"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Unidades</th>
                                    <th>Bloque</th>
                                    <th>Filas</th>
                                    <th>Categoria</th>
                                    <th>Editar</th>
                                </tr>                                
                            </thead>
                            <tbody>
                            @foreach($libros as $libro)
                                <tr>
                                    <td>{{$libro->codigo}}</td>
                                    <td>{{$libro->titulo}}</td>
                                    <td>{{$libro->autor}}</td>
                                    <td>{{$libro->unidad}}</td>
                                    {{-- <td>{{$libro->bloque_id}}</td> --}}
                                    <td>{{$libro->bloque->nombre_bloque}}</td>
                                    <td>{{$libro->fila}}</td>
                                    <td>{{$libro->categoria->nombre_categoria}}</td>
                                    <td><a class="btn btn-warning" href="{{route('libro.edit',$libro->id)}}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 justify-content-sm-center">
                                {{ $libros->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-12">
                <div class="card mt-3 mb-3 pt-3">
                    <div class="card-heading">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection