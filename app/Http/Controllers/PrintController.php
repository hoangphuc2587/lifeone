<?php

namespace App\Http\Controllers;

use Auth; //use thư viện auths
use DB;
use view;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\T_IRAI;
use App\T_IRAIMSAI;
use App\M_KBN_WEB;
use DateTime;
class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function print_list(Request $request)
    {
        $request->session()->put('data_print_list', $request->data);
    }
    public function show(Request $request)
    {
        if($request->session()->has('data_search_list_print')){
            $datas = $request->session()->get('data_search_list_print');
        }
        $request->session()->forget('data_search_list_print');
        return view('print',compact('datas'));
    }
    public function search_print($id, $hansu)
    {
        $cnn = 0;
        $data = [];
        $data1 = DB::table('T_IRAI')
            ->join('M_KBN_WEB', 'M_KBN_WEB.KBNMSAI_CD', '=', 'T_IRAI.JYOKYO_CD')
            ->where('T_IRAI.IRAI_ID', $id)
            ->where('T_IRAI.HANSU', $hansu);
        if (Auth::user()->KOJIGYOSYA_CD != '') {
            $data1->where('T_IRAI.KOJIGYOSYA_CD', Auth::user()->KOJIGYOSYA_CD);
        }
        $value = $data1->first();
        //set data
        $data[$cnn]['IRAI_ID'] = $value->IRAI_ID;
        $data[$cnn]['MOKUTEKI'] = $value->MOKUTEKI;
        if ($value->ANSWER_CD == '') {
            $value->ANSWER_CD = "00";
        }
        $data[$cnn]['ANSWER_CD'] = $value->ANSWER_CD;
        $data[$cnn]['KBNMSAI_NAME'] = $value->KBNMSAI_NAME;
        $data[$cnn]['GYOSYA_ANS_YMD'] = $value->GYOSYA_ANS_YMD;
        $data[$cnn]['KINKYUTAIO_FLG'] = $value->KINKYUTAIO_FLG;                        
        $data[$cnn]['HANSU'] = $value->HANSU;
        $data[$cnn]['CYUMONSYA_NAME'] = $value->CYUMONSYA_NAME;
        $data[$cnn]['SETSAKI_NAME'] = $value->SETSAKI_NAME;
        $data[$cnn]['SETSAKI_KNAME'] = $value->SETSAKI_KNAME;
        $data[$cnn]['KOJIGYOSYA_NAME'] = $value->KOJIGYOSYA_NAME;
        $data[$cnn]['TENPO_NAME'] = $value->TENPO_NAME;
        $data[$cnn]['SETSAKI_POSTNO'] = $value->SETSAKI_POSTNO;
        $data[$cnn]['SETSAKI_ADDRESS'] = $value->SETSAKI_ADDRESS;
        $data[$cnn]['SETSAKI_TELNO'] = $value->SETSAKI_TELNO;
        $data[$cnn]['KISETSU_TEL'] = $value->KISETSU_TEL;
        $data[$cnn]['KOMOKU_SENTAKUSI'] = $value->KOMOKU_SENTAKUSI;
        $data[$cnn]['KIJIRAN_PATH'] = $value->KIJIRAN_PATH;
        //YMD1
        $date_now = date('Y-m-d');
        if($value->MOKUTEKI == '下見'){
            if(strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                $data[$cnn]['KIBO_YMD1'] = '';
            else
                $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
        }else{
            if(date('H:i') < '14:00'){
                if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                    $data[$cnn]['KIBO_YMD1'] = '';
                else{
                    $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                }
            }
            else{
                if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                    $data[$cnn]['KIBO_YMD1'] = '';
                else{
                    $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                }
            } 
        }
        //END YMD1
        //YMD2
        $date_now = date('Y-m-d');
        if($value->MOKUTEKI == '下見'){
            if(strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                $data[$cnn]['KIBO_YMD2'] = '';
            else
                $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
        }else{
            if(date('H:i') < '14:00'){
                if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                    $data[$cnn]['KIBO_YMD2'] = '';
                else{
                    $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                }
            }
            else{
                if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                    $data[$cnn]['KIBO_YMD2'] = '';
                else{
                    $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                }
            } 
        }
        //END YMD1   
        //YMD1
        $date_now = date('Y-m-d');
        if($value->MOKUTEKI == '下見'){
            if(strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                $data[$cnn]['KIBO_YMD3'] = '';
            else
                $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
        }else{
            if(date('H:i') < '14:00'){
                if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                    $data[$cnn]['KIBO_YMD3'] = '';
                else{
                    $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                }
            }
            else{
                if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                    $data[$cnn]['KIBO_YMD3'] = '';
                else{
                    $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                }
            } 
        }
        //END YMD1
        $data[$cnn]['COMMENT1'] = $value->COMMENT1;
        $data[$cnn]['COMMENT2'] = $value->COMMENT2;
        return view('detail', compact('data','hansu'));
    }
    public function post_search_print(Request $request)
    {
        if(session()->has('data_list_checkbox')){
            if( empty(session()->get('data_list_checkbox')) )
                return redirect()->route('list');
        }
        if($request->session()->get('field_sort') == 'KBNMSAI_NAME1')
            $field_sort         = 'KBNMSAI_NAME';
        else
            $field_sort         =  $request->session()->get('field_sort');
        $query_sort             =  $request->session()->get('query_sort');
        $data = array();
        if(session()->has('data_list_checkbox')){
            $check_box = session()->get('data_list_checkbox');
        } 
        switch ($request->submit) {
            case 'submit_export':
                $request->session()->put('list_csv',$request->check_box_list);
                return redirect()->route('export');
                break;
            case 'submit_print':    
                $cnn = 0;             
                $id = [];
                $hansu = [];
                foreach ($check_box as $val) {
                    $list = explode('-', $val);
                    $id[] =  $list[0];
                    $hansu[] =  $list[1];                
                }
                $datas = DB::table('T_IRAI')
                    ->join('M_KBN_WEB', 'M_KBN_WEB.KBNMSAI_CD', '=', 'T_IRAI.JYOKYO_CD')
                    ->whereIn('T_IRAI.IRAI_ID', $id)
                    ->where('M_KBN_WEB.DEL_FLG', 0)
                    ->where('KBN_CD', 01);                 
                    if(Auth::user()->KOJIGYOSYA_CD != '') {
                        $datas->where('T_IRAI.KOJIGYOSYA_CD', Auth::user()->KOJIGYOSYA_CD);
                    }
                    $datas = $datas->orderBy('JYOKYO_CD','ASC')
                                    ->orderBy($field_sort,$query_sort)
                                    ->orderBy('IRAI_ID','ASC')
                                    ->orderBy('HANSU','DESC')
                                    ->get();
                foreach ($datas as $key=>$value) {
                    $chk = $value->IRAI_ID.'-'.$value->HANSU;
                    if(in_array($chk, $check_box)){
                        $data[$cnn]['IRAI_ID'] = $value->IRAI_ID;
                        $data[$cnn]['MOKUTEKI'] = $value->MOKUTEKI;
                        $data[$cnn]['ANSWER_CD'] = $value->ANSWER_CD;
                        $data[$cnn]['KBNMSAI_NAME'] = $value->KBNMSAI_NAME;
                        $data[$cnn]['GYOSYA_ANS_YMD'] = $value->GYOSYA_ANS_YMD;
                        $data[$cnn]['KINKYUTAIO_FLG'] = $value->KINKYUTAIO_FLG;                        
                        $data[$cnn]['HANSU'] = $value->HANSU;
                        $data[$cnn]['CYUMONSYA_NAME'] = $value->CYUMONSYA_NAME;
                        $data[$cnn]['SETSAKI_NAME'] = $value->SETSAKI_NAME;
                        $data[$cnn]['SETSAKI_KNAME'] = $value->SETSAKI_KNAME;
                        $data[$cnn]['KOJIGYOSYA_NAME'] = $value->KOJIGYOSYA_NAME;
                        $data[$cnn]['TENPO_NAME'] = $value->TENPO_NAME;
                        $data[$cnn]['SETSAKI_POSTNO'] = $value->SETSAKI_POSTNO;
                        $data[$cnn]['SETSAKI_ADDRESS'] = $value->SETSAKI_ADDRESS;
                        $data[$cnn]['SETSAKI_TELNO'] = $value->SETSAKI_TELNO;
                        $data[$cnn]['KISETSU_TEL'] = $value->KISETSU_TEL;
                        $data[$cnn]['KOMOKU_SENTAKUSI'] = $value->KOMOKU_SENTAKUSI;
                        //YMD1
                        $date_now = date('Y-m-d');
                        if($value->MOKUTEKI == '下見'){
                            if(strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                                $data[$cnn]['KIBO_YMD1'] = '';
                            else
                                $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                        }else{
                            if(date('H:i') < '14:00'){
                                if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                                    $data[$cnn]['KIBO_YMD1'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                                }
                            }
                            else{
                                if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                                    $data[$cnn]['KIBO_YMD1'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                                }
                            } 
                        }
                        //END YMD1
                        //YMD2
                        $date_now = date('Y-m-d');
                        if($value->MOKUTEKI == '下見'){
                            if(strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                                $data[$cnn]['KIBO_YMD2'] = '';
                            else
                                $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                        }else{
                            if(date('H:i') < '14:00'){
                                if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                                    $data[$cnn]['KIBO_YMD2'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                                }
                            }
                            else{
                                if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                                    $data[$cnn]['KIBO_YMD2'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                                }
                            } 
                        }
                        //END YMD1   
                        //YMD1
                        $date_now = date('Y-m-d');
                        if($value->MOKUTEKI == '下見'){
                            if(strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                                $data[$cnn]['KIBO_YMD3'] = '';
                            else
                                $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                        }else{
                            if(date('H:i') < '14:00'){
                                if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                                    $data[$cnn]['KIBO_YMD3'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                                }
                            }
                            else{
                                if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                                    $data[$cnn]['KIBO_YMD3'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                                }
                            } 
                        }
                        //END YMD1
                        $data[$cnn]['KIJIRAN_PATH'] = $value->KIJIRAN_PATH;
                        $data[$cnn]['COMMENT1'] = $value->COMMENT1;
                        $data[$cnn]['COMMENT2'] = $value->COMMENT2;
                        $cnn++;
                    }
                }
                return view('print', compact('data'));

            case 'submit_detail': 
                $cnn = 0;             
                $id = [];
                $hansu = [];
                foreach ($check_box as $val) {
                    $list = explode('-', $val);
                    $id[] =  $list[0];
                    $hansu[] =  $list[1];                
                }
                $datas = DB::table('T_IRAI')
                    ->join('M_KBN_WEB', 'M_KBN_WEB.KBNMSAI_CD', '=', 'T_IRAI.JYOKYO_CD')
                    ->whereIn('T_IRAI.IRAI_ID', $id)
                    ->where('M_KBN_WEB.DEL_FLG', 0)
                    ->where('KBN_CD', 01);                 
                    if(Auth::user()->KOJIGYOSYA_CD != '') {
                        $datas->where('T_IRAI.KOJIGYOSYA_CD', Auth::user()->KOJIGYOSYA_CD);
                    }
                    $datas = $datas->orderBy('JYOKYO_CD','ASC')
                                    ->orderBy($field_sort,$query_sort)
                                    ->orderBy('IRAI_ID','ASC')
                                    ->orderBy('HANSU','DESC')
                                    ->get();
                foreach ($datas as $key=>$value) {
                    $chk = $value->IRAI_ID.'-'.$value->HANSU;
                    if(in_array($chk, $check_box)){
                        $data[$cnn]['IRAI_ID'] = $value->IRAI_ID;
                        $data[$cnn]['MOKUTEKI'] = $value->MOKUTEKI;
                        if ($value->ANSWER_CD == '') {
                            $value->ANSWER_CD = "00";
                        }
                        $data[$cnn]['ANSWER_CD'] = $value->ANSWER_CD;
                        $data[$cnn]['KBNMSAI_NAME'] = $value->KBNMSAI_NAME;
                        $data[$cnn]['GYOSYA_ANS_YMD'] = $value->GYOSYA_ANS_YMD;
                        $data[$cnn]['KINKYUTAIO_FLG'] = $value->KINKYUTAIO_FLG;                        
                        $data[$cnn]['HANSU'] = $value->HANSU;
                        $data[$cnn]['CYUMONSYA_NAME'] = $value->CYUMONSYA_NAME;
                        $data[$cnn]['SETSAKI_NAME'] = $value->SETSAKI_NAME;
                        $data[$cnn]['SETSAKI_KNAME'] = $value->SETSAKI_KNAME;
                        $data[$cnn]['KOJIGYOSYA_NAME'] = $value->KOJIGYOSYA_NAME;
                        $data[$cnn]['TENPO_NAME'] = $value->TENPO_NAME;
                        $data[$cnn]['SETSAKI_POSTNO'] = $value->SETSAKI_POSTNO;
                        $data[$cnn]['SETSAKI_ADDRESS'] = $value->SETSAKI_ADDRESS;
                        $data[$cnn]['SETSAKI_TELNO'] = $value->SETSAKI_TELNO;
                        $data[$cnn]['KISETSU_TEL'] = $value->KISETSU_TEL;
                        $data[$cnn]['KOMOKU_SENTAKUSI'] = $value->KOMOKU_SENTAKUSI;
                        $data[$cnn]['KIJIRAN_PATH'] = $value->KIJIRAN_PATH;
                        //YMD1
                        $date_now = date('Y-m-d');
                        if($value->MOKUTEKI == '下見'){
                            if(strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                                $data[$cnn]['KIBO_YMD1'] = '';
                            else
                                $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                        }else{
                            if(date('H:i') < '14:00'){
                                if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                                    $data[$cnn]['KIBO_YMD1'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                                }
                            }
                            else{
                                if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                                    $data[$cnn]['KIBO_YMD1'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD1'] = $value->KIBO_YMD1;
                                }
                            } 
                        }
                        //END YMD1
                        //YMD2
                        $date_now = date('Y-m-d');
                        if($value->MOKUTEKI == '下見'){
                            if(strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                                $data[$cnn]['KIBO_YMD2'] = '';
                            else
                                $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                        }else{
                            if(date('H:i') < '14:00'){
                                if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                                    $data[$cnn]['KIBO_YMD2'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                                }
                            }
                            else{
                                if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                                    $data[$cnn]['KIBO_YMD2'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD2'] = $value->KIBO_YMD2;
                                }
                            } 
                        }
                        //END YMD1   
                        //YMD1
                        $date_now = date('Y-m-d');
                        if($value->MOKUTEKI == '下見'){
                            if(strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                                $data[$cnn]['KIBO_YMD3'] = '';
                            else
                                $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                        }else{
                            if(date('H:i') < '14:00'){
                                if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                                    $data[$cnn]['KIBO_YMD3'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                                }
                            }
                            else{
                                if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                                    $data[$cnn]['KIBO_YMD3'] = '';
                                else{
                                    $data[$cnn]['KIBO_YMD3'] = $value->KIBO_YMD3;
                                }
                            } 
                        }
                        //END YMD1
                        $data[$cnn]['COMMENT1'] = $value->COMMENT1;
                        $data[$cnn]['COMMENT2'] = $value->COMMENT2;
                        $cnn++;
                    }
                }
                return view('detail', compact('data'));
            default:
                break;
        }
    }
    public function postUpdate(Request $rq){  
        $date = New \DateTime();  
        $date = $date->format('Y-m-d H:i:s');        
        $count = 0;
        $T_IRAI_ID = $rq->IRAI_ID;
            
        if (Auth::user()->KOJIGYOSYA_CD == '') {
        # code...
            foreach ($T_IRAI_ID as $row) {
                # code...
                $T_IRAI_old = T_IRAI::where('IRAI_ID',$row)->where('HANSU',$rq->hansu[$count])->first();
                if ( $T_IRAI_old->COMMENT2 !=  $rq->COMMENT1[$count]) {
                    $T_IRAI = T_IRAI::where('IRAI_ID',$row)->where('HANSU',$rq->hansu[$count])
                                        ->update([
                                            'COMMENT1' => $rq->COMMENT1[$count],
                                            'UPD_YMD' => $date,
                                            'UPD_TANTCD' => Auth::user()->TANT_CD,
                                        ]); 
                }
                $count++;
            }
        }else{            
            foreach ($T_IRAI_ID as $row) {
                # code... 
                $JYOKYO_CD = '';  
                if (!isset($rq->radiox[$count])){
                    $JYOKYO_CD = "";
                }elseif ($rq->radiox[$count] == "08") {
                    $JYOKYO_CD = "01";
                }
                else{
                    $JYOKYO_CD = "02";
                }
                $ANSWER_CD = isset($rq->radiox[$count]) ? $rq->radiox[$count] : '';
                $T_IRAI_old = T_IRAI::where('IRAI_ID',$row)->where('HANSU',$rq->hansu[$count])->first();
                if ( $T_IRAI_old->COMMENT2 !=  $rq->COMMENT2[$count] || $T_IRAI_old->ANSWER_CD != $ANSWER_CD) {
                    # code...
                    $T_IRAI = T_IRAI::where('IRAI_ID',$row)->where('HANSU',$rq->hansu[$count])
                                    ->update([
                                        'COMMENT2' => $rq->COMMENT2[$count],
                                        'GYOSYA_ANS_YMD' => $date,
                                        'JYOKYO_CD' => $JYOKYO_CD,
                                        'ANSWER_CD' => $ANSWER_CD,
                                        'UPD_YMD' => $date,
                                        'UPD_TANTCD' => Auth::user()->TANT_CD,
                                    ]);                
                }    
                $count++;            
            }
        }            
        return redirect()->route('list');
    }
}