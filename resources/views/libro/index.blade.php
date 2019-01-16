@extends('layouts.admin')

@section('content')
<?=session('mensaje','')?>
    <div class=titulo>
        <span><i class="fas fa-boxes"></i> Libros </span>
    </div>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-12">
                <div class="card mt-3 mb-3 pt-3">
                    <div class="col-12">
                        <form action="{{route('libro.index')}}" method=GET>
                            <div class="row">
                                <div class="col-2 form-group">
                                    <select class="form-control">
                                        <option value="">TODOS</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->nombre_categoria}}">{{$categoria->nombre_categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 form-group">
                                    <input type="text" class="form-control" placeholder="Buscar por Autor">
                                </div>
                                <div class="col-4 form-group">
                                    <input type="text" class="form-control" placeholder="Buscar por Titulo">
                                </div>
                                <div class="col-2 form-group">
                                    <button type=submit class="btn btn-info">Buscar</button>
                                </div>
                            </div>
                        </form>
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
                        <div class=col-12>
                            <a class="btn btn-primary mb-3" href="{{route('libro.create')}}">Nuevo</a> 
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Titulo</th>
                                        <th>Autor</th>
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
                                        {{-- <td>{{$libro->bloque_id}}</td> --}}
                                        <td>{{$libro->bloque->nombre_bloque}}</td>
                                        <td>{{$libro->fila}}</td>
                                        <td>{{$libro->categoria->nombre_categoria}}</td>
                                        <td><a class="btn btn-success" href="{{route('libro.edit',$libro->id)}}">Edit</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 justify-content-sm-center">
                            {{ $libros->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection