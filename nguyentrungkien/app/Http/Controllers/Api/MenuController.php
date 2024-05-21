<?php

namespace App\Http\Controllers\Api;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /*lay danh sach*/
    public function index(){
        $menus = Menu::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'menus'=>$menus],200);
    }
    
    /*lay bang id -> chi tiet */
    public function show($id){
        $menu = Menu::find($id);
        if ($menu==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'menu' => null],404
            );
        }
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'menu'=>$menu],200);
    }
    
        /* them */
        public function store(Request $request){
            $menu = new Menu();
            $menu->name = $request->name; //form
            $menu->link = $request->link; //form
            $menu->position = $request->position;
            $menu->level = $request->level; //form
            $menu->table_id = $request->table_id; //form
            $menu->type = $request->type; //form
            $menu->sort_order = $request->sort_order; //form
            $menu->parent_id = $request->parent_id; //form
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->status = $request->status; //form
            $menu->save(); //Luuu vao CSDL
            return response()->json(['success' => true, 'message' => 'Thêm thành công', 'menu' => $menu],201); 
        }
    
        /*update*/
        public function update(Request $request,$id){
            $menu = Menu::find($id);
            $menu->name = $request->name; //form
            $menu->link = $request->link; //form
            $menu->position = $request->position;
            $menu->level = $request->level; //form
            $menu->table_id = $request->table_id; //form
            $menu->type = $request->type; //form
            $menu->sort_order = $request->sort_order; //form
            $menu->parent_id = $request->parent_id; //form
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->status = $request->status; //form
            $menu->save(); //Luuu vao CSDL
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công', 'menu' => $menu],200);
        }
    
        /* xoa */
        public function destroy($id){
            $menu = Menu::find($id);
            $menu->delete();
            return response()->json(['success' => true, 'message' => 'Xóa thành công', 'menu' => null],200);
            }

        /*Lay du lieu len trang frontend */

        public function menu_list($position,$parent_id=0){
            $args = [
                ['position','=',$position],
                ['parent_id','=',$parent_id],
                ['status','=',1]
            ];
            $menus=Menu::where($args)->orderBy('sort_order','ASC')->get();
            if (count($menus)>0){
                return response()->json(['success' => true, 'message' => 'Tải dữ liệu thành công', 'menus' => $menus],200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Không có dữ liệu', 'menus' => null],200);

            }
            // return response()->json(['success' => true, 'message' => 'Tải dữ liệu thành công', 'menus' => $menus],200);
        }

        public function menu_footer($position,$parent_id=0){
            $args = [
                ['position','=',$position],
                ['parent_id','=',$parent_id],
                ['table_id','=',1],
                ['status','=',1]
            ];
            $menus=Menu::where($args)->orderBy('sort_order','ASC')->get();
            if (count($menus)>0){
                return response()->json(['success' => true, 'message' => 'Tải dữ liệu thành công', 'menus' => $menus],200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Không có dữ liệu', 'menus' => null],200);

            }
        }

        public function cs_footer($position,$parent_id=0){
            $args = [
                ['position','=',$position],
                ['parent_id','=',$parent_id],
                ['status','=',1]
            ];
            $menus=Menu::where($args)->orderBy('sort_order','ASC')->get();
            if (count($menus)>0){
                return response()->json(['success' => true, 'message' => 'Tải dữ liệu thành công', 'menus' => $menus],200);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Không có dữ liệu', 'menus' => null],200);

            }
        }
}
