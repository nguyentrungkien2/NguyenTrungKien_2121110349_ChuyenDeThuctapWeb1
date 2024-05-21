<?php

namespace App\Http\Controllers\Api;
use App\Models\Orderdetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderdetailController extends Controller
{
    // public function show($id){
    //     $order = Orderdetail::where("order_id","=",$id)->get();
    //     if ($order==null){
    //         return response()->json(
    //             ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'order' => null],404
    //         );
    //     }
        
    //     // $product = Product::where("id","=",$order->product_id)->get();
    //     return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'order'=>$order],200);
    // }

}
