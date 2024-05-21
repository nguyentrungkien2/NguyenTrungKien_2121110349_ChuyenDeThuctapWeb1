<?php

namespace App\Http\Controllers\Api;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*lay danh sach*/
    public function index(){
        $orders = Order::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'orders'=>$orders],200);
    }
        
    /*lay bang id -> chi tiet */
    // public function show($id){
    //     $order = Order::find($id);
    //     if ($order==null){
    //         return response()->json(
    //             ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'order' => null],404
    //         );
    //     }
    //     return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'order'=>$order],200);
    // }
    public function show($id){
        $order = Order::find($id);
        if ($order==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'order' => null],404
            );
        } 
        $orderdetail = Orderdetail::where("order_id","=",$id)->get();
        
        // $product = Product::where("id","=",$order->product_id)->get();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'order'=>$order,'orderdetail'=>$orderdetail],200);
    }
    /* them */
    public function store(Request $request){
        $order = new Order();
        $order->user_id = $request->user_id; //form
        $order->name = $request->name; //form
        $order->phone = $request->phone; //form
        $order->email = $request->email; //form
        $order->address = $request->address; //form
        $order->note = $request->note; //form
        $order->created_at = date('Y-m-d H:i:s');
       
        $order->status = $request->status; //form
        $order->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thêm thành công', 'order' => $order],201); 
    }
        
    /*update*/
    public function update(Request $request,$id){
        $order = Order::find($id);
        $order->user_id = $request->user_id; //form
        $order->name = $request->name; //form
        $order->phone = $request->phone; //form
        $order->email = $request->email; //form
        $order->address = $request->address; //form
        $order->note = $request->note; //form
        $order->created_at = date('Y-m-d H:i:s');
        $order->status = $request->status; //form
        $order->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Cập nhật thành công', 'data' => $order],200);
    }
        
    /* xoa */
    public function destroy($id){
        $order = Order::find($id);
        if ($order==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'order' => null],404
            );
        }
        $order->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'order' => null],200);
}
}
