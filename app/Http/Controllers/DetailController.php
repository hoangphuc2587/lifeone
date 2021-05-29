<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //use thư viện auths
use Session;
use Illuminate\Support\MessageBag;
use Hash;
use App\MTantWeb;
use App\T_IRAI;
use DB;
class DetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        if($request->session()->has('data_search_list_detail')){
            $datas = $request->session()->get('data_search_list_detail');
        }
        $request->session()->forget('data_search_list_detail');
        return view('detail',compact('datas'));
    }
    public function search_detail($id){
        $datas = DB::table('T_IRAI')
        ->join('M_KBN_WEB','M_KBN_WEB.KBNMSAI_CD','=','T_IRAI.JYOKYO_CD')
        ->where('KBN_CD',01)
        ->where('T_IRAI.IRAI_ID',$id);
        if(Auth::user()->KOJIGYOSYA_CD != ''){
            $datas->where('T_IRAI.KOJIGYOSYA_CD',Auth::user()->KOJIGYOSYA_CD);
        }
        $datas = $datas->get();
        return view('detail',compact('datas'));
    }
    public function detail_list(Request $request){
        $request->session()->put('data_detail_list',$request->data);
    }

}
