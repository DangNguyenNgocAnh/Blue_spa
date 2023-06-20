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
                <li class="breadcrumb-item"><a href="{{route('packages.index')}}">Package</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div> @if (session('success'))
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
            <div class="col-xl-8">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('packages.edit',$package->id)}}" class="btn btn-primary"><i
                                class="bi bi-pencil-square"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="user_detail-tittle">{{$package->name}}</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Name</div>
                                    <div class="col-lg-9 col-md-8">{{$package->name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Code</div>
                                    <div class="col-lg-9 col-md-8">{{$package->code}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Catelogy</div>
                                    <div class="col-lg-9 col-md-8">{{$package->category->name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Price</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{($package->price)}} đồng
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Type</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{$package->types}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{$package->status}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Description</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{$package->description}}</div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('packages.index')}}" class="btn btn-secondary">Back</a>
                        <a type="button" href="{{route('packages.formAddUser',$package->id)}}"
                            class="btn btn-primary">+</a>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="user_detail-tittle">List customers</h5>
                                @forelse($users as $user)
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{$user->code}}</div>
                                    <div class="col-lg-9 col-md-8"> <a
                                            href="{{route('users.show',$user->id)}}">{{$user->fullname}}</a></div>
                                </div>
                                @empty
                                <div class="row">
                                    <div class="col-lg-9 col-md-8">Don't have any member</div>
                                </div>
                                @endforelse
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
    </section>

</main><!-- End #main -->
@endsection
