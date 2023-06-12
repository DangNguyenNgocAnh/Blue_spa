@extends('user.layout.master')
@section('tittle')
Login
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px; height:95vh">
    <div class="card-body">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <div class="col-lg-4 col-md-6 d-flex flex-column  form-login">

                <div class="pt-2 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                    <br>
                </div>
                <form class="row g-3 needs-validation" method="POST">
                    @csrf
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    <div class="col-12">
                        <label for="email" class="form-label">Email address <i class="bi bi-exclamation-octagon me-1" style="color: red;"></i></label>
                        <input type="email" class="form-control" id="email" placeholder="name@runsystem.net" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password <i class="bi bi-exclamation-octagon me-1" style="color: red;"></i></label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Please enter your password">
                        @error('password')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                        <p>You have account? Back to <a href="{{route('user.register')}}">Form Register
                                <i lass="ri-arrow-left-line"></i></a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection
