@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    <div class="pagetitle">
        <h1>{{$tittle}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="\dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('apointments.index')}}">Apointment</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('apointments.index')}}" class="btn btn-secondary">Back</a>
                        <a type="button" href="{{route('apointments.edit',$apointment->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="user_detail-tittle">Code : {{$apointment->code}}</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Customer's name </div>
                                    <div class="col-lg-9 col-md-8">
                                        @if(!empty($apointment->customer))
                                        <a href="{{route('users.show',$apointment->customer->id)}}">{{$apointment->customer->fullname}}</a>
                                        @else
                                        NULL
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Staff's name </div>
                                    <div class="col-lg-9 col-md-8">
                                        @if(!empty($apointment->employee))
                                        <a href="{{route('staff.show',$apointment->employee->id)}}">{{$apointment->employee->fullname}}
                                        </a>
                                        @else
                                        NULL
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 label">Time of apointment</div>
                                    <div class="col-lg-9 col-md-8">{{$apointment->time}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{$apointment->status}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Message</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{$apointment->message}}</div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
    </section>

</main><!-- End #main -->
@endsection
