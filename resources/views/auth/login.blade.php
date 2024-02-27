@extends("app")
@section('content')
<div class="row justify-content-center">
    <div class="card mt-4 w-50">
        <div class="card-header">
            <h1 class="text-center">LOGIN</h1>
        </div>
        <div class="card-body my-4">
            @error('email')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <form method="POST" action="{{url('login')}}">
                @csrf
                <div class="form-group">
                    <label for="Email1">Email address:</label>
                    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                        value="{{ old('email') }}" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="Password">Password:</label>
                    <input type="password" class="form-control" name="password" id="Password" placeholder="Contraseña">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-auto">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection