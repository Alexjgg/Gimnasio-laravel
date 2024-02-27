@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-50">
        <div class="card-header">
            <h1 class="text-center">Registro</h1>
        </div>
        <div class="card-body my-4">
            <form method="POST" action="{{url('register')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp"
                        value="{{ old('name') }}" placeholder="Introduce tu nombre">
                    @error('name')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Email">Email:</label>
                    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                        value="{{ old('email') }}" placeholder="Introduce el email">
                    @error('email')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
                    <label for="Password2">Confirma la contraseña:</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                    @error('password')
                    <p class="alert alert-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-auto">Registrate</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection