<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CouponModel;
use App\Models\CouponUsageModel;

class CouponController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
        $coupon = CouponModel::where('code', $query)->first();

        $op[0] = 0;

        if($coupon){
            $couponLimit = $coupon->amountLimit;
            $couponUsage = $coupon->amountUsage;

            if($couponUsage < $couponLimit){
                $op[1] = $coupon->discount;

                $usage = CouponUsageModel::where('idUser', auth()->id())
                ->where('idCoupon', $coupon->id)
                ->first();

                if($usage){
                    $op[0] = 2;
                }else{
                    $op[0] = 1;
                }
            }else{
                $op[0] = 3;
            }
        }

        return response()->json($op);
    }
}
