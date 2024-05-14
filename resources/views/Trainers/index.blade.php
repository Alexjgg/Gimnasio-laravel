@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-75">
        <div class="card-header">
            <h1 class="text-center">Mis clientes</h1>
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
                        <th scope="col">Email</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$contador++}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a class="btn btn-warning"
                                    href="{{ route('Trainer.showUserTrainings', ['id' => $user->id])}}">Entrenos</a></td>
                            <td><button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#eliminar{{$user->id}}">Quitar</button></td>
                        </tr>
                        <div class="modal fade" id="eliminar{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Quitar usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro que desea quitar a <strong>{{ $user->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,
                                            cancelar</button>
                                        <form action="{{route('Trainer.remove', $user->id)}}" method="POST">
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