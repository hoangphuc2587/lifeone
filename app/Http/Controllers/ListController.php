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
        //依頼内容
        $query = DB::table('M_KBN_WEB')
        ->where('KBN_CD','00')
        ->where('DEL_FLG', 0);
        $requestDetails = $query->get();

        //状況
        $query = DB::table('M_KBN_WEB')
        ->where('KBN_CD','04')
        ->where('DEL_FLG', 0);
        $statusList = $query->get();
        if($request->session()->has('page_click') && $request->session()->has('page_center') && $request->session()->has('total_row_on_one_page') && $request->session()->has('field_sort') && $request->session()->has('query_sort') ){
            $page_click             =  $request->session()->get('page_click');
            $page_center            =  $request->session()->get('page_center');
            $total_row_on_one_page  =  $request->session()->get('total_row_on_one_page');
            $field_sort             =  $request->session()->get('field_sort');
            $query_sort             =  $request->session()->get('query_sort');
        }

        $lists = array();

        $query = DB::table('T_HACYU')
        ->select(
         'T_HACYU.IRAI_YMD',
         'T_HACYU.IRAI_DAY',
         'T_HACYU.HACYU_ID',
         'T_HACYU.STS_CD',
         'T_HACYUMSAI.MAKER',
         'T_HACYU.NONYUSAKI_ADDRESS',
         'T_HACYU.COMMENT1',
         'T_HACYU.COMMENT2',
         'T_HACYU.NOHIN_KIBO_FLG',
         'T_HACYU.FREE',
         DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.IRAI_CD AND M_KBN_WEB.KBN_CD = '00' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS IRAI_CD_NAME"),
         DB::raw("(SELECT KBNMSAI_BIKO FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.IRAI_CD AND M_KBN_WEB.KBN_CD = '00' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS IRAI_COLOR"),
         DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.STS_CD AND M_KBN_WEB.KBN_CD = '03' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS STS_CD_NAME"),
         'T_HACYU.HACYU_SYBET_NAME',
         'T_HACYU.NONYUSAKI_TANT_NAME',
         'T_HACYU.LAST_NKAYOTEI_YMD',
         'T_HACYU.HACYUSAKI_NAME',
          DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.TAIO_CD AND M_KBN_WEB.KBN_CD = '04' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS TAIO_CD"),
          DB::raw("(SELECT TANT_NAME FROM M_TANT_WEB WHERE M_TANT_WEB.TANT_CD = T_HACYU.TAIO_TANT_CD AND M_TANT_WEB.DEL_FLG = 0 LIMIT 1) AS TAIO_TANT_NAME"),          
          'T_HACYU.PDF_PATH',
          'T_HACYU.EXCEL_PATH',
          'T_HACYU.HAISO_INF'

        )
        ->leftJoin('T_HACYUMSAI','T_HACYUMSAI.HACYU_ID','=','T_HACYU.HACYU_ID')
        ->where(['T_HACYU.DEL_FLG'=> 0,'T_HACYU.VISIVLE_FLG'=>1])
        ->GROUPBY('T_HACYU.HACYU_ID');

        $isUserLifeOne = true;
        if(Auth::user()->HACYUSAKI_CD != ''){
            $isUserLifeOne = false;
            $query->where('T_HACYU.HACYUSAKI_CD', Auth::user()->HACYUSAKI_CD);
        }
        
        $paramSearch = array();
        $query = $this->__getCondition($query, $request, $paramSearch);


        $arrTotal = array();
        //未発注件
        $queryTotal = clone $query;
        $queryTotal =  $queryTotal->where('T_HACYU.STS_CD' , '01');
        $arrTotal[0] = count($queryTotal->get());
        //納期回答未・一部未回答
        $queryTotal = clone $query;
        $queryTotal=  $queryTotal->whereIn('T_HACYU.STS_CD' , ['02', '03']);
        $arrTotal[1] = count($queryTotal->get());
        //納期催促
        $queryTotal = clone $query;
        $queryTotal=  $queryTotal->where('T_HACYU.STS_CD' , '04');
        $arrTotal[2] = count($queryTotal->get());
        //ドライバー情報入力未
        $queryTotal = clone $query;
        $queryTotal=  $queryTotal->where('T_HACYU.STS_CD' , '06');
        $arrTotal[3] = count($queryTotal->get());

        // total all record before paging
        $total_datas = count($query->get());
       
        $page_total = ceil($total_datas/$total_row_on_one_page);

        $query = $query->skip(($page_click - 1) * $total_row_on_one_page)
        ->take($total_row_on_one_page)
        ->orderBy($field_sort,$query_sort)
        ->orderBy('T_HACYU.HACYU_ID', 'asc')
        ->orderBy('T_HACYUMSAI.HACYUMSAI_ID', 'asc');
        $lists = $query->get();

        return view('list',compact('isUserLifeOne','lists','page_click','page_total','page_center','total_datas', 'requestDetails', 'statusList', 'arrTotal', 'paramSearch'));
    }
    private function __getCondition($query, Request $request, &$paramSearch){
        if($request->session()->has('search_reply')){
            $query->where('T_HACYU.STS_CD' , '10');
        }
        else{
            $query->where('T_HACYU.STS_CD', '<>' ,'10');
        }

        if($request->session()->has('key_search_name') && Auth::user()->HACYUSAKI_CD == ''){
            $name = $request->session()->get('key_search_name');
            $paramSearch['name'] = $name;
            $query->where('T_HACYU.HACYUSAKI_NAME', 'LIKE' , '%'.$name.'%'); 
        }

        if($request->session()->has('key_search_request')){
            $request_id = $request->session()->get('key_search_request');
            $paramSearch['request_id'] = $request_id;
            $query->where('T_HACYU.IRAI_CD', $request_id); 
        }

        if($request->session()->has('key_search_irai_day_from')){
            $irai_day_from = $request->session()->get('key_search_irai_day_from');

            $paramSearch['irai_day_from'] = date('m/d/Y', strtotime($irai_day_from));
            $query->where('T_HACYU.IRAI_YMD', '>=', $irai_day_from); 
        }

        if($request->session()->has('key_search_irai_day_to')){
            $irai_day_to = $request->session()->get('key_search_irai_day_to');
            $paramSearch['irai_day_to'] = date('m/d/Y', strtotime($irai_day_to));
            $query->where('T_HACYU.IRAI_YMD', '<=', $irai_day_to); 
        }         

        if($request->session()->has('key_search_id')){
            $ids = $request->session()->get('key_search_id');
            $paramSearch['id'] = implode(',', $ids);
            $query->whereIn('T_HACYU.HACYU_ID', $ids); 
        }

        if($request->session()->has('key_search_status')){
            $status_id = $request->session()->get('key_search_status');
            $paramSearch['status_id'] = $status_id;
            $query->where('T_HACYU.TAIO_CD', $status_id);
        }

        if($request->session()->has('key_search_maker')){
            $maker = $request->session()->get('key_search_maker');
            $paramSearch['maker'] = $maker;
            $query->where('T_HACYUMSAI.MAKER', 'LIKE' , '%'.$maker.'%'); 
        }

        if($request->session()->has('key_search_address')){
            $address = $request->session()->get('key_search_address');
            $paramSearch['address'] = $address;
            $query->where('T_HACYU.NONYUSAKI_ADDRESS', 'LIKE' , '%'.$address.'%'); 
        }

        if($request->session()->has('key_search_nohin_day_from')){
            $nohin_day_from = $request->session()->get('key_search_nohin_day_from');
            $paramSearch['nohin_day_from'] = date('m/d/Y', strtotime($nohin_day_from));
            $query->whereRaw("CASE WHEN T_HACYU.IRAI_CD = '03' THEN T_HACYUMSAI.NOHIN_YMD ELSE T_HACYUMSAI.KAITO_NOKI END >= '".$nohin_day_from."'"); 
        }

        if($request->session()->has('key_search_nohin_day_to')){
            $nohin_day_to = $request->session()->get('key_search_nohin_day_to');
            $paramSearch['nohin_day_to'] = date('m/d/Y', strtotime($nohin_day_to));
            $query->whereRaw("CASE WHEN T_HACYU.IRAI_CD = '03' THEN T_HACYUMSAI.NOHIN_YMD ELSE T_HACYUMSAI.KAITO_NOKI END <= '".$nohin_day_to."'");
        }         

        if($request->session()->has('key_search_hinban')){
            $hinban = $request->session()->get('key_search_hinban');
            $paramSearch['hinban'] = $hinban;
            $query->where('T_HACYUMSAI.HINBAN', 'LIKE' , '%'.$hinban.'%'); 
        }
        return $query;

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
    public function search_list_by_item(Request $request){

        if ($request->name == ''){
            $request->session()->forget('key_search_name');  
        }else{
            $request->session()->put('key_search_name', $request->name);
        }

        if ($request->request_id == ''){
            $request->session()->forget('key_search_request');  
        }else{
            $request->session()->put('key_search_request', $request->request_id);
        } 

        if ($request->irai_day_from == ''){
            $request->session()->forget('key_search_irai_day_from');  
        }else{
            $arr = explode('/', $request->irai_day_from);
            $date = $arr[2].'-'.$arr[0].'-'.$arr[1];
            $request->session()->put('key_search_irai_day_from', $date);
        }

        if ($request->irai_day_to == ''){
            $request->session()->forget('key_search_irai_day_to');  
        }else{
            $arr = explode('/', $request->irai_day_to);
            $date = $arr[2].'-'.$arr[0].'-'.$arr[1];
            $request->session()->put('key_search_irai_day_to', $date);
        }        

        $key_search_id   = $request->id;        
        if(stripos($key_search_id,',', 0) > -1){
            $data = explode(',',$key_search_id);
        }
        else{
            $data = explode(' ',$key_search_id);
        }
        $list = array();
        if (!empty($data)){
            foreach($data as $key => $value){
                // $str = '';
                // if(strlen($value) == 9){
                //     continue;
                // }if(strlen($value) == 10){
                //     $list[] = $value;
                //     continue;
                // }
                // for($i = 0 ; $i < (10-strlen($value)) - 2 ; $i++){
                //     $str .= "0";
                // }
                // $list[] = '03'.$str.$value;
                // $list[] = '20'.$str.$value;
                if ($value != ''){
                    $list[] = $value;
                }                
            }
        }

        if (empty($list)){
            $request->session()->forget('key_search_id');  
        }else{
            $request->session()->put('key_search_id',$list);
        }

        if ($request->status_id == ''){
            $request->session()->forget('key_search_status');  
        }else{
            $request->session()->put('key_search_status', $request->status_id);
        }

        if ($request->maker == ''){
            $request->session()->forget('key_search_maker');  
        }else{
            $request->session()->put('key_search_maker', $request->maker);
        }

        if ($request->address == ''){
            $request->session()->forget('key_search_address');  
        }else{
            $request->session()->put('key_search_address', $request->address);
        }


        if ($request->nohin_day_from == ''){
            $request->session()->forget('key_search_nohin_day_from');  
        }else{
            $arr = explode('/', $request->nohin_day_from);
            $date = $arr[2].'-'.$arr[0].'-'.$arr[1];
            $request->session()->put('key_search_nohin_day_from', $date);
        }

        if ($request->nohin_day_to == ''){
            $request->session()->forget('key_search_nohin_day_to');  
        }else{
            $arr = explode('/', $request->nohin_day_to);
            $date = $arr[2].'-'.$arr[0].'-'.$arr[1];
            $request->session()->put('key_search_nohin_day_to', $date);
        }        

        if ($request->hinban == ''){
            $request->session()->forget('key_search_hinban');  
        }else{
            $request->session()->put('key_search_hinban', $request->hinban);
        }        

        $request->session()->put('page_click',1);        
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