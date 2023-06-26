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
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Customer</a></li>
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
                        <h2>{{ $user->fullname }} </h2>
                        <div class="mb-2">
                            <span class="badge rounded-pill bg-warning text-dark">{{$user->department->name}}</span>
                            <span class="badge rounded-pill bg-success">{{$user->level}}</span>
                            <button type="button" class="btn btn-light mb-2" data-bs-toggle="modal" data-bs-target="#resetModal{{ $user->id }}">
                                <i class="bi bi-repeat">
                                </i>
                            </button>
                        </div>
                        <button type="button" class="btn btn-light mb-2" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                            List apointments <span class="badge bg-secondary text-light">{{$user->apointments->count()}}</span>
                        </button>
                        <button type="button" class="btn btn-light mb-2" data-bs-toggle="modal" data-bs-target="#modalListCoupon">
                            List coupons <span class="badge bg-secondary text-light">{{$user->coupons->count()}}</span>
                        </button>
                        <!-- Modal list coupons -->
                        <div class="modal fade" id="modalListCoupon">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style='font-weight: bold;'>List coupons </h5>
                                        <a type="button" class="btn btn-light" href="{{route('users.addApointment',$user->id)}}"><i class=" ri-add-fill"></i></a>
                                        @if($user->apointments->count()>0)
                                        <a type="button" class="btn btn-light" href="{{route('users.showCoupons',$user->id)}}"><i class="ri-file-list-3-line"></i></a>
                                        @endif
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body" style="max-height: 90vh;overflow: auto;">
                                            @if($user->coupons->count()>0)
                                            <div class="table1">
                                                <div class="table1-row table1-header">
                                                    <div class="table1-cell">#</div>
                                                    <div class="table1-cell">Name</div>
                                                    <div class="table1-cell">Price</div>
                                                    <div class="table1-cell">Time Expired</div>
                                                    <div class="table1-cell">Status</div>
                                                </div>
                                                @foreach ($user->coupons as $key => $coupon)
                                                <div class="table1-row">
                                                    <div class="table1-cell">{{++$key}}</div>
                                                    <div class="table1-cell">{{$coupon->name}}</div>
                                                    <div class="table1-cell">{{$coupon->price}}</div>
                                                    <div class="table1-cell">
                                                        {{date('d/m/Y', strtotime($coupon->pivot->timeExpiredAt))}}
                                                    </div>
                                                    <div class="table1-cell">
                                                        @if($coupon->pivot->status)
                                                        <span class="badge rounded-pill bg-success">true</span>
                                                        @else
                                                        <span class="badge rounded-pill bg-warning">true</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="table1-row">
                                                <div class="table1-row">Don't have any apointment registed.
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal list apointment -->
                        <div class="modal fade" id="modalDialogScrollable">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style='font-weight: bold;'>List apointments registed
                                            <a type="button" class="btn btn-light" href="{{route('users.addApointment',$user->id)}}"><i class=" ri-add-fill"></i></a>
                                            @if($user->apointments->count()>0)
                                            <a type="button" class="btn btn-light" href="{{route('users.showApointment',$user->id)}}"><i class="ri-file-list-3-line"></i></a>
                                            @endif
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body" style="max-height: 90vh;overflow: auto;">
                                            @if($user->apointments->count()>0)
                                            <div class="table1">
                                                <div class="table1-row table1-header">
                                                    <div class="table1-cell">#</div>
                                                    <div class="table1-cell">Code</div>
                                                    <div class="table1-cell">Time</div>
                                                    <div class="table1-cell">Status</div>
                                                </div>
                                                @foreach ($user->apointments as $key => $apointment)
                                                <div class="table1-row">
                                                    <div class="table1-cell">{{++$key}}</div>
                                                    <div class="table1-cell">{{$apointment->code}}</div>
                                                    <div class="table1-cell">{{$apointment->time}}</div>
                                                    <div class="table1-cell">{{$apointment->status}}</div>

                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="table1-row">
                                                <div class="table1-row">Don't have any apointment registed.
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal reset password -->
                        <form action="{{route('users.resetPassword',$user->id)}}" method="post">
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
                    </div>
                </div>
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('users.formAddPackage',$user->id)}}" class="btn btn-primary">+</a>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="user_detail-tittle">Customer's Package</h5>
                                @forelse($packages as $key=>$package)
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 label ">{{++$key}}</div>
                                    <div class="col-lg-9 col-md-8"><a href="{{route('packages.show',$package->id)}}">{{ $package->name}}</a></div>
                                </div>
                                @empty
                                <div class="row">
                                    <div class="col-lg-9 col-md-8">No package registration
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="detail_update-btn">
                        @if($user->id != Auth::id())
                        <a type="button" href="{{route('users.edit',$user->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                        <button type="button" class="btn btn-danger user_list_btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        @endif
                        <a type="button" href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
                        <!-- Modal delete -->
                        <form action="{{route('users.destroy',$user->id)}}" method="post">
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
                                <h5 class="user_detail-tittle">Customer's Information</h5>
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
                                    <div class="col-lg-3 col-md-4 label">Note</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{ $user->note }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection
