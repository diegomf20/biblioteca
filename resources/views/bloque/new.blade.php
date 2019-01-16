@extends('layouts.admin')

@section('content')
    <div class=titulo>
        <span><i class="fas fa-boxes"></i> Nuevo Bloque </span>
    </div>
    <div class="col-12">
        <div class="row justify-content-sm-center">
            <div class="col-sm-6 col-lg-4">
                <div class="card mt-5 mb-3 pt-3">
                    <div class="card-heading">
                        <form action="{{route('bloque.store')}}" method=POST>
                            @csrf
                            <div class="form-group col-12">
                                <label for="">Nombre de bloque:</label>
                                <input name=nombre type="text" class="form-control  {{ $errors->has('nombre') ? 'input-error' : '' }}" value="{{ old('nombre') }}">
                                @if ($errors->has('nombre'))
                                    <span class="error">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-12">
                                <label for="">Filas:</label>
                                <input name=filas type="text" class="form-control  {{ $errors->has('filas') ? 'input-error' : '' }}" value="{{ old('filas') }}">
                                @if ($errors->has('filas'))
                                    <span class="error">
                                        <strong>{{ $errors->first('filas') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-12">
                                <button type=submit class="form-control btn-primary">Guardar</button>
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