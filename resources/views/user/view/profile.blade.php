@extends('user.layout.master')
@section('tittle')
{{ $tittle }}
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
    <div class="row justify-content-center" style=" padding-top: 10px;">
        <div class="col-md-9 d-flex flex-column">
            <div class="pagetitle">
                <h1>{{$tittle}}</h1>
            </div>
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <h2>{{ $user->fullname }}</h2>
                                <div class="mb-2">
                                    <span class="badge rounded-pill bg-success">{{$user->level}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="detail_update-btn">
                                <a id="show-edit" type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#modalUpdateInformation">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a type="button" href="{{route('user.dashboard')}}" class="btn btn-secondary">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="user_detail-tittle">My Information</h5>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">Code</div>
                                            <div class="col-8 col-md-8">{{ $user->code }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label ">Fullname</div>
                                            <div class="col-8 col-md-8">{{ $user->fullname }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">Email</div>
                                            <div class="col-8 col-md-8">{{ $user->email }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">Department</div>
                                            <div class="col-8 col-md-8">
                                                {{ empty($user->department_id)? 'NULL': $user->department->name }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">Birthday</div>
                                            <div class="col-8 col-md-8">
                                                {{ date_format(date_create($user->day_of_birth), 'd-m-Y') }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">Phone number</div>
                                            <div class="col-8 col-md-8">{{ $user->phone_number }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">Address</div>
                                            <div class="col-8 col-md-8">{{ $user->address }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4 label">My packages</div>
                                            <div class="col-8 col-md-8 text_justify"><a id="show-packages" type="button"
                                                    class="btn btn-outline-info" data-bs-toggle="modal"
                                                    data-bs-target="#modalListPackage">
                                                    <i class=" ri-eye-line"></i>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Modal update user -->
        <div class="modal fade" id="modalUpdateInformation" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style='font-weight: bold;'>Edit information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="tab-content">
                                <form method="POST" action="{{route('user.updateProfile')}}">
                                    @csrf
                                    @METHOD('PATCH')
                                    <section class="section dashboard">
                                        <div class="col-xxl-4 col-md-12">
                                            <div class="card info-card">
                                                <div class="card-body">
                                                    <div class="row mb-3">
                                                        <label for="inputText"
                                                            class="col-sm-4 col-form-label">Code</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="code"
                                                                value="{{old('code')?old('code'):$user->code }}"
                                                                readonly>
                                                            @error('code')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <input type="hidden" name="id" value="{{$user->id}}">
                                                        <label for="inputEmail"
                                                            class="col-sm-4 col-form-label">Email</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="email"
                                                                placeholder="Ex: Example@gmail.com"
                                                                value="{{old('email')?old('email'):$user->email }}">
                                                            @error('email')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="inputText"
                                                            class="col-sm-4 col-form-label">Fullname</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="fullname"
                                                                placeholder="Ex: Nguyễn Văn A"
                                                                value="{{old('fullname')?old('fullname'):$user->fullname }}">
                                                            @error('fullname')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText"
                                                            class="col-sm-4 col-form-label">Level</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="level"
                                                                value="{{old('level')?old('level'):$user->level }}"
                                                                readonly>
                                                            @error('level')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-4 col-form-label">Phone
                                                            number</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="phone_number"
                                                                placeholder="Ex: 123456789"
                                                                value="{{old('phone_number')?old('phone_number'):$user->phone_number }}">
                                                            @error('phone_number')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText"
                                                            class="col-sm-4 col-form-label">Address</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="address"
                                                                value="{{old('address')?old('address'):$user->address }}">
                                                            @error('address')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-4 col-form-label">Day of
                                                            birth</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" name="day_of_birth"
                                                                value="{{date('Y-m-d', strtotime(str_replace('/', '-', $user->day_of_birth)))}}">
                                                            @error('day_of_birth')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="inputText"
                                                            class="col-sm-4 col-form-label">Note</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="note"
                                                                value="{{old('note')?old('note'):$user->note }}">
                                                            @error('note')
                                                            <div class="invalidate">{{ $message }}</div>
                                                            <script>
                                                            window.onload = function() {
                                                                document.getElementById('show-edit').click();
                                                            }
                                                            </script>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal list package -->
        <div class="modal fade" id="modalListPackage" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            List packages
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(Auth::user()->packages->count()>0)
                        <div class="table1">
                            <div class="table1-row table1-header">
                                <div class="table1-cell">STT</div>
                                <div class="table1-cell">Code</div>
                                <div class="table1-cell">Name</div>
                            </div>
                            @foreach (Auth::user()->packages as $key => $package)
                            <div class="table1-row">
                                <div class="table1-cell">{{++$key}}</div>
                                <div class="table1-cell">{{$package->code}}</div>
                                <div class="table1-cell">{{$package->name}}</div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="table1-row">
                            <i class="ri-shopping-cart-2-line" style="font-size: 40px; color:#012970"></i>
                            <div class="table1-row">Bạn chưa đăng ký package nào! </div>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
