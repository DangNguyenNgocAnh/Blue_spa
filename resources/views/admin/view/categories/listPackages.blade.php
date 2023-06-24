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
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
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
                            <div class="col-xl-6">
                                <h5 class="card-title">Admin Pages <span>| {{$tittle2}}
                                    </span>
                                </h5>
                            </div>
                            <div class="col-xl-6">
                                <div class="input-group justify-content-end">
                                    <a class="btn btn-secondary" href="{{route('categories.index')}}">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $packages->links() }}
                        </div>
                        <div class="d-flex align-items-center">
                            <table class="table table-striped">
                                @if(count($packages)>0)
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $key => $package)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->price }} VND</td>
                                        <td>{{ $package->status }}</td>
                                        <td style="width: 176px;">
                                            <a class="btn btn-outline-info package_list_btn" href="{{route('packages.show',$package->id)}}">
                                                <i class="bi bi-person-vcard"></i>
                                            </a>
                                            <a class="btn btn-outline-success package_list_btn" href="{{route('packages.edit',$package->id)}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger package_list_btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $package->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <form action="{{route('packages.destroy',$package->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal fade" id="exampleModal{{ $package->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Confirm Delete
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the person with the code number
                                                        of
                                                        <b>{{ $package->code }}</b>
                                                        and full name is
                                                        <b>{{ $package->fullname }}</b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger w-100px">Remove</button>
                                                        <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach
                                    @else
                                    <td class="row">Dont have any package.</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</main>
@endsection
