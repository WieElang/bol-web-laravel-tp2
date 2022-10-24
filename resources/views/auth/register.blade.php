@extends('auth.auth_base')

@section('content')

    <h4 class="text-center">Register</h4>

    <div class="d-flex flex-column p-2">
        <div class="mt-4">
            <form method="post" action="/register">
                @csrf
                <div class="form-floating mb-4">
                    <input type="text" placeholder="John Doe" 
                        class="form-control @error('name') is-invalid  @enderror"
                        required value="{{ old('name') }}" id="name" name="name">
                    <label for="name" class="form-label">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="text" placeholder="johnDoe" 
                        class="form-control @error('username') is-invalid  @enderror"
                        required value="{{ old('username') }}" id="username" name="username">
                    <label for="username" class="form-label">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="email" placeholder="johnDoe@example.com" 
                        class="form-control @error('email') is-invalid  @enderror"
                        required value="{{ old('email') }}" id="email" name="email">
                    <label for="email" class="form-label">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="password" placeholder="Password" 
                        class="form-control @error('password') is-invalid  @enderror" id="password" name="password">
                    <label for="password" class="form-label">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>    
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary center">Register</button>
            </form>
        </div>
    </div>
    
@endsection