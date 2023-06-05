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
                <li class="breadcrumb-item"><a href="{{route('departments.index')}}">Department</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form method="post" action="{{route('departments.store')}}">
        @csrf
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter d-flex">
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{route('departments.index')}}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Department <span> | {{$tittle}}</span></h5>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{$code}}" name="code" readonly>
                                @error('code')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="Ex: Customer" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <textarea class="form-control h-100px" name="note">{{ old('note') }}</textarea>
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
