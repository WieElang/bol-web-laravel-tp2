@extends('auth.auth_base')

@section('content')

    <h4 class="text-center">Login</h4>

    <div class="d-flex flex-column p-2">
        <div class="mt-4">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                </div>
            @endif

            <form method="post" action="/login">
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

                <div class="row mb-4">
                    <div class="col">
                    <!-- Simple link -->
                    <a href="/reset-password">Forgot password?</a>
                    </div>
                </div>

                <button id="login" type="submit" class="btn btn-primary center">Login</button>

                <span id="countdown" class="mt-4"></span>

                <div class="mt-4">
                    <p>Not a member? <a href="/register">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        let interval = 30;
        const countdownHtml = document.getElementById('countdown');
        const loginButton = document.getElementById('login');

        let today = new Date();
        let countDownDate = new Date(today.getTime() + (interval*1000));

        let failedAttemptCount = 0;
        @if(session()->has('loginError'))
            failedAttemptCount++;
            console.log(failedAttemptCount);
        @endif

        if (failedAttemptCount >= 3) {
            let x = setInterval(() => {
                let now = new Date().getTime();
                let distance = countDownDate - now;
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownHtml.innerHTML = `Login Failed, please wait for ${seconds} seconds`;
                if (distance <= 0) {
                    clearInterval(x);
                    loginButton.disabled = false
                    countdownHtml.style.display = "none";
                } else {
                    loginButton.disabled = true
                    countdownHtml.style.display = "block";
                }
            }, 30);
        }
    </script>
    
@endsection