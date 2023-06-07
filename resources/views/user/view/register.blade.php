@extends('user.layout.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    <div class="card-body">
        <div class="pt-2 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Login</h5>
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
                <label for="email" class="form-label">Email
                    address</label>
                <input type="email" class="form-control" id="email" placeholder="name@runsystem.net" name="email"
                    value="{{ old('email') }}">
                @error('email')
                <div class="invalidate">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="email" class="form-label">Fullname
                    address</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
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
                <label for="inputText" class="form-label">Phone number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone_number" placeholder="Ex: 123456789"
                        value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <div class="invalidate">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <label for="inputText" class="form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address"
                        placeholder="Ex: 01 Nguyễn Văn Linh, P Hòa Cường Bắc, TP Đà Nẵng" value="{{ old('address') }}">
                    @error('address')
                    <div class="invalidate">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="Please enter your password">
                @error('password')
                <div class="invalidate">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" name="confPass" class="form-control" id="confPass"
                    placeholder="Please enter your confPass">
                @error('confPass')
                <div class="invalidate">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </div>
        </form>
    </div>
</main>
@endsection
