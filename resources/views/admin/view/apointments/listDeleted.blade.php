@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <div class="row">
            <div class="col-xl-6">
                <h1>{{$tittle}}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{$route_index}}">{{$item}}</a></li>
                        <li class="breadcrumb-item active">{{$tittle}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-6">

                <div class="input-group justify-content-end">
                    <form class="search-form d-flex align-items-center" method="get" action="{{$route_search}}">
                        <div class="row mb-3">
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item" id="code" value="code" checked>
                                    <label class="form-check-label" for="code">Code</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item" id="email" value="email">
                                    <label class="form-check-label" for="email">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item" id="fullname" value="fullname">
                                    <label class="form-check-label" for="fullname">Fullname</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="item" id="roles" value="roles">
                                    <label class="form-check-label" for="roles">Roles</label>
                                </div>
                            </div>
                            <div class="form-outline btn-group">
                                <input name="input" type="search" class="form-control" required />
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Page Title -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{session('success')}}
            {{session()->forget('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            {{session('warning')}}
            {{session()->forget('warning')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div class="col-xl-6">
                                    <h5 class="card-title">Admin Pages <span> | {{$tittle}}
                                        </span>
                                    </h5>
                                    @if(isset($tittle2))
                                    {{$tittle2}} </br>
                                    @endif
                                </div>
                                <div class="input-group d-flex justify-content-end">
                                    <div style=" display: flex; ">
                                        <a class="btn btn-secondary" style="width:70px; height:40px" href="{{$route_index}}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Customer's name</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Deleted at</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($apointments as $key => $apointment)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $apointment->code }}</td>
                                    <td>{{ $apointment->customer->fullname }}</td>
                                    <td>{{ $apointment->time }}</td>
                                    <td>{{ $apointment->status }}</td>
                                    <td>{{ $apointment->deleted_at }}</td>
                                    <td style="width: 40px;">
                                        <button type="button" class="btn btn-outline-danger user_list_btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $apointment->id }}">
                                            <i class="bi bi-box-arrow-left"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <form action="{{route($name_route_restore,$apointment->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="exampleModal{{ $apointment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Confirm Restore
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to restore the person with the code number
                                                    of
                                                    <b>{{ $apointment->code }}</b>
                                                    and full name is
                                                    <b>{{ $apointment->fullname }}</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary w-100px">Restore</button>
                                                    <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @empty
                                <tr></tr>
                                <tr>
                                    <td class="row">No relevant data available for the conditions</td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        {{ $apointments->links() }}
                    </div>
                </div>
            </div>
    </div>
    </section>
</main>
@endsection
