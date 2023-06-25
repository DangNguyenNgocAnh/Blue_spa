@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{$tittle}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div>
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
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <div class="detail_update-btn">
                            @if($permission)
                            <button type="button" class="btn btn-danger user_list_btn" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}">
                                <i class="bi bi-repeat"></i>
                            </button>
                            <form action="{{route('staff.resetPassword',$user->id)}}" method="post">
                                @csrf
                                <div class="modal fade" id="resetModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Confirm Reset Password
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to reset password this person ? <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info w-100px">Reset</button>
                                                <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                        <h2>{{ $user->fullname }}</h2>
                        <div class="mb-2">
                            <span class="badge rounded-pill bg-warning text-dark">{{$user->department->name}}</span>
                            <span class="badge rounded-pill bg-success">{{$user->level}}</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="detail_update-btn">
                        @if($user->id != Auth::id())
                        <a type="button" href="{{route('staff.edit',$user->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <button type="button" class="btn btn-danger user_list_btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        @endif
                        <a type="button" href="{{route('staff.index')}}" class="btn btn-secondary">Back</a>

                        <form action="{{route('staff.destroy',$user->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Confirm Delete
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the person with the code number
                                            of
                                            <b>{{ $user->code }}</b>
                                            and full name is
                                            <b>{{ $user->fullname }}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger w-100px">Remove</button>
                                            <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="user_detail-tittle">Staff's Information</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Fullname</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->fullname }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Code</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->code }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Department</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->department->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Birthday</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ date_format(date_create($user->day_of_birth), 'd-m-Y') }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">NumberPhone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->phone_number }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Note</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{ $user->note }}</div>
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
