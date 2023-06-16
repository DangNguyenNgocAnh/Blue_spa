<header id="header" class="header fixed-top d-flex align-items-center" style="height:10vh">
    <div class="d-flex align-items-center justify-content-between">
        <div class="logo d-flex align-items-center">
            <a href="{{route('admin.dashboard')}}">
                <img src="{{ Vite::asset('resources/assets/img/logo.png') }}" alt="">
            </a>
            <div style="padding-top: 13px;">
                <span class="d-none d-lg-block">Blue Spa</span>
                <p style="font-weight: lighter;">Beauty Center Admin</p>
            </div>
        </div>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
</header>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content form-setting">
            <div class="modal-header form-setting_header">
                <h5 class="modal-title" id="staticBackdropLabel">Account setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <i class="bi bi-shield-lock"></i>
                            Sercurity
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false"></button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false"></button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabjustifiedContent">
                    <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                        <h5 class="setting-content_title">Change Password</h5>
                        <form action="{{route('users.change-pass')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-form-label">Current password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="currentPass" class="form-control" value="{{ old('currentPass') }}">
                                </div>
                                @error('currentPass')
                                <div class="invalidate">{{ $message }}</div>
                                <script>
                                    window.onload = function() {
                                        document.getElementById('show-setting').click();
                                    }
                                </script>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-form-label">New password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="newPass" class="form-control" value="{{ old('newPass') }}">
                                </div>
                                @error('newPass')
                                <div class="invalidate">{{ $message }}</div>
                                <script>
                                    window.onload = function() {
                                        document.getElementById('show-setting').click();
                                    }
                                </script>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-form-label">Confirm Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="confPass" class="form-control" value="{{ old('password') }}">
                                </div>
                                @error('confPass')
                                <div class="invalidate">{{ $message }}</div>
                                <script>
                                    window.onload = function() {
                                        document.getElementById('show-setting').click();
                                    }
                                </script>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-9 col-form-label"></label>
                                <div class="col-sm-3">
                                    <button type="submit" class="col-sm-12 btn btn-outline-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
