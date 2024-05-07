@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-75">
        <div class="card-header">
            <h1 class="text-center">Entrenamiento</h1>
        </div>
        <div class="card-body m-4">
        @if(session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif
        
        <div class="row m-2">
            <form>
                <div class="form-group">
                    <label for="Name-training">Nombre del entrenamiento:</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nameTraining">
                 </div> 
                <input type="hidden" name="idTraining" value="{{$idTraining}}">
                <input type="hidden" name="exercisesInTraining" id="left-table-form">
                <input type="hidden" name="exercisesWithoutTraining" id="right-table-form">
                <buttun type="submit" class="btn btn-primary">Guardar</submit>
            </form> 
         </div>
            <div class="row">
            <div class="col">
                <h2>Ejercicios del entrenamiento</h2>
                <table class="table" id="left-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#Ref</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Mover</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($exercisesInTraining as $exercise)
                        <tr>
                            <td>{{$exercise->id}}</td>
                            <td>{{$exercise->name}}</td>
                            <td>{{$exercise->descripcion}}</td>
                            <td>{{$exercise->repeticiones}}</td>
                            <td><button type ="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
            <div class="col">
                <h2>Ejercicios disponibles</h2>
                <table class="table" id="right-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#Ref</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Mover</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exercisesWithoutTraining as $exercise)
                        <tr>
                            <td>{{$exercise->id}}</td>
                            <td>{{$exercise->name}}</td>
                            <td>{{$exercise->descripcion}}</td>
                            <td><button type ="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection