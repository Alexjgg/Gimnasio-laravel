@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-75">
        <div class="card-header">
            <h1 class="text-center">Clientes</h1>
        </div>
        <div class="card-body m-4">
        @if(session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
        <div class="row">
            <div class="col">
                <h2>Mis clientes</h2>
                <table class="table" id="left-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#Ref</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td><button type ="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button></td>
                        </tr>
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
                        @foreach ($usersWithoutTraiener as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><button type ="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row m-2">
        <form>
            <input type="hidden" name="usersWhitTrainer" id="left-table-form">
            <input type="hidden" name="usersWhitAutTrainer" id="right-table-form">
            <buttun type="submit" class="btn btn-primary">Guardar</submit>
         </form> 
         </div>
        </div>
    </div>
</div>
@endsection