@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-75">
        <div class="card-header">
            <h1 class="text-center">Ejercicios</h1>
        </div>
        <div class="card-body m-4">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Repeticiones</th>
                    <th scope="col">Duracion</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                @php
$contador = 1;
                @endphp
                  @foreach ($ejercicios as $ejercicio)
                    <tr>
                    <th scope="row">{{$contador++}}</th>
                    <td>{{$ejercicio->name}}</td>
                    <td>{{$ejercicio->descripcion}}</td>
                    <td>{{$ejercicio->repeticiones}}</td>
                    <td>{{$ejercicio->duracion}}</td>
                    <td><a class="btn btn-warnning" href="{{ route('ejercicios.edit', ['id' => $ejercicio->id])}}" >Editar</a></td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar{{$ejercicio->id}}">Eliminar</button></td>
                    </tr>
                    <div class="modal fade" id="eliminar{{$ejercicio->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar ejercicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro que desea eliminar el ejercicio <strong>{{ $ejercicio->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{route('ejercicios.destroy', $ejercicio->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Sí, eliminar ejercicio</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection