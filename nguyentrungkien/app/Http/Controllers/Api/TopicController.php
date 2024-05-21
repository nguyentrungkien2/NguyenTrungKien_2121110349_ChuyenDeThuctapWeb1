<?php

namespace App\Http\Controllers\Api;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 


class TopicController extends Controller
{
    /*lay danh sach thuong hieu*/
    public function index(){
        $topics = Topic::all();
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'topics'=>$topics],200);
    }
    
    /*lay thuong hieu bang id -> chi tiet */
    public function show($id){
        if(is_numeric($id)){
            $topic = Topic::find($id);
        }
        else{
            $topic = Topic::where('slug','=',$id)->first();
        }
        if ($topic==null){
            return response()->json(
                ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'topic' => null],404
            );
        }
        return response()->json(['success'=>true,'message'=>"Tải dữ liệu thành công",'topic'=>$topic],200);
        }
    
    /* them thuong hieu */
    public function store(Request $request){
    $topic = new Topic();
    $topic->name = $request->name; //form
    $topic->slug = Str::of($request->name)->slug('-');
    $topic->parent_id = $request->parent_id;
    $topic->metakey = $request->metakey; //form
    $topic->metadesc = $request->metadesc; //form
    $topic->created_at = date('Y-m-d H:i:s');
    $topic->created_by = 1;
    $topic->status = $request->status; //form
    $topic->save(); //Luuu vao CSDL
    return response()->json(['success' => true, 'message' => 'Thêm thành công', 'data' => $topic],201); 
    }
    
    /*update*/
    public function update(Request $request,$id){
        $topic = Topic::find($id);
        $topic->name = $request->name; //form
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->parent_id = $request->parent_id;
        $topic->metakey = $request->metakey; //form
        $topic->metadesc = $request->metadesc; //form
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->created_by = 1;
        $topic->status = $request->status; //form
        $topic->save();//Luu vao CSDL
        return response()->json(['success' => true, 'message' => 'Cập nhật thành công', 'data' => $topic],200);
    }
    
        /* xoa */
        public function destroy($id){
            $topic = Topic::find($id);        
            if ($topic==null){
                return response()->json(
                    ['success' => false, 'message' => 'Tải dữ liệu không thành công', 'topic' => null],404
                );
            }
    
            $topic->delete();
            return response()->json(['success' => true, 'message' => 'Xóa thành công', 'topic' => null],200);
        }
        ///////////

        public function topic_list($parent_id = 0){
            $args = [
                ['parent_id','=',$parent_id],
                ['status','=',1]
            ];
            $topics = Topic::where($args)->get();
            return response()->json( ['success' => true,'message' => 'Tải dữ liệu thành công', 'topics' => $topics],200);
        }
}
