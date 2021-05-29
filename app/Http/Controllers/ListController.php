<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //use thư viện auths
use Cookie;
use Session;
use Illuminate\Support\MessageBag;
use Hash;
use App\MTantWeb;
use DB;
use App\ExportController;
class ListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home(Request $request){
        if($request->session()->has('search_list_by_id') || $request->session()->has('search_by_kojigyoya_name')){
            $request->session()->forget('search_list_by_id');
            $request->session()->forget('search_by_kojigyoya_name');
            $request->session()->put('page_click',1);
        }
        return redirect()->route('list');
    }
    public function show(Request $request)
    {
        if($request->session()->has('page_click') && $request->session()->has('page_center') && $request->session()->has('total_row_on_one_page') && $request->session()->has('field_sort') && $request->session()->has('query_sort') ){
            $page_click             =  $request->session()->get('page_click');
            $page_center            =  $request->session()->get('page_center');
            $total_row_on_one_page  =  $request->session()->get('total_row_on_one_page');
            $field_sort             =  $request->session()->get('field_sort');
            $query_sort             =  $request->session()->get('query_sort');
        }

        $lists = array();
        $page_total = 0;
        $total_datas = 0;
        
        return view('list',compact('lists','page_click','page_total','page_center','total_datas'));
    }
    public function sort_commet($lists){
        $flag_sort1     = false;
        $flag_sort2     = false;
        $result1        = [];
        $result2        = [];
        $array_id       = []; 
        $key_first_sort = '';
        foreach($lists as $key => $value){
            if($value->COMMENT1 != '' && $value->KBNMSAI_NAME == '未回答'){
                if($flag_sort1 == false){
                    $key_first_sort = $key;
                } 
                $result1[]   = $value;
                $flag_sort1  = true;
            }
            if($value->COMMENT1 != '' && $value->KBNMSAI_NAME != '未回答'){
                if($flag_sort2 == false){
                    $key_first_sort = $key;
                } 
                $result2[]    = $value;
                $array_id[]   = $key;
                $flag_sort2   = true;
            }
        }
        if($flag_sort1)
            asort($result1);
        if($flag_sort2)
            asort($result2);
        if(session()->get('query_sort') == "asc"){
            if($flag_sort1 || $flag_sort2){
                $result = array_merge($result1,$result2);
                $count = 0;
                foreach($lists as $key => $value){
                    if($value->COMMENT1 != '' && $value->KBNMSAI_NAME == '未回答'){
                        $lists[$key] = $result[$count];
                        $count++;
                    }
                    if($value->COMMENT1 != '' && $value->KBNMSAI_NAME != '未回答'){
                        $lists[] = $result[$count];
                        $count++;
                    }
                }
                foreach($array_id as $k => $v){
                    unset($lists[$v]);
                }
                return $lists;
            }
        }
        if($flag_sort1 || $flag_sort2){
            $result = array_merge($result1,$result2);
            $count = 0;
            foreach($lists as $key => $value){
                if($value->COMMENT1 != ''){
                    $lists[$key] = $result[$count];
                    $count++;
                }
            }
        }
        
        return $lists;
    }
    public function page_click($page_click,Request $request){
        $request->session()->put('page_click',$page_click);
        return redirect()->route('list');
    }
    public function asc_page_current(Request $request){
        $page_current = $request->session()->get('page_click');
        $request->session()->put('page_click',$page_current - 1);
        return redirect()->route('list');
    }
    public function desc_page_current(Request $request){
        $page_current = $request->session()->get('page_click');
        $request->session()->put('page_click',$page_current + 1);
        return redirect()->route('list');
    }
    public function take_total_row_on_one_page($total,Request $request){
        $request->session()->put('total_row_on_one_page',$total);
        $request->session()->put('page_click',1);
        return redirect()->route('list');
    }
    public function export_csv_list(Request $request){
        session()->put('list_csv',$request->lists_csv);
    }
    public function field_sort($field_sort,Request $request){
        $request->session()->put('field_sort',$field_sort);
        $request->session()->put('page_click',1);
    }
    public function query_sort($query_sort,Request $request){
        $request->session()->put('query_sort',$query_sort);
        $request->session()->put('page_click',1);
    }
    public function search_list_by_id_and_name(Request $request){
        $key_search_id   = $request->id;
        $request->session()->put('key_search_id',$request->id);
        $request->session()->put('key_search_name',$request->name);
        if(stripos($key_search_id,',', 0) > -1){
            $data = explode(',',$key_search_id);
        }
        else{
            $data = explode(' ',$key_search_id);
        }
        $list = [];
        foreach($data as $key => $value){
            $str = '';
            if(strlen($value) == 9){
                continue;
            }if(strlen($value) == 10){
                $list[] = $value;
                continue;
            }
            for($i = 0 ; $i < (10-strlen($value)) - 2 ; $i++){
                $str .= "0";
            }
            $list[] = '03'.$str.$value;
            $list[] = '20'.$str.$value;
        }
        $request->session()->put('search_list_by_id',$list);
        $request->session()->put('search_by_kojigyoya_name',$request->name);
        $request->session()->put('page_click',1);
        $request->session()->forget('search_reply');
        $request->session()->forget('search_no_reply');
        $request->session()->forget('data_list_checkbox');
    }
    public function search_list_all(Request $request){
        $request->session()->put('key_search_id','');
        $request->session()->put('key_search_name','');
        $request->session()->forget('search_list_by_id');
        $request->session()->forget('search_by_kojigyoya_name');
        $request->session()->forget('data_list_checkbox');
    }
    public function search_list_by_id(Request $request){
        $key_search_id   = $request->id;
        $request->session()->put('key_search_id',$request->id);
        if(stripos($key_search_id,',', 0) > -1){
            $data = explode(',',$key_search_id);
        }
        else{
            $data = explode(' ',$key_search_id);
        }
        $list = [];
        foreach($data as $key => $value){
            $str = '';
            if(strlen($value) == 9){
                continue;
            }if(strlen($value) == 10){
                $list[] = $value;
                continue;
            }
            for($i = 0 ; $i < (10-strlen($value)) - 2 ; $i++){
                $str .= "0";
            }
            $list[] = '03'.$str.$value;
            $list[] = '20'.$str.$value;
        }
        $request->session()->put('search_list_by_id',$list);
        $request->session()->put('key_search_name','');
        if($request->session()->has('search_by_kojigyoya_name')){
            $request->session()->forget('search_by_kojigyoya_name');
        }
        $request->session()->put('page_click',1);
        $request->session()->forget('search_reply');
        $request->session()->forget('search_no_reply');
        $request->session()->forget('data_list_checkbox');
    }
    public function search_list_by_kojigyoya_name(Request $request){
        $request->session()->put('key_search_id','');
        $request->session()->put('key_search_name',$request->name);
        $request->session()->put('search_by_kojigyoya_name',$request->name);
        if($request->session()->has('search_list_by_id')){
            $request->session()->forget('search_list_by_id');
        }
        $request->session()->put('page_click',1);
        $request->session()->forget('search_reply');
        $request->session()->forget('search_no_reply');
        $request->session()->forget('data_list_checkbox');
    }
    public function search_reply($key_seacrch_reply,Request $request){
        if($key_seacrch_reply == 'true'){
            $request->session()->put('search_reply',$key_seacrch_reply);
            $request->session()->put('page_click',1);
        }
        else{
            $request->session()->forget('search_reply');
            $request->session()->put('page_click',1);
        }
    }
    public function search_no_reply($key_seacrch_reply,Request $request){
        if($key_seacrch_reply == 'true'){
            $request->session()->put('search_no_reply',$key_seacrch_reply);
            $request->session()->put('page_click',1);
        }
        else{
            $request->session()->forget('search_no_reply');
            $request->session()->put('page_click',1);
        }
    }
    public function get_list_check_box(Request $request){
        $request->session()->put('data_list_checkbox',$request->data_list_checkbox);
    }
    
}