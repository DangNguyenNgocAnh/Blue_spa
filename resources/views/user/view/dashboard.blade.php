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
    <div class="card-dashboard">
        <div class="card-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('img/item1.jpeg')}}" class="d-block w-100 img-width" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/item2.jpeg')}}" class="d-block w-100 img-width" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/item3.jpeg')}}" class="d-block w-100 img-width" alt="...">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="content-options-static ">
            <div class="content-options-static-content">
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-1.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text fix-title">
                        <p>Chăm sóc</p>
                        <a href="{{route('category.listItem',1)}}" style="color:white">Xem chi
                            tiết</a>
                    </div>
                </div>
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-2.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text fix-title">
                        <p>Điều trị</p>
                        <a href="{{route('category.listItem',2)}}" style="color:white">Xem chi
                            tiết</a>
                    </div>
                </div>
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-3.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text fix-title">
                        <p>Thẩm mỹ</p>
                        <a href="{{route('category.listItem',3)}}" style="color:white">Xem chi
                            tiết</a>
                    </div>
                </div>
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-4.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text fix-title">
                        <p>Phun xăm</p>
                        <a href="{{route('category.listItem',4)}}" style="color:white">Xem chi
                            tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-options-dynamic">
            <div class="content-options-dynamic-item">
                <img src="{{asset('img/item2-1.jpeg')}}" alt="">
            </div>
            <div class="content-options-dynamic-item">
                <img src="{{asset('img/item2-2.jpeg')}}" alt="">
            </div>
            <div class="content-options-dynamic-item">
                <img src="{{asset('img/item2-3.jpeg')}}" alt="">
            </div>
        </div>
        <div class="content-introduce">
            <div class="content-introduce-text">
                <i>"Start anew with our transformative experience"</i>
                <div class="content-introduce-text-item">
                    <img src="{{asset('img/logo.png')}}" alt="">
                    <p>Blue spa team with love <i class="bi bi-hearts"></i></p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
