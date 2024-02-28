@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-50">
        <div class="card-header">
            <h1 class="text-center">{{$textoView}}</h1>
        </div>
        <div class="card-body my-4">
            @error('error')
                <p class="alert alert-danger">{{$message}}</p>
            @enderror
            <form method="POST" action="{{$controller}}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp"
                        value="{{  isset($ejercicio->name) ? $ejercicio->name : ''}}" placeholder="Introduce un nombre">
                    @error('name')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion:</label>
                    <textarea type="textarea" class="form-control" name="descripcion" id="descripcion" aria-describedby="descripcionHelp"
                        placeholder="Descripcion del ejercicio">{{  isset($ejercicio->descripcion) ? $ejercicio->descripcion : '' }}</textarea>
                    @error('descripcion')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="repeticiones">Repeticiones:</label>
                    <input type="text" class="form-control" name="repeticiones" id="repeticiones" aria-describedby="repeticionesHelp"
                        value="{{  isset($ejercicio->repeticiones) ? $ejercicio->repeticiones : '' }}" placeholder="Introduce las repeticiones del ejercicio">
                    @error('repeticiones')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="duracion">Duración:</label>
                    <input type="text" class="form-control" name="duracion" id="duracion" aria-describedby="duracionHelp"
                        value="{{  isset($ejercicio->duracion) ? $ejercicio->duracion : '' }}" placeholder="Introduce la duración del ejercico">
                    @error('duracion')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-auto">{{$textoView}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection