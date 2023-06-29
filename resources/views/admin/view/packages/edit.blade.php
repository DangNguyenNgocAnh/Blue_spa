@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{$tittle}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Package</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
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
    <form method="post" action="{{route('packages.update',$package->id)}}">
        @csrf
        @method('PATCH')
        <section class="section dashboard">
            <div class="col-xxl-4 col-md-12">
                <div class="card info-card">
                    <div class="filter d-flex">
                        <div class="d-flex justify-content-end me-3">
                            <a href="{{route('packages.index')}}" class="btn btn-secondary user_form-btn">Back</a>
                        </div>
                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary user_form-btn">Update</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Package <span> | {{$tittle}}</span></h5>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name')?old('name'):$package->name }}">
                                @error('name')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{ $package->code }}" name="code">
                                @error('code')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">

                                <select class="form-select" name="category_id">
                                    <option value="" selected>Choose category</option>
                                    @if(isset($categories))
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if (!old('category_id') &&( $package->
                                        category_id==$category->id))
                                        selected
                                        @elseif (old('category_id')==$category->id ) selected @endif
                                        >{{$category->name}}</option>
                                    @endforeach
                                    @else
                                    <option value="{{$category->id}}" @if($package->
                                        category_id==$category->id)
                                        selected @endif >{{$category->name}}</option>
                                    @endif
                                </select>
                            </div>
                            @error('category_id')
                            <div class="invalidate">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{ str_replace(',', '', $package->price)}}" name="price">
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
                                    <option value="Coming" @if (!old('status') &&( $package->status == 'Coming'))
                                        selected
                                        @elseif (old('status')=='Coming' ) selected @endif>Coming
                                    </option>
                                    <option value="Closed" @if (!old('status') &&( $package->status == 'Closed'))
                                        selected
                                        @elseif (old('status')=='Closed' ) selected @endif>Closed
                                    </option>
                                    <option value="Pending" @if (!old('status') &&( $package->status == 'Pending'))
                                        selected
                                        @elseif (old('status')=='Pending' ) selected @endif>Pending
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
                                <textarea class="form-control h-100px" name="description">{{old('description')?old('description'):$package->description }}</textarea>
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
