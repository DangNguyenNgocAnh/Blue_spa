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
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('img/item3.jpeg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <div class='form-img display1'>
                                <h4 style="color:black; font-weight:bold; padding-top:20px">About us - Blue Spa</h4>
                                <p> Là một spa chuyên nghiệp với các dịch vụ cao cấp như chăm sóc da, điều
                                    trị, thẩm mỹ, và phun xăm. Với đội ngũ chuyên viên giàu kinh nghiệm và tay nghề cao,
                                    Blue spa cam kết mang đến cho khách hàng những trải nghiệm chăm sóc da và thư giãn
                                    tuyệt vời nhất.
                                </p>
                                <p>
                                    Với các liệu trình chăm sóc da, Blue spa sử dụng các sản phẩm chăm sóc da chất lượng
                                    cao và được chọn lọc kỹ càng để đáp ứng nhu cầu của từng loại da. Khách hàng sẽ được
                                    tư vấn và chăm sóc bởi các chuyên viên được đào tạo chuyên sâu về da, giúp tối ưu
                                    hóa hiệu quả của liệu trình và đảm bảo sự thoải mái và an toàn cho khách hàng.
                                </p>
                                <p> Tất cả các dịch vụ của Blue spa được cung cấp trong một không gian sang trọng, đẳng
                                    cấp và thoải mái, giúp khách hàng tận hưởng những trải nghiệm chăm sóc da và thư
                                    giãn tuyệt vời.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/item2.jpeg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <div class='form-img display1'>
                                <h4 style="color:black; font-weight:bold; padding-top:20px">Đội ngũ nhân viên - Blue Spa
                                </h4>
                                <p> Đội ngũ nhân viên của Blue spa là một đội ngũ chuyên nghiệp, giàu kinh nghiệm và
                                    được đào tạo chuyên sâu trong lĩnh vực chăm sóc da và thẩm mỹ. Tất cả các chuyên
                                    viên của Blue spa đều là những người đam mê và tâm huyết với công việc của mình, cam
                                    kết mang đến cho khách hàng những trải nghiệm chăm sóc da và thư giãn tuyệt vời
                                    nhất.
                                </p>
                                <p>
                                    Các chuyên viên của Blue spa đều có kinh nghiệm lâu năm trong lĩnh vực chăm sóc da
                                    và thẩm mỹ, được đào tạo chuyên sâu về da và các kỹ thuật chăm sóc da tiên tiến
                                    nhất. Họ luôn cập nhật những xu hướng mới nhất trong lĩnh vực chăm sóc da và thẩm mỹ
                                    để mang đến cho khách hàng những dịch vụ tốt nhất và hiệu quả nhất.
                                </p>
                                <p>
                                    Tất cả các chuyên viên của Blue spa đều sẽ phục vụ với thái độ phục vụ chu đáo và
                                    thân thiện,
                                    đảm bảo khách hàng có được sự thoải mái và thư giãn tối đa trong quá trình chăm sóc
                                    da và thẩm mỹ. Với đội ngũ nhân viên chuyên nghiệp và tận tâm, Blue spa cam kết mang
                                    đến cho khách hàng những trải nghiệm chăm sóc da và thư giãn tuyệt vời nhất.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('img/item1.jpeg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <div class='form-img display1'>
                                <h4 style="color:black; font-weight:bold; padding-top:20px"> Blue Spa
                                </h4>
                                <p>Bạn có muốn được trải nghiệm tại spa của chúng tôi? Vui lòng <a href="{{route('user.apointment')}}">Click <i class="bi bi-chat-left-heart"></i>
                                    </a>
                                    để có thể đặt lịch đến trải nghiệm.
                                </p>
                                <p>
                                    Nếu có gì thắc mắc vui lòng liên hệ với chúng tôi. <i class="bi bi-house-heart"></i>
                                </p>
                                <p>Rất mong được phục vụ quý khách ! <i class="bi bi-heart"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="screen-small display2">
        <div class='form-img' style="border: none">
            <h4 style="color:black; font-weight:bold; padding-top:20px; text-align:center">About us - Blue Spa</h4>
            <p>
                <hr> Là một spa chuyên nghiệp với các dịch vụ cao cấp như chăm sóc da, điều
                trị, thẩm mỹ, và phun xăm. Với đội ngũ chuyên viên giàu kinh nghiệm và tay nghề cao,
                Blue spa cam kết mang đến cho khách hàng những trải nghiệm chăm sóc da và thư giãn
                tuyệt vời nhất.
            </p>
            <p> Tất cả các dịch vụ của Blue spa được cung cấp trong một không gian sang trọng, đẳng
                cấp và thoải mái, giúp khách hàng tận hưởng những trải nghiệm chăm sóc da và thư
                giãn tuyệt vời.</p>
            <p>Bạn có muốn được trải nghiệm tại spa của chúng tôi? Vui lòng <a href="{{route('user.apointment')}}">Click
                    <i class="bi bi-chat-left-heart"></i>
                </a>
                để có thể đặt lịch đến trải nghiệm.
            </p>
            <p>
                Nếu có gì thắc mắc vui lòng liên hệ với chúng tôi. <i class="bi bi-house-heart"></i>
            </p>
            <p>Rất mong được phục vụ quý khách ! <i class="bi bi-heart"></i>
            </p>
        </div>
    </div>
</main>
@endsection
