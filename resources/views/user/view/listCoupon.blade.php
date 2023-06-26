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
            <h2>Mã giảm giá</h2>
            <a type="button" class="btn btn-secondary" href="{{route('user.dashboard')}}">Back</a>
        </div>
        <p> Danh sách các mã giảm giá : </p>
        <p>(gồm có {{$count}} mã)</p>
        <div class="content-options-static ">
            @forelse($coupons as $key=>$coupons)
            <div class="content-options-static-content">
                @foreach($coupons as $key=>$coupon)
                <div class="content-options-static-content-item">
                    <img src="{{asset('img/gift-voucher.png')}}" alt="">
                    <div class="content-options-static-content-item-text "
                        style="top: 13px;right: 0px; width:100%; text-align: start; padding-left:10px">
                        <p class="col-12" style="padding-bottom: 0px;margin-bottom: 0px; color:black; font-size:17px">
                            {{$coupon['name']}}
                        </p>
                        <p style="font-size:10px; color:black"> {{$coupon['price']}} VND</p>
                        <a style="font-size:10px" data-bs-toggle="modal"
                            data-bs-target="#confirmModal{{ $coupon['id'] }}">>Mua ngay</a>
                    </div>

                    <!-- Modalconfirm-->
                    <form action="{{route('payments.index',$coupon['id'])}}" method="post">
                        @csrf
                        <div class="modal fade" id="confirmModal{{ $coupon['id'] }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Xác nhận thanh toán
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn sẽ được chuyển đến trang <b>thanh toán VNPay </b> để thanh toán gói
                                        <b>{{$coupon['name']}} </b>.
                                        <br> Vui lòng nhấn <b>Accept</b> để tiếp tục.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger w-100px">Accept</button>
                                        <button type="button" class="btn btn-secondary w-100px"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
