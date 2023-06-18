@extends('user.layout.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px; background-image: none;">
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
    <div class="card-dashboard">
        <div class="card-body">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('img/spa.jpeg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <div class='form-img'>
                                <h4 style="color:black; font-weight:bold; padding-top:20px">Đặt lịch hẹn với Blue Spa
                                </h4>
                                <form method="post" action="{{route('user.createApointment')}}">
                                    @csrf
                                    <section class="section dashboard">
                                        <div class="col-xxl-4 col-md-12">
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Staff</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-select" name="employee_id">
                                                            <option value="" selected>Ngẫu nhiên</option>
                                                            @foreach($staffs as $staff)
                                                            <option value="{{$staff->id}}" @if(old('employee_id')==$staff->id)
                                                                selected @endif >
                                                                {{$staff->fullname}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('employee_id')
                                                        <div class="invalidate">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputDate" class="col-sm-2 col-form-label">Time</label>
                                                    <div class="col-sm-10 row">
                                                        <div class="col-sm-6">
                                                            <input type="date" class="form-control" name="date" value="{{ old('date')?old('date'):$minDay}}" min="{{$minDay}}" max={{$maxDay}}>
                                                            @error('date')
                                                            <div class=" invalidate">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-select" name="hour">
                                                                <option value="" selected>Hour</option>
                                                                @for($i=9; $i<=20 ; $i++) <option value="{{$i}}" @if(old('hour')==$i) selected @endif>
                                                                    {{$i}} h
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                            @error('hour')
                                                            <div class=" invalidate">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-select" name="minute">
                                                                <option value="" selected>Minute</option>
                                                                <option value="15" @if(old('minute')==15) selected @endif>15 m</option>
                                                                <option value="30" @if(old('minute')==30) selected @endif>30 m</option>
                                                                <option value="45" @if(old('minute')==45) selected @endif>45 m</option>
                                                            </select>
                                                            @error('minute')
                                                            <div class=" invalidate">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
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
                                                <div class="row mb-3">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="d-flex justify-content-end me-3">
                                                            <button type="submit" class="btn btn-primary user_form-btn">Create</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection
