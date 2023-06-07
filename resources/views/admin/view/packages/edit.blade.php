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
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Package</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
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
                                <input type="number" class="form-control" value="{{ $package->code }}" name="code" readonly>
                                @error('code')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{ old('price')?old('price'):$package->price }}" name="price">
                                @error('price')
                                <div class="invalidate">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Types</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="types">
                                    <option value="" selected>Choose Level</option>
                                    <option value="Basic" @if (!old('types') &&( $package->types == 'Basic')) selected
                                        @elseif (old('types')=='Basic' ) selected @endif>Basic
                                    </option>
                                    <option value="Standard" @if (!old('types') &&( $package->types == 'Standard'))
                                        selected
                                        @elseif (old('types')=='Standard' ) selected @endif>Standard
                                    </option>
                                    <option value="Premium" @if (!old('types') &&( $package->types == 'Premium'))
                                        selected
                                        @elseif (old('types')=='Premium' ) selected @endif>Premium
                                    </option>
                                    <option value="Trial" @if (!old('types') &&( $package->types == 'Trial')) selected
                                        @elseif (old('types')=='Trial' ) selected @endif>Trial
                                    </option>
                                    <option value="Special" @if (!old('types') &&( $package->types == 'Special'))
                                        selected
                                        @elseif (old('types')=='Special' ) selected @endif>Special
                                    </option>
                                </select>
                                @error('types')
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
                            <label for="inputText" class="col-sm-2 col-form-label">Appicable level</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="level_applied">
                                    <option value="" selected>Choose Level</option>
                                    <option value="Level 1" @if (!old('level_applied') &&( $package->level_applied
                                        == 'level 1'))
                                        selected
                                        @elseif (old('level_applied')=='Level 1' ) selected @endif>
                                        Level 1
                                    </option>
                                    <option value="Level 2" @if (!old('level_applied') &&( $package->level_applied
                                        == 'level 2'))
                                        selected
                                        @elseif (old('level_applied')=='Level 2' ) selected @endif>
                                        Level 2
                                    </option>
                                    <option value="Level 3" @if (!old('level_applied') &&( $package->level_applied
                                        == 'level 3'))
                                        selected
                                        @elseif (old('level_applied')=='Level 3' ) selected @endif>
                                        Level 3
                                    </option>
                                    <option value="Level 4" @if (!old('level_applied') &&( $package->level_applied
                                        == 'level 4'))
                                        selected
                                        @elseif (old('level_applied')=='Level 4' ) selected @endif>
                                        Level 4
                                    </option>
                                    <option value="Level 5" @if (!old('level_applied') &&( $package->level_applied
                                        == 'level 5'))
                                        selected
                                        @elseif (old('level_applied')=='Level 5' ) selected @endif>
                                        Level 5
                                    </option>
                                </select>
                                @error('level_applied')
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
