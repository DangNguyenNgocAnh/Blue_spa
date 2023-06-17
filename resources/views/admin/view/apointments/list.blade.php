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
                        <li class="breadcrumb-item"><a href="{{route('apointments.index')}}">Apointment</a></li>
                        <li class="breadcrumb-item active">{{$tittle}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-6">
                <form action="{{route('apointments.search')}}" method="get">
                    <div class="d-flex justify-content-end">
                        <div class="col-sm-2">
                            <input class="form-check-input" type="radio" name="item" id="code" value="code" checked>
                            <label class="form-check-label" for="code">Code</label>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-check-input" type="radio" name="item" id="customer_name" value="customer_name">
                            <label class="form-check-label" for="customer_name">Customer</label>
                        </div>
                        <div class="search-form">
                            <input type="text" name="key" required>
                            <button type="submit" title="Search" class="btn btn-outline-info" style="width:40px; height:35px"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </form>
                <form action="{{route('apointments.sort')}}" method="get">
                    <div class="d-flex justify-content-end">
                        <div class="col-sm-3 ">
                            <select class="form-select" name="item">
                                <option value="code" selected>Item</option>
                                <option value="code" @if(isset($item) && $item=='code' ) selected @endif>Code
                                </option>
                                <option value="time" @if(isset($item) &&$item=='time' ) selected @endif> Time
                                </option>
                                <option value="Status" @if(isset($item) &&$item=='Status' ) selected @endif>
                                    Status </option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-select" name="mode">
                                <option value="asc" selected>Mode</option>
                                <option value="asc" @if(isset($mode) && $mode=='asc' ) selected @endif> ASC
                                </option>
                                <option value="desc" @if(isset($mode) && $mode=='desc' ) selected @endif>DES
                                </option>
                            </select>
                            @error('roles')
                            <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-secondary" style="width:60px; height:40px">Sort</button>
                    </div>
                </form>
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
                                    <h5 class="card-title">Admin Pages <span> | {{$tittle}}
                                        </span>
                                    </h5>
                                </div>
                                <div class="input-group d-flex justify-content-end">
                                    <div style=" display: flex; ">
                                        <a class="btn btn-info" style="width:40px;height:40px;margin-right: 10px;" href="{{route('apointments.deleted')}}"><i class="bi bi-trash3"></i></a>
                                        <a class="btn btn-secondary" style="width:40px; height:40px" href="{{route('apointments.create')}}">+</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Customer's Name</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($apointments as $key => $apointment)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td> {{$apointment->code}} </td>
                                            <td> @if(!empty($apointment->customer))
                                                <a href="{{route('users.show',$apointment->customer->id)}}">{{$apointment->customer->fullname}}</a>
                                                @else
                                                NULL
                                                @endif
                                            </td>
                                            <td> {{($apointment->time)}} </td>
                                            <td> {{$apointment->status}} </td>

                                            <td style="width: 176px;">
                                                <a class="btn btn-outline-info user_list_btn" href="{{route('apointments.show',$apointment->id)}}">
                                                    <i class="bi bi-person-vcard"></i>
                                                </a>
                                                <a class="btn btn-outline-success user_list_btn" href="{{route('apointments.edit',$apointment->id)}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger user_list_btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $apointment->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <form action="{{route('apointments.destroy',$apointment->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal fade" id="exampleModal{{ $apointment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Confirm Delete
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete the apointment of
                                                            <b> </b> with the code
                                                            number
                                                            is
                                                            <b>{{$apointment->code}} ?</b>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger w-100px">Remove</button>
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
