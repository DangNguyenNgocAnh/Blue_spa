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
    @elseif (session('warning'))
    <div class="alert alert-warning">
        {{ session('failed') }}
    </div>
    @endif
    <div class="pagetitle">
        <h1>{{$tittle}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{$route_index}}">{{$title_index}}</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form method="post" action="{{$route_update}}">
        @csrf
        @METHOD('PATCH')
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter d-flex">
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{$route_index}}" class="btn btn-secondary user_form-btn">Back</a>
                        </div>
                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary user_form-btn">Update</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">User <span>|{{$tittle}}</span></h5>
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" placeholder="Ex: Example@gmail.com" value="{{old('email')?old('email'):$user->email }}">
                                @error('email')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="fullname" placeholder="Ex: Nguyễn Văn A" value="{{old('fullname')?old('fullname'):$user->fullname }}">
                                @error('fullname')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone_number" placeholder="Ex: 123456789" value="{{old('phone_number')?old('phone_number'):$user->phone_number }}">
                                @error('phone_number')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="{{old('address')?old('address'):$user->address }}">
                                @error('address')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 row">
                                <div class="col-sm-6">
                                    <label for="inputNumber" class="col-form-label">Code</label>
                                    <div class="">
                                        <input type="number" class="form-control" readonly value="{{old('code')?old('code'):$user->code }}" name="code">
                                        @error('code')
                                        <div class="invalidate">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Day of birth</label>
                                    <input type="date" class="form-control" name="day_of_birth" value="{{date('Y-m-d', strtotime(str_replace('/', '-', $user->day_of_birth)))}}">
                                    @error('day_of_birth')
                                    <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 row">
                                <div class="col-sm-6">
                                    <label class="col-form-label">Level</label>
                                    <select class="form-select" name="level">
                                        <option value="" selected>Choose Level</option>
                                        <option value="Level 1" @if (!old('level') &&( $user->
                                            level
                                            == 'Level 1'))
                                            selected
                                            @elseif (old('level')=='Level 1' ) selected @endif>
                                            Level 1
                                        </option>
                                        <option value="Level 2" @if (!old('level') &&( $user->
                                            level
                                            == 'Level 2'))
                                            selected
                                            @elseif (old('level')=='Level 2' ) selected @endif>
                                            Level 2
                                        </option>
                                        <option value="Level 3" @if (!old('level') &&( $user->
                                            level
                                            == 'Level 3'))
                                            selected
                                            @elseif (old('level')=='Level 3' ) selected @endif>
                                            Level 3
                                        </option>
                                        <option value="Level 4" @if (!old('level') &&( $user->
                                            level
                                            == 'Level 4'))
                                            selected
                                            @elseif (old('level')=='Level 4' ) selected @endif>
                                            Level 4
                                        </option>
                                        <option value="Level 5" @if (!old('level') &&( $user->
                                            level
                                            == 'Level 5'))
                                            selected
                                            @elseif (old('level')=='Level 5' ) selected @endif>
                                            Level 5
                                        </option>
                                    </select>
                                    @error('level')
                                    <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Role</label>
                                    <select class="form-select" name="department_id">
                                        <option value="" selected>Choose department</option>
                                        @if(isset($departments))
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}" @if (!old('department_id') &&( $user->
                                            department_id==$department->id))
                                            selected
                                            @elseif (old('department_id')==$department->id ) selected @endif
                                            >{{$department->name}}</option>
                                        @endforeach
                                        @else
                                        <option value="{{$department->id}}" @if($user->
                                            department_id==$department->id)
                                            selected @endif >{{$department->name}}</option>
                                        @endif
                                    </select>
                                    @error('department_id')
                                    <div class="invalidate">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <textarea class="form-control h-100px" name="note">{{old('note')?old('note'):$user->note }}</textarea>
                                @error('note')
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
