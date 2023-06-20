@extends('user.layout.masterLogin')
@section('tittle')
Login
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px; height:95vh">
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
                        <label for="email" class="form-label">Email address <i class="bi bi-exclamation-octagon me-1"
                                style="color: red;"></i></label>
                        <input type="email" class="form-control" id="email" placeholder="name@runsystem.net"
                            name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password <i class="bi bi-exclamation-octagon me-1"
                                style="color: red;"></i></label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Please enter your password">
                        @error('password')
                        <div class="invalidate">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true"
                                id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                        <p>You don't have account? Go to <a href="{{route('user.getFormRegister')}}">Form Register</a>
                        </p>
                        <p>Forgot your password? Click <a id="show-edit" type="button" class="btn btn-info"
                                data-bs-toggle="modal" data-bs-target="#modalUpdateInformation">
                                <i class="ri-refresh-line"></i>
                            </a> to reset
                        </p>
                    </div>
                </form>
                <!-- Modal reset password -->
                <div class="modal fade" id="modalUpdateInformation" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style='font-weight: bold;'>Reset password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{route('user.resetPassword')}}">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            @csrf
                                            <section class="section dashboard">
                                                <div class="row mb-3">
                                                    <input type="hidden" name="id" value="">
                                                    <label for="inputEmail"
                                                        class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="emailReset"
                                                            placeholder="Ex: Example@gmail.com" value="">
                                                        @error('emailReset')
                                                        <div class="invalidate">{{ $message }}</div>
                                                        <script>
                                                        window.onload = function() {
                                                            document.getElementById('show-edit')
                                                                .click();
                                                        }
                                                        </script>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <p style="color:#817c7c;"> Chúng tôi sẽ reset password của bạn, và
                                                        sẽ gửi password về email
                                                        bạn đã đăng ký.</p>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send mail</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
