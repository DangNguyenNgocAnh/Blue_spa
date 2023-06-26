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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">Coupon</a></li>
                        <li class="breadcrumb-item active">{{$tittle}}</li>
                    </ol>
                </nav>
            </div>
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
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div class="col-xl-6">
                                    <h5 class="card-title">{{$user->fullname}}<span> | {{$tittle}}
                                        </span>
                                    </h5>
                                </div>
                                <div class="input-group d-flex justify-content-end">
                                    <a class="btn btn-secondary" style="width:40px; height:40px" href="">+</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Time Expired</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($coupons as $key => $coupon)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td> {{$coupon->name}} </td>
                                            <td> {{$coupon->price}} </td>
                                            <td> {{date('d/m/Y', strtotime($coupon->pivot->timeExpiredAt))}}
                                            </td>
                                            <td> @if($coupon->pivot->status)
                                                <span class="badge rounded-pill bg-success">true</span>
                                                @else
                                                <span class="badge rounded-pill bg-warning">true</span>
                                                @endif
                                            </td>

                                            <td style="width: 62px;">

                                                <a class="btn btn-outline-success user_list_btn" href="">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        </tr>

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
                                {{ $coupons->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
</main>
@endsection
