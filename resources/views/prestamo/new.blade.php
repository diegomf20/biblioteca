@extends('layouts.admin')

@section('content')
<div class=titulo>
    <span><i class="fas fa-book-reader"></i> Nuevo Prestamo </span>
</div>
<style>
    .tab-content{
        border-right: 1px solid #dee2e6;
        border-left: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
        background-color: #fff;
    }
</style>
<div class="col-12 mt-3 mb-3 pt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="libro-tab" data-toggle="tab" href="#libro" role="tab" aria-controls="libro" aria-selected="true">Buscar Libro</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Datos del Prestamo</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="libro" role="tabpanel" aria-labelledby="libro-tab">
            <div class="col-12">
                <form action="{{route('prestamo.create')}}" class="row pt-3" method=GET>
                    <div class="col-2 form-group">
                        <select name=categoria class="form-control">
                            <option value="">TODOS</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nombre_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <input name=autor type="text" class="form-control" placeholder="Buscar por Autor" value="{{$search['autor']}}">
                    </div>
                    <div class="col-4 form-group">
                        <input name=titulo type="text" class="form-control" placeholder="Buscar por Titulo" value="{{$search['titulo']}}">
                    </div>
                    <div class="col-2 form-group">
                        <button type=submit class="btn btn-info">Buscar</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Tipo</th>
                            <th>Disponible</th>
                            <th>
                                Seleccionar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                        <tr>
                            <td>{{$libro->titulo}}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>{{ $libro->categoria->nombre_categoria }}</td>
                            <td>{{ $libro->unidad - $libro->prestado }}</td>
                            <td id="libro-{{ $libro->id }}" hidden>{{ $libro }}</td>
                            <td>
                                @if (($libro->unidad - $libro->prestado)>0)
                                    <a id="seleccionar-{{ $libro->id }}" class="btn btn-primary btn-sm btn-seleccionar">
                                        <i class="far fa-check-square"></i>
                                    </a>
                                @else
                                    
                                @endif
                            </td>
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
        <div class="tab-pane fade" id="datos" role="tabpanel" aria-labelledby="datos-tab">
            <div class="card ">
                <div class="card-body col-12">
                    <form action="{{ route('prestamo.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="">Titulo:</label>
                                <input id=txt-id-libro name=libro_id type="text" hidden>
                                <input id=txt-libro  class="form-control" type="text" readonly> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="">Autor:</label>
                                <input id=txt-autor  class="form-control" type="text" readonly> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="">Estudiante:</label>
                                <input id=txt-id-estudiante name="estudiante_id" type="text"  value="">
                                <input id=txt-estudiante  class="form-control" type="text" required> 
                            </div>
                            <div class="col-sm-3 form-group">
                                <label for="">Fecha Prestamo:</label>
                                <input name=fecha_prestamo type="date" class="form-control" name="" id="txt-fecha-prestamo" value="<?php echo date("Y-m-d");?>">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label for="">Fecha Entrega:</label>
                                <input name=fecha_entrega type="date" class="form-control" name="" id="txt-fecha-entrega" value="<?php echo date("Y-m-d",strtotime("+1 day"));?>">
                            </div>
                            <div class="col-12 form-group">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> GUARDAR</button>
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
    <script>
        var libro;
        $('.btn-seleccionar').click(function(){
            var id=$(this).attr('id').split('-')[1];
            libro=JSON.parse($('#libro-'+id).text());
            $('#datos-tab').click();
            $('#txt-id-libro').val(libro.id);
            $('#txt-libro').val(libro.titulo);
            $('#txt-autor').val(libro.autor);
        });

        $("#txt-estudiante").keyup(function(){
            console.log($('#txt-estudiante').val());
            // console.log('q');
            $( "#txt-estudiante" ).autocomplete({
                source: "{!!URL::route('estudiante.buscar')!!}",
                minLength: 3,
                select: function(event, ui) {
                    $('#txt-estudiante').val(ui.item.value);
                    $('#txt-id-estudiante').val(ui.item.id);
                    console.log($('#txt-estudiante').val());
                },
                search: function( event, ui ) {
                    $('#txt-id-estudiante').val('');
                }                
            });  
        });


    </script>
@endsection