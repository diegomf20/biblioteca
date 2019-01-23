@extends('layouts.admin')
@section('content')
    <div class=titulo>
        <span><i class="fas fa-boxes"></i> Editar Libro </span>
    </div>
    <?=session('mensaje','')?>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-10 col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{route('libro.update',$libro->id)}}" method=POST>
                            <div class="row">
                                @csrf
                                @method('put')
                                <div class="form-group col-sm-3">
                                    <label for="">Codigo:</label>
                                    <input name=codigo type="text" class="form-control  {{ $errors->has('codigo') ? 'input-error' : '' }}" value="{{ $libro->codigo}}">
                                    @if ($errors->has('codigo'))
                                        <span class="error">
                                            <strong>{{ $errors->first('codigo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="">Cantidad:</label>
                                    <input name=unidad type="text" class="form-control  {{ $errors->has('unidad') ? 'input-error' : '' }}" value="{{ $libro->unidad }}">
                                    @if ($errors->has('unidad'))
                                        <span class="error">
                                            <strong>{{ $errors->first('unidad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Categoria:</label>
                                    <select name="categoria_id" class="form-control  {{ $errors->has('categoria_id') ? 'input-error' : '' }}">
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}" @if ($categoria->id==$libro->categoria_id) selected @endif>{{$categoria->nombre_categoria}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('categoria_id'))
                                        <span class="error">
                                            <strong>{{ $errors->first('categoria_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="">Titulo del Libro:</label>
                                    <input name=titulo type="text" class="form-control  {{ $errors->has('titulo') ? 'input-error' : '' }}" value="{{ $libro->titulo }}">
                                    @if ($errors->has('titulo'))
                                        <span class="error">
                                            <strong>{{ $errors->first('titulo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-12  col-sm-6">
                                    <label for="">Autor:</label>
                                    <input name=autor type="text" class="form-control  {{ $errors->has('autor') ? 'input-error' : '' }}" value="{{ $libro->autor }}">
                                    @if ($errors->has('autor'))
                                        <span class="error">
                                            <strong>{{ $errors->first('autor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Fecha Publicacion:</label>
                                    <input name=fecha_publicacion type="date" class="form-control  {{ $errors->has('fecha_publicacion') ? 'input-error' : '' }}" value="{{ $libro->fecha_publicacion }}">
                                    @if ($errors->has('fecha_publicacion'))
                                        <span class="error">
                                            <strong>{{ $errors->first('fecha_publicacion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="">Bloque:</label>
                                    <select name="bloque_id" class="form-control  {{ $errors->has('bloque_id') ? 'input-error' : '' }}" value="{{ $libro->bloque_id }}">
                                        @foreach($bloques as $bloque)
                                            <option value="{{$bloque->id}}" @if ($bloque->id==$libro->bloque_id) selected @endif>{{$bloque->nombre_bloque}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('bloque_id'))
                                        <span class="error">
                                            <strong>{{ $errors->first('bloque_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="">Fila:</label>
                                    <input name=fila type="text" class="form-control  {{ $errors->has('fila') ? 'input-error' : '' }}" value="{{ $libro->fila }}">
                                    @if ($errors->has('fila'))
                                        <span class="error">
                                            <strong>{{ $errors->first('fila') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-12">
                                    <label for="">Descripcion:</label>
                                    <input name=descripcion type="text" class="form-control  {{ $errors->has('descripcion') ? 'input-error' : '' }}" value="{{ $libro->descripcion }}">
                                    @if ($errors->has('descripcion'))
                                        <span class="error">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-12">
                                    <button type=submit class="form-control btn-primary">
                                            <i class="far fa-save"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection