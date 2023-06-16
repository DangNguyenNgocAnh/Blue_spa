@extends('user.layout.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px; background-image: none;">
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
                        <img src="{{asset('img/item1.jpeg')}}" class="d-block w-100" style="height:600px" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/item2.jpeg')}}" class="d-block w-100" style="height:600px" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/item3.jpeg')}}" class="d-block w-100" style="height:600px" alt="...">
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
                    <div class="content-options-static-content-item-text">
                        <p>Chăm sóc</p>
                        <a href="" style="color:white">Xem chi tiết</a>
                    </div>
                </div>
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-2.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text">
                        <p>Điều trị</p>
                        <a href="" style="color:white">Xem chi tiết</a>
                    </div>
                </div>
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-3.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text">
                        <p>Thẩm mỹ</p>
                        <a href="" style="color:white">Xem chi tiết</a>
                    </div>
                </div>
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/item1-4.jpeg')}}" alt="">
                    <div class="content-options-static-content-item-text">
                        <p>Phun xăm</p>
                        <a href="" style="color:white">Xem chi tiết</a>
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
                <i>"We shape our home and then our home shapes us"</i>
                <div class="content-introduce-text-item">
                    <img src="{{asset('img/logo.png')}}" alt="">
                    <p>Blue spa team with love <i class="bi bi-hearts"></i></p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
