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
                        <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">Coupon</a></li>
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
                            <div class="d-flex justify-content-between">
                                <div class="col-xl-6">
                                    <h5 class="card-title">Admin Pages <span> | {{$tittle}}
                                        </span>
                                    </h5>
                                </div>
                                <div class="input-group d-flex justify-content-end">
                                    <div style=" display: flex; ">
                                        <a class="btn btn-info" style="width:40px;height:40px;margin-right: 10px;"
                                            href="{{route('coupons.listDeleted')}}"><i class="bi bi-trash3"></i></a>
                                        <a class="btn btn-secondary" style="width:40px; height:40px"
                                            data-bs-toggle="modal" data-bs-target="#createModal" id="create">+</a>
                                    </div>
                                    <!-- Modalcreate-->
                                    <form action="{{route('coupons.store')}}" method="post">
                                        @method('POST')
                                        @csrf
                                        <div class="modal fade" id="createModal" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Create new coupon
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="tab-content">
                                                                @csrf
                                                                <div class="row">
                                                                    <label class="col-sm-2">Name
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            name="name" value="{{old('name')}}">
                                                                        @error('name')
                                                                        <div class=" invalidate">{{ $message }}
                                                                        </div>
                                                                        <script>
                                                                        window.onload = function() {
                                                                            document.getElementById('create')
                                                                                .click();
                                                                        }
                                                                        </script>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2">Price
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            name="price" value="{{old('price')}}">
                                                                        @error('price')
                                                                        <div class="invalidate">{{ $message }}</div>
                                                                        <script>
                                                                        window.onload = function() {
                                                                            document.getElementById('create')
                                                                                .click();
                                                                        }
                                                                        </script>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary w-100px">Create</button>
                                                            <button type="button" class="btn btn-secondary w-100px"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($coupons as $key => $coupon)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td> {{$coupon->name}} </td>
                                        <td> {{($coupon->price)}} VND </td>

                                        <td style="width: 176px;">
                                            <a class="btn btn-outline-info user_list_btn" data-bs-toggle="modal"
                                                data-bs-target="#modalDialogScrollable{{ $coupon->id }}">
                                                <i class="bi bi-person-vcard"></i>
                                            </a>

                                            <a class="btn btn-outline-success user_list_btn" id="edit"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{$coupon->id}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger user_list_btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $coupon->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modaldelete-->
                                    <form action="{{route('coupons.destroy',$coupon->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal fade" id="deleteModal{{ $coupon->id }}"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Confirm Delete
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the coupon
                                                        <b>{{$coupon->name}} ?</b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn btn-danger w-100px">Remove</button>
                                                        <button type="button" class="btn btn-secondary w-100px"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Modaldetail -->
                                    <div class="modal fade" id="modalDialogScrollable{{ $coupon->id }}">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" style='font-weight: bold;'>Detail
                                                        Coupon</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body" style="max-height: 90vh;overflow: auto;">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active profile-overview"
                                                                id="profile-overview">
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-4 label "
                                                                        style='font-weight: bold;'>Name
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8 text_justify">
                                                                        {{$coupon->name}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-4 label"
                                                                        style='font-weight: bold;'>
                                                                        Price
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8 text_justify">
                                                                        {{$coupon->price}} VND
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modaledit-->
                                    <form action="{{route('coupons.update',$coupon->id)}}" method="post">
                                        @method('PATCH')
                                        @csrf
                                        <div class="modal fade" id="editModal{{$coupon->id}}"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Edit coupon
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="tab-content">
                                                                @csrf
                                                                <div class="row">
                                                                    <input type="hidden" name="id"
                                                                        value="{{$coupon->id}}">
                                                                    <label class="col-sm-2">Name
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control"
                                                                            name="name"
                                                                            value="{{old('name')??$coupon->name}}">
                                                                        @error('name')
                                                                        <div class=" invalidate">{{ $message }}
                                                                        </div>
                                                                        <script>
                                                                        window.onload = function() {
                                                                            document.getElementById('edit')
                                                                                .click();
                                                                        }
                                                                        </script>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2">Price
                                                                    </label>
                                                                    <div class="col-sm-9">
                                                                        <input type="number" class="form-control"
                                                                            step="1000" name="price"
                                                                            value="{{old('price')??str_replace(',', '', $coupon->price)}}">
                                                                        @error('price')
                                                                        <div class="invalidate">{{ $message }}</div>
                                                                        <script>
                                                                        window.onload = function() {
                                                                            document.getElementById('edit')
                                                                                .click();
                                                                        }
                                                                        </script>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary w-100px">Update</button>
                                                            <button type="button" class="btn btn-secondary w-100px"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                    @empty
                                    <tr></tr>
                                    <tr>
                                        <td class="row">No relevant data available for the conditions</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $coupons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
</main>
@endsection
