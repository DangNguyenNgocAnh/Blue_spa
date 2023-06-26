@extends('user.layout.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px; background-image: none;">
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
    <div class="content">
        <div class="design-title">
            <h2>{{$category->name}}</h2>
            <a type="button" class="btn btn-secondary" href="{{route('user.dashboard')}}">Back</a>
        </div>
        <p> Danh sách các gói dịch vụ trong nhóm này: </p>
        <p>(gồm có {{$count}} packages)</p>
        <div class="content-options-static ">
            @forelse($packages as $key=>$packages)
            <div class="content-options-static-content">
                @foreach($packages as $key=>$package)
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-4.jpeg')}}" alt="">
                    <div class="description-package">
                        <div class='description-package-form'>
                            <h4 style="color:black; font-weight:bold;">{{$package['name']}}</h4>
                            <a type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#disablebackdrop{{ $package['id'] }}">
                                <i class="ri-eye-line"></i>
                            </a>
                            <p> {{$package['description']}}</p>
                        </div>
                    </div>
                    <div class="modal fade" id="disablebackdrop{{ $package['id'] }}" tabindex="-1" data-bs-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Package</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                                <div class="row">
                                                    <div class="col-lg-4" style='font-weight: bold;'>
                                                        Name
                                                    </div>
                                                    <div class="col-lg-8  text_justify">
                                                        {{$package['name']}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 " style='font-weight: bold;'>
                                                        Code
                                                    </div>
                                                    <div class="col-lg-8  text_justify">
                                                        {{$package['code']}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 " style='font-weight: bold;'>
                                                        Price
                                                    </div>
                                                    <div class="col-lg-8  text_justify">
                                                        {{($package['price'])}} đồng
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 " style='font-weight: bold;'>
                                                        Type
                                                    </div>
                                                    <div class="col-lg-8  text_justify">
                                                        {{$package['types']}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 " style='font-weight: bold;'>
                                                        Status
                                                    </div>
                                                    <div class="col-lg-8  text_justify">
                                                        {{$package['status']}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 " style='font-weight: bold;'>
                                                        Description</div>
                                                    <div class="col-lg-8  text_justify">
                                                        {{$package['description']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @endforeach
            </div>
            @empty
            @endforelse

            <div class="content-introduce">
                <div class="content-introduce-text">
                    <i>"We shape our home and then our
                        home shapes us"</i>
                    <div class="content-introduce-text-item">
                        <img src="{{asset('img/logo.png')}}" alt="">
                        <p>Blue spa team with love <i class="bi bi-hearts"></i></p>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
