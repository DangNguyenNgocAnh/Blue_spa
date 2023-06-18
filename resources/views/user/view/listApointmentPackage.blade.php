@extends('user.layout.master')
@section('tittle')
{{ $tittle }}
@endsection
@section('content')
<main id="main" class="main" style="margin-left: 0px; min-height:95vh;">
    <div class="list-apoint-user">
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
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ Vite::asset('resources/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                            <h2>{{ $user->fullname }}</h2>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="user_detail-tittle">My Packages</h5>
                                    @forelse($packages as $key=>$package)
                                    <div class="row">
                                        <div class="col-lg-1 col-md-2 label ">{{++$key}}</div>
                                        <div class="col-lg-9 col-md-8">
                                            <p style="font-weight: bold;">{{$package->name}}
                                            <p>
                                        </div>
                                        <div class="col-lg-1 col-md-2"><a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                                                <i class="bi bi-person-vcard"></i>
                                            </a></div>
                                        <!-- Modal detail package -->
                                        <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" style='font-weight: bold;'>Detail
                                                            Package</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 label " style='font-weight: bold;'>Name
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 text_justify">
                                                                            {{$package['name']}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 label" style='font-weight: bold;'>
                                                                            Code
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 text_justify">
                                                                            {{$package['code']}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 label" style='font-weight: bold;'>
                                                                            Price
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 text_justify">
                                                                            {{($package['price'])}} đồng
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 label" style='font-weight: bold;'>
                                                                            Type
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 text_justify">
                                                                            {{$package['types']}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 label" style='font-weight: bold;'>
                                                                            Status
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-8 text_justify">
                                                                            {{$package['status']}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4 label" style='font-weight: bold;'>
                                                                            Description</div>
                                                                        <div class="col-lg-8 col-md-8 text_justify">
                                                                            {{$package['description']}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                <div class="col-xl-7">
                    <div class="card">
                        <div class="detail_update-btn">
                            <a type="button" href="{{route('user.dashboard')}}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="user_detail-tittle">My list apointments</h5>
                                    <div class="d-flex align-items-center">
                                        <table class="table table-striped">
                                            @if(count($apointments)>0)
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($apointments as $key => $apointment)
                                                <tr>
                                                    <th scope="row">{{ ++$key }}</th>
                                                    <td> {{$apointment->code}} </td>
                                                    <td> {{($apointment->time)}} </td>
                                                    <td> {{$apointment->status}} </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <td class="row">Dont have any apointment registration</td>
                                                @endif
                                            </tbody>
                                        </table>
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
