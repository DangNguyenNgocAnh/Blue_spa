@extends('user.layout.master')
@section('tittle')
{{$tittle}}
@endsection

@section('content')
<main id="main" class="main" style="margin-left: 0px; background-image: none;">
    <div class="content">
        <div class="design-title">
            <h2>Một số thiết kế 3D</h2>
        </div>
        <span class="design-description">Một số thiết kế 3D được xây dựng và thi công bởi HomeFurniture. Các bạn hoàn
            toàn có thể tạo ra
            không gian mang phong cách riêng với thiết kế chuyên nghiệp. Liên hệ trực tiếp với HomeFurniture để được tư
            vấn chi tiết.</span>
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
                    <div class="description-package">
                        <div class='description-package-form'>
                            <h4 style="color:black; font-weight:bold;">About us - Blue Spa</h4>
                            <a href="">Xem chi tieets</a>
                            <p> Là một spa chuyên nghiệp với các dịch vụ cao cấp như chăm sóc da, điều
                                trị, thẩm mỹ, và phun xăm. Với đội ngũ chuyên viên giàu kinh nghiệm và tay nghề cao,
                                Blue spa cam kết mang đến cho khách hàng những trải nghiệm chăm sóc da và thư giãn
                                tuyệt vời nhất.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
