@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-50">
        <div class="card-header">
            <h1 class="text-center">Editar usuario</h1>
        </div>
        <div class="card-body my-4">
            @error('error')
                <p class="alert alert-danger">{{$message}}</p>
            @enderror
            <form method="POST" action="{{route('Users.update', ['id' => $user->id])}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp"
                        value="{{ old('name', $user->name) }}" placeholder="Introduce tu nombre">
                    @error('name')
                        <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Email">Email:</label>
                    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                        value="{{ old('email', $user->email) }}" placeholder="Introduce el email">
                    @error('email')
                        <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Password">Contraseña:</label>
                    <input type="password" class=" form-control" name="password" id="Password" placeholder="Password">
                    <label for="Password2">Confirma la contraseña:</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        autocomplete="new-password">
                    @error('password')
                        <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                @if(Auth::user()->hasRole('admin'))
                    <div class="form-group">
                        <label for="Select">Role:</label>
                        <select class="form-control" id="Select" name="role">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : ''}}>User</option>
                            <option value="entrenador" {{ $user->role == 'entrenador' ? 'selected' : ''}}>Entrenador</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                        </select>
                    </div>
                @endif
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-auto">Actualizar usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection