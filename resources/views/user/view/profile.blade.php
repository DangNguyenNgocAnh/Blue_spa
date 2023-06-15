@extends('user.layout.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
@section('content')
<main id="main" class="main" style="margin-left: 0px; height:95vh">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @elseif (session('warning'))
    <div class="alert alert-warning">
        {{ session('failed') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9 d-flex flex-column">
            <div class="pagetitle">
                <h1>{{$tittle}}</h1>
            </div>
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <div class="mb-2">
                                    <span class="badge rounded-pill bg-warning text-dark">{{ $user->levels }}</span>
                                    <span class="badge rounded-pill bg-primary">{{ $user->roles }}</span>
                                </div>
                                <img src="{{ Vite::asset('resources/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                                <h2>{{ $user->fullname }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="detail_update-btn">
                                <a type="button" href="" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a type="button" href="" class="btn btn-secondary">Back</a>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="user_detail-tittle">My Information</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Code</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->code }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Fullname</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->fullname }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Department</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ empty($user->department_id)? 'NULL': $user->department->name }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Birthday</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ date_format(date_create($user->day_of_birth), 'd-m-Y') }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone number</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->phone_number }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">My packages</div>
                                            <div class="col-lg-9 col-md-8 text_justify"><a href="">Go to</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</main>
@endsection
@endsection
