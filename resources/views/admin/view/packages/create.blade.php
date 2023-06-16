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
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('packages.index')}}">Package</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form method="post" action="{{route('packages.store')}}">
        @csrf
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter d-flex">
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{route('packages.index')}}" class="btn btn-secondary user_form-btn">Back</a>
                        </div>
                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary user_form-btn">Create</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Package <span> | {{$tittle}}</span></h5>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{$code}}" name="code" readonly>
                                @error('code')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="Ex: Nguyễn Văn A" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id">
                                    <option value="" selected>Choose category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(old('category_id')==$category->id)
                                        selected @endif >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Types</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="types">
                                    <option value="" selected>Choose Level</option>
                                    <option value="Basic" @if(old('types')=='Basic' ) selected @endif>Basic
                                    </option>
                                    <option value="Standard" @if(old('types')=='Standard' ) selected @endif>Standard
                                    </option>
                                    <option value="Premium" @if(old('types')=='Premium' ) selected @endif>Premium
                                    </option>
                                    <option value="Trial" @if(old('types')=='Trial' ) selected @endif>Trial
                                    </option>
                                    <option value="Special" @if(old('types')=='Special' ) selected @endif>Special
                                    </option>
                                </select>
                                @error('types')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Ex: 1000" value="{{old('price')}}" name="price">
                                @error('price')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="status">
                                    <option value="" selected>Choose Status</option>
                                    <option value="Coming" @if(old('status')=='Coming' ) selected @endif>Coming
                                    </option>
                                    <option value="Active" @if(old('status')=='Active' ) selected @endif>Active
                                    </option>
                                    <option value="Closed" @if(old('status')=='Closed' ) selected @endif>Closed
                                    </option>
                                    <option value="Pending" @if(old('status')=='Pending' ) selected @endif>Pending
                                    </option>

                                </select>
                                @error('status')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control h-100px" name="description">{{ old('description') }}</textarea>
                                @error('description')
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
