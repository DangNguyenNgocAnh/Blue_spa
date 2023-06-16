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
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('categories.edit',$category->id)}}" class="btn btn-primary"><i
                                class="bi bi-pencil-square"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <div class="row">
                                    <h5 class="text_justify" style="margin-bottom: 20px;">Detail of package</h5>
                                    <div class="col-lg-3 col-md-4 label ">Name</div>
                                    <div class="col-lg-9 col-md-8">{{$category->name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Description</div>
                                    <div class="col-lg-9 col-md-8 text_justify">{{$category->description}}</div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('categories.index')}}" class="btn btn-secondary">Back</a>
                    </div>
                    <div class="card_body">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="package_detail-tittle">List packages</h5>
                                    @forelse($packages as $key=>$package)
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <p>{{++$key}} : <a class=" text-primary"
                                                    href="{{route('packages.show',$package->id)}}">
                                                    {{$package->name}}</a></p>
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-outline-info"
                                                    href="{{route('packages.show',$package->id)}}">
                                                    <i class="bi bi-person-vcard"></i>
                                                </a>
                                                <a class="btn btn-outline-success"
                                                    href="{{route('packages.edit',$package->id)}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                        <div class="col label ">Don't have any member.
                                        </div>
                                    </div>
                                    @endforelse
                                    <div class="row">
                                        <div class=" d-flex justify-content-end">
                                            {{ $packages->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
