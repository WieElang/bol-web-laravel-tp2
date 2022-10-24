@extends('auth.auth_base')

@section('content')

    <h4 class="text-center">Reset Password</h4>

    <div class="d-flex flex-column p-2">
        <div class="mt-4">
            <form method="post" action="/reset-password">
                @csrf
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
                <button type="submit" class="btn btn-primary center">Change Password</button>
            </form>
        </div>
    </div>
    
@endsection