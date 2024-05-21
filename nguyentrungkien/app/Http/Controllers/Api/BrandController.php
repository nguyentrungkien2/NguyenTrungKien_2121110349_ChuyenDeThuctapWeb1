<?php

namespace App\Http\Controllers\Api;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class BrandController extends Controller
{
    /*lay danh sach thuong hieu*/
    public function index(){
        $brands = Brand::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'brands'=>$brands],200);
    }

    /*lay thuong hieu bang id -> chi tiet */
    public function show($id){
        if(is_numeric($id)){
            $brand = Brand::find($id);
        }
        else{
            $brand = Brand::where('slug','=',$id)->first();
        }
        if ($brand==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'brand' => null],404
            );
        }
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'brand'=>$brand],200);
    }


    /* them thuong hieu */
    public function store(Request $request){
        $brand = new Brand();
        $brand->name = $request->name; //form
        $brand->slug = Str::of($request->name)->slug('-');
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();//lấy phần mở rộng 
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $brand->slug . '.' . $extension;
                $brand->image = $filename;
                $files->move(public_path('images/brand'), $filename);//lưu hình vào folder
            }
        }        $brand->sort_order = $request->sort_order; //form
        $brand->metakey = $request->metakey; //form
        $brand->metadesc = $request->metadesc; //form
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->created_by = 1;
        $brand->status = $request->status; //form
        $brand->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Thêm thành công', 'data' => $brand],201); 
    }

    /*update*/
    public function update(Request $request,$id){
        $brand = Brand::find($id);
        $brand->name = $request->name; // form
        $brand->slug = Str::of($request->name)->slug('-');
        // sử lý hình
        $files = $request->image;
        if ($files != null) {
            $extension = $files->getClientOriginalExtension();//lấy phần mở rộng 
            if (in_array($extension, ['jpg', 'png', 'gif', 'webp', 'jpeg'])) {
                $filename = $brand->slug . '.' . $extension;
                $brand->image = $filename;
                $files->move(public_path('images/brand'), $filename);//lưu hình vào folder
            }
        }
        $brand->sort_order = $request->sort_order; //form
        $brand->metakey = $request->metakey; //form
        $brand->metadesc = $request->metadesc; //form
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        $brand->status = $request->status; //form
        $brand->save(); //Luuu vao CSDL
        return response()->json(['success' => true, 'message' => 'Cập nhật thành công', 'data' => $brand],200);
    }

    /* xoa */
    public function destroy($id){
        $brand = Brand::findOrFail($id);
        if ($brand==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'brand' => null],404
            );
        }
         
        $brand->delete();
        return response()->json(['success' => true, 'message' => 'Xóa thành công', 'brand' => null],200);
    }

        /* lay du lieu len frontend */
        public function brand_list($parent_id = 0){
            $args = [
                ['parent_id','=',$parent_id],
                ['status','=',1]
            ];
            $brands = Brand::where($args)->orderBy('sort_order','ASC')->get();
            return response()->json( ['success' => true,'message' => 'Tải dữ liệu thành công', 'brands' => $brands],200);
        }
    
}
