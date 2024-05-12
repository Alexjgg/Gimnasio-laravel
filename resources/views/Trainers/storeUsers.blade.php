@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-75">
        <div class="card-header">
            <h1 class="text-center">
                @if($titel)
                    {{$titel}}
                @endif

            </h1>
        </div>
        <div class="card-body m-4">
            @if(session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
            <div class="row m-2">
                <div class="col">
                    <form method="POST" action="{{$controller}}">
                        @csrf
                        <input type="hidden" name="userWithTrainer" id="left-table-form">
                        <input type="hidden" name="userWithoutTrainer" id="right-table-form">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
            @error('errors')
                <div>
                    <p class="alert alert-danger">{{$message}}</p>
                </div>
            @enderror
            <div class="row">
                <div class="col">
                    <h2>Mis clientes</h2>
                    <table class="table" id="left-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#Ref</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Mover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userWithTrainer as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><button type="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <h2>Clientes disponibles</h2>
                    <table class="table" id="right-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#Ref</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userWithoutTrainer as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><button type="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection