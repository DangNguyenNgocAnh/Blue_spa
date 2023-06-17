@extends('user.layout.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px;">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        {{session()->forget('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{session('warning')}}
        {{session()->forget('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{session('failed')}}
        {{session()->forget('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column  form-login">
                <div class="pt-2 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Register Account</h5>
                    <p class="text-center small"></p>
                </div>
                <form class="row g-3 needs-validation" method="POST" action={{route('user.register')}}>
                    @csrf
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    <div class="col-12">
                        <label for="email" class="form-label">Email address <i class="bi bi-exclamation-octagon me-1" style="color: red;"></i>
                        </label>
                        <input type="email" class="form-control" id="email" placeholder="name@runsystem.net" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Fullname <i class="bi bi-exclamation-octagon me-1" style="color: red;"></i>
                        </label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nguyen Van A" value="{{ old('fullname') }}">
                        @error('fullname')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputNumber" class="col-form-label">Day of birth</label>
                        <div class="">
                            <input type="date" class="form-control" name="day_of_birth" value="{{ old('day_of_birth') }}">
                            @error('day_of_birth')
                            <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="phone_number" class="form-label">Phone number <i class="bi bi-exclamation-octagon me-1" style="color: red;"></i></label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="0911110110" value="{{ old('phone_number') }}">
                        @error('phone_number')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Da Nang, Viet Nam" value="{{ old('address') }}">
                        @error('address')
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
                        <label for="password" class="form-label">Confirm Password <i class="bi bi-exclamation-octagon me-1" style="color: red;"></i></label>
                        <input type="password" name="confPass" class="form-control" id="confPass" placeholder="Please enter your confirm password">
                        @error('confPass')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" style="margin-bottom: 20px;">Register</button>
                        <p>You have account? Back to <a href="{{route('login')}}">Login
                                <i class="ri-arrow-left-line"></i></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
