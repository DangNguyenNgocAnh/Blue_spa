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
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('apointments.index')}}">Apointment</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form method="post" action="{{route('apointments.store')}}">
        @csrf
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter d-flex">
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{route('apointments.index')}}" class="btn btn-secondary user_form-btn">Back</a>
                        </div>
                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary user_form-btn">Create</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Apointment <span> | {{$tittle}}</span></h5>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{$code}}" readonly name="code">
                                @error('code')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="customer_id">
                                    <option value="" selected>Choose Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" @if(old('customer_id')==$customer->id)
                                        selected @endif > {{$customer->code}} {{$customer->fullname}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Staff</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="employee_id">
                                    <option value="" selected>Choose Staff</option>
                                    @foreach($staffs as $staff)
                                    <option value="{{$staff->id}}" @if(old('employee_id')==$staff->id)
                                        selected @endif >{{$staff->code}} {{$staff->fullname}}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="appointment_time" value="{{ old('appointment_time') }}">
                                @error('appointment_time')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status">
                                    <option value="" selected>Choose Status</option>
                                    <option value="Completed" @if(old('status')=='Completed' ) selected @endif>Completed
                                    </option>
                                    <option value="Confirmed" @if(old('status')=='Confirmed' ) selected @endif>Confirmed
                                    </option>
                                    <option value="Cancelled" @if(old('status')=='Cancelled' ) selected @endif>Cancelled
                                    </option>
                                    <option value="Missed" @if(old('status')=='Missed' ) selected @endif>Missed
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control h-100px" name="description">{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</main><!-- End #main -->
@endsection
