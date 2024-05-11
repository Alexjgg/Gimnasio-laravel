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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group p-2">
                                    <label for="Name-training">Nombre del entrenamiento:</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{$training->name ?? 'Nombre'}}" value="{{$training->name ?? ''}}"
                                        name="nameTraining">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2">
                                    <label for="Day-training">Día del entrenamiento:</label>
                                    <select class="form-control shadow-sm p-2 mb-3 bg-white rounded" name="dia"
                                        id="dia">
                                        <option value="">Selecciona un día</option>
                                        @php
                                            $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                                            $selectedDia = isset($training) ? $training->day : null;
                                        @endphp
                                        @foreach($dias as $dia)
                                            <option value="{{ $dia }}" {{ $selectedDia == $dia ? 'selected' : '' }}>{{ $dia }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_training" value="{{$training->id ?? 'new' }}">
                        <input type="hidden" name="exercisesInTraining" id="left-table-form">
                        <input type="hidden" name="exercisesWithoutTraining" id="right-table-form">
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
                    <h2>Ejercicios del entrenamiento</h2>
                    <table class="table" id="left-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#Ref</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Repeticiones</th>
                                <th scope="col">Mover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exercisesInTraining as $exercise)
                                <tr>
                                    <td>{{$exercise->id}}</td>
                                    <td>{{$exercise->name}}</td>
                                    <td>{{$exercise->description}}</td>
                                    <td>{{$exercise->repettions}}</td>
                                    <td><button type="button" class="btn btn-primary" onclick="moveRow(this)">Mover</button>
                                    </td>
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
                                <th scope="col">Repeticiones</th>
                                <th scope="col">Mover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exercisesWithoutTraining as $exercise)
                                <tr>
                                    <td>{{$exercise->id}}</td>
                                    <td>{{$exercise->name}}</td>
                                    <td>{{$exercise->description}}</td>
                                    <td>{{$exercise->repettions}}</td>
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