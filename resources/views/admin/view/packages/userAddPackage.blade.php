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
                <li class="breadcrumb-item"><a href="\dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('packages.index')}}">Customer</a></li>
                <li class="breadcrumb-item active">{{$tittle}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h6 class="card-title">{{$user->fullname}} <span> | Eligible packages to add
                                </h6>
                                {{isset($condition)?$condition: 'All packages'}}
                                <form action="{{route('users.addPackage.search',$user->id)}}" method="get">
                                    <div class="d-flex justify-content-end">
                                        <div class="col-sm-1">
                                            <input class="form-check-input" type="radio" name="item" id="code" value="code" checked>
                                            <label class="form-check-label" for="code">Code</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <input class="form-check-input" type="radio" name="item" id="name" value="name" checked>
                                            <label class="form-check-label" for="name">Name</label>
                                        </div>
                                        <div class="col-sm-1">
                                            <input class="form-check-input" type="radio" name="item" id="types" value="types">
                                            <label class="form-check-label" for="types">Type</label>
                                        </div>
                                        <div class="search-form">
                                            <input type="text" name="key" required>
                                            <button type="submit" title="Search" class="btn btn-outline-info" style="width:40px; height:35px"><i class="bi bi-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="{{route('users.addUser',$user->id)}}" class="row g-3" style="padding:20px;">
                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($packageAdds as $package)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="package_id[]" value="{{ $package->id }}">
                                                    </div>
                                                </th>
                                                <td> {{ $package->code }} </td>
                                                <td> {{ $package->name }} </td>
                                                <td>{{ $package->types }} </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th scope="row">No package complies with the condition</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $packageAdds->links() }}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="detail_update-btn">
                        <a type="button" href="{{route('packages.show',$package->id)}}" class="btn btn-secondary">Back</a>
                    </div>
                    <div class="card_body">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="user_detail-tittle">List packages</h5>
                                    @forelse($packagesOfUser as $package)
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <p>{{$package->code}} : <a class=" text-primary" href="{{route('users.show',$user->id)}}">
                                                    {{$package->name}}</a></p>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                        <div class="col label ">Don't have any member.
                                        </div>
                                    </div>
                                    @endforelse
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
