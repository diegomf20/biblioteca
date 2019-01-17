@extends('layouts.admin')

@section('content')
<div class=titulo>
    <span><i class="fas fa-user-graduate"></i> Modificar Estudiante </span>
</div>
<div class="col-12">
    <div class="row justify-content-sm-center">
        <div class="col-sm-8 col-lg-6">
            <div class="card mt-5 mb-3 pt-3">
                <div class="card-heading col-12">
                    <form action="{{route('estudiante.update',$estudiante->id)}}" method=POST>
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Nombre:</label>
                                <input name=nombre type="text" class="form-control  {{ $errors->has('nombre') ? 'input-error' : '' }}"
                                     value="{{$estudiante->nombre}}">
                                @if ($errors->has('nombre'))
                                    <span class="error">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Apellidos:</label>
                                <input name=apellido type="text" class="form-control  {{ $errors->has('apellido') ? 'input-error' : '' }}" 
                                    value="{{ $estudiante->apellido }}">
                                @if ($errors->has('apellido'))
                                    <span class="error">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Teléfono:</label>
                                <input name=telefono type="text" class="form-control  {{ $errors->has('telefono') ? 'input-error' : '' }}" 
                                    value="{{ $estudiante->telefono }}">
                                @if ($errors->has('telefono'))
                                    <span class="error">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Fecha Vence:</label>
                                <input name=fecha_vence type="date" class="form-control  {{ $errors->has('fecha_vence') ? 'input-error' : '' }}" 
                                    value="{{$estudiante->fecha_vence}}">
                                @if ($errors->has('fecha_vence'))
                                    <span class="error">
                                        <strong>{{ $errors->first('fecha_vence') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group col-12">
                                <button type=submit class="form-control btn-primary">Guardar</button>
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