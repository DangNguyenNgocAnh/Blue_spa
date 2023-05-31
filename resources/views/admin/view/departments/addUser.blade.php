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
                <li class="breadcrumb-item"><a href="{{route('departments.index')}}">Department</a></li>
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
                                <h6 class="card-title">{{$department->name}} <span> | Eligible department members to add
                                </h6>
                                {{isset($condition)?$condition: 'All member'}}
                                <form action="{{route('departments.addMember.search', $department->id)}}" method="get">
                                    <div class="d-flex justify-content-end">
                                        <div class="col-sm-2">
                                            <input class="form-check-input" type="radio" name="item" id="code" value="code" checked>
                                            <label class="form-check-label" for="code">Code</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-check-input" type="radio" name="item" id="fullname" value="fullname">
                                            <label class="form-check-label" for="fullname">Name</label>
                                        </div>
                                        <div class="search-form">
                                            <input type="text" name="key" required>
                                            <button type="submit" title="Search" class="btn btn-outline-info" style="width:40px; height:35px"><i class="bi bi-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action="{{route('departments.addMember',$department->id)}}" class="row g-3" style="padding:20px;">
                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Code</th>
                                                <th scope="col">Fullname</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="user_id[]" value="{{ $user->id }}">
                                                    </div>
                                                </th>
                                                <td> {{ $user->code }} </td>
                                                <td> {{ $user->fullname }} </td>
                                                <td>{{ $user->email }} </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th scope="row">No member complies with the condition</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $users->links() }}
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
                        <a type="button" href="{{route('departments.show',$department->id)}}" class="btn btn-secondary">Back</a>
                    </div>
                    <div class="card_body">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="user_detail-tittle">List members</h5>
                                    @forelse($members as $key=>$user)
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <p>{{$user->code}} : <a class=" text-primary" href="{{route('users.show',$user->id)}}">
                                                    {{$user->fullname}}</a></p>
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
