<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Payment;
use App\Models\UserCoupon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Coupon $coupon)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('payments.dataReturn');
        $vnp_TmnCode = "SIQUF94W"; //Mã website tại VNPAY 
        $vnp_HashSecret = "FTIARMCDZMOEPQNBNMOEKGWWCNGTDSGN"; //Chuỗi bí mật

        $vnp_TxnRef = fake()->numerify('DH##########'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $coupon->name;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = str_replace(',', '', $coupon->price) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
    public function dataReturn(Request $request)
    {
        try {
            Payment::create([
                'transaction_code' => $request->vnp_TransactionNo,
                'order_id' => $request->vnp_TxnRef,
                'payment_content' => $request->vnp_OrderInfo,
                'price' => $request->vnp_Amount,
                'bank_name' => $request->vnp_BankCode,
                'payment_option' => $request->vnp_CardType,
                'status' => ($request->vnp_TransactionStatus == '00') ? 'Success' : 'Failed',
                'user_id' => Auth::id(),
            ]);
            if ($request->vnp_TransactionStatus == '00') {
                UserCoupon::create([
                    'user_id' => Auth::id(),
                    'coupon_id' => Coupon::where('name', $request->vnp_OrderInfo)->value('id'),
                    'timeExpiredAt' => now()->addMonths(3),
                    'status' => true
                ]);
                return redirect()->route('user.showAllPackage')->with('success', "Bạn đã đặt thành công mã giảm giá $request->vnp_OrderInfo ! ");
            }
            return redirect()->route('user.showAllPackage')->with('warning', 'Đơn hàng bị lỗi, vui lòng thử lại.');
        } catch (Exception $excep) {
            return redirect()->route('user.showAllPackage')->with('failed', 'Error');
        }
    }
}
