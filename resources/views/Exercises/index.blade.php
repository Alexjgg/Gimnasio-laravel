@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-75">
        <div class="card-header">
            <h1 class="text-center">Ejercicios</h1>
        </div>
        <div class="card-body m-4">
        @if(session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
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
                  @foreach ($exercises as $exercise)
                    <tr>
                    <th scope="row">{{$contador++}}</th>
                    <td>{{$exercise->name}}</td>
                    <td>{{$exercise->description}}</td>
                    <td>{{$exercise->repetitions}}</td>
                    <td>{{$exercise->duration}}</td>
                    <td><a class="btn btn-warning" href="{{ route('Exercises.edit', ['id' => $exercise->id])}}" >Editar</a></td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminar{{$exercise->id}}">Eliminar</button></td>
                    </tr>
                    <div class="modal fade" id="eliminar{{$exercise->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar ejercicio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro que desea eliminar el ejercicio <strong>{{ $exercise->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No,
                                        cancelar</button>
                                    <form action="{{route('Exercises.destroy', $exercise->id)}}" method="POST">
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