<?php

namespace App\Http\Controllers;

use Auth; //use thư viện auths
use DB;
use view;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
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
    private function getSQLHACYU($lists_id){
        $query = DB::table('T_HACYU')
        ->select(
        'T_HACYU.HACYU_ID',
        'T_HACYU.IRAI_DAY',
        DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.IRAI_CD AND M_KBN_WEB.KBN_CD = '00' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS IRAI_CD_NAME"),
        DB::raw("(SELECT KBNMSAI_BIKO FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.IRAI_CD AND M_KBN_WEB.KBN_CD = '00' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS IRAI_COLOR"),      
        DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.STS_CD AND M_KBN_WEB.KBN_CD = '03' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS STS_CD_NAME"),       
        'T_HACYU.HACYUSAKI_NAME',
        'T_HACYU.TAIO_CD',       
        DB::raw("(SELECT TANT_NAME FROM M_TANT_WEB WHERE M_TANT_WEB.TANT_CD = '90001' AND M_TANT_WEB.DEL_FLG = 0 LIMIT 1) AS TAIO_TANT_NAME"),
        'T_HACYU.CO_NAME',
        'T_HACYU.CO_POSTNO',
        'T_HACYU.CO_ADDRESS',
        'T_HACYU.CO_TELNO',
        'T_HACYU.CO_FAX',
        'T_HACYU.CO_TANT_NAME',
        'T_HACYU.NONYUSAKI_POSTNO',
        'T_HACYU.NONYUSAKI_NAME',
        'T_HACYU.NONYUSAKI_ADDRESS',
        'T_HACYU.NONYUSAKI_TELNO',
        'T_HACYU.NONYUSAKI_TANT_NAME',
        'T_HACYU.KENMEI',
        'T_HACYU.IRAI_YMD_NAME',
        'T_HACYU.IRAI_YMD',
        'T_HACYU.MESSAGE',
        'T_HACYU.COMMENT1',
        'T_HACYU.COMMENT2',
        'T_HACYU.HAISO_SYBET_CD',
        'T_HACYU.IRAI_CD',
        'T_HACYU.HAISOGYOSYA1',
        'T_HACYU.DENPYONO1',
        'T_HACYU.HAISOGYOSYA2',
        'T_HACYU.DENPYONO2',        
        'T_HACYU.RENRAKUSAKI2',
        'T_HACYU.HAISOGYOSYA_MULTI_FLG',
        'T_HACYU.HAISOGYOSYA3_1_LABEL',
        'T_HACYU.HAISOGYOSYA3_2_LABEL',
        'T_HACYU.HAISOGYOSYA3_1',
        'T_HACYU.DENPYONO3_1',
        'T_HACYU.HAISOGYOSYA3_2',
        'T_HACYU.DENPYONO3_2',
        'T_HACYU.DRIVER_NAME',
        'T_HACYU.RENRAKUSAKI4',
        'T_HACYU.NO_DENPYO_FLG',
        'T_HACYU.BIKO', 
        'T_HACYU.SYOKEI',
        'T_HACYU.SORYO',
        'T_HACYU.SYOHIZEI',
        'T_HACYU.SUM',
        'T_HACYU.NEBIKI_SUM',
        'T_HACYU.PDF_PATH',
        'T_HACYU.EXCEL_PATH',        
          
        )
        ->where(['T_HACYU.DEL_FLG'=> 0,'T_HACYU.VISIVLE_FLG'=>1])
        ->whereIn('T_HACYU.HACYU_ID', $lists_id);
        return $query;
    }


    private function getDataHACYUMSAI($id){
        $query = DB::table('T_HACYUMSAI')
        ->select(
        'T_HACYUMSAI.HACYUMSAI_ID',
        'T_HACYUMSAI.SPLIT_NO',
        'T_HACYUMSAI.CTGORY',
        'T_HACYUMSAI.MAKER',
        'T_HACYUMSAI.HINBAN',
        'T_HACYUMSAI.TANKA',
        'T_HACYUMSAI.SURYO',
        'T_HACYUMSAI.KINGAK',
        'T_HACYUMSAI.SIKIRI_RATE',
        'T_HACYUMSAI.NEBIKI_TANKA',
        'T_HACYUMSAI.NEBIKI_GAK',
        'T_HACYUMSAI.NEBIKI_YM',
        'T_HACYUMSAI.NOHIN_KIBO_YMD',
        'T_HACYUMSAI.BIKO',
        'T_HACYUMSAI.KAITO_NOKI',
        'T_HACYUMSAI.NOHIN_YMD',
        'T_HACYUMSAI.NYUKA_ID'          
        )
        ->where(['T_HACYUMSAI.DEL_FLG'=> 0])
        ->where('T_HACYUMSAI.HACYU_ID', $id);
        return $query->get();
    }

    private function getDataFILE($id){
        $query = DB::table('T_FILE')
        ->select(
        'T_FILE.FILE_NAME',
        'T_FILE.FILE_PATH',
        'M_TANT_WEB.HACYUSAKI_CD'
        )
        ->join('M_TANT_WEB', 'M_TANT_WEB.TANT_CD', '=', 'T_FILE.TANT_CD' )
        ->where(['T_FILE.DEL_FLG'=> 0])
        ->where('T_FILE.HACYU_ID', $id);
        return $query->get();
    }    


    private function deliveryCompany(){
        // 配送業者
        $query = DB::table('M_KBN_WEB')
        ->where('KBN_CD','05')
        ->where('DEL_FLG', 0);

        $delivery_company = $query->get(); 
        return $delivery_company;
    }

    public function search_print($id)
    {
        $sourceName = 'ライフワン担当';
        if(Auth::user()->HACYUSAKI_CD != ''){
            $sourceName = '仕入先様名';
        }
        $deliveryCompany = $this->deliveryCompany();
        $data = array();
        $query = $this->getSQLHACYU(array($id));
        $data = $query->get();               
        foreach($data as &$item){
            $detail = $this->getDataHACYUMSAI($item->HACYU_ID);
            $item->HACYUMSAI = $detail;
            $item->FILE = $this->getDataFILE($item->HACYU_ID);
        } 
        return view('detail', compact('deliveryCompany', 'data', 'sourceName'));
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
        $lists_checkboxID = array();
        $check_box_list = $request->check_box_list;
        foreach($check_box_list as $key => $value){
            $lists_checkboxID[] = substr($value,0,strpos($value,'-'));
        }
        switch ($request->submit) {
            case 'submit_export':
                $request->session()->put('list_csv',$request->check_box_list);
                $this->__updateStatus($lists_checkboxID);
                return redirect()->route('export');
                break;
            case 'submit_print_pdf':
            case 'submit_print_excel':
                $this->__updateStatus($lists_checkboxID);
                return redirect()->route('list');
                break;
            case 'submit_detail': 
                $sourceName = 'ライフワン担当';
                if(Auth::user()->HACYUSAKI_CD != ''){
                    $sourceName = '仕入先様名';
                }
                $deliveryCompany = $this->deliveryCompany();
                $data = array();
                $query = $this->getSQLHACYU($lists_checkboxID);
                $data = $query->get();
                foreach($data as &$item){
                    $detail = $this->getDataHACYUMSAI($item->HACYU_ID);
                    $item->HACYUMSAI = $detail;
                    $item->FILE = $this->getDataFILE($item->HACYU_ID);
                }                 
                return view('detail', compact('deliveryCompany','data', 'sourceName'));
            default:
                break;
        }
    }

    private function __updateStatus($listID){
        DB::table('T_HACYU')
           ->whereIn('HACYU_ID',$listID)
           ->where('STS_CD', '01')
           ->update(['STS_CD' => '02']);
    }

    public function postUpdate(Request $request){  
        $date = New \DateTime();  
        $date = $date->format('Y-m-d H:i:s');
        $data = $request->data;

        $user = Auth::user();
        foreach($data as $key => $value){
            $HACYU_ID = $key;
            $HACYU = $value;
            $details = $value['DETAIL'];
            unset($HACYU['DETAIL']);
            $files = array();
            if (isset($value['FILE'])){
                $files = $value['FILE'];
                unset($HACYU['FILE']);
            }
            
            if (isset($HACYU['NO_DENPYO_FLG']) && $HACYU['NO_DENPYO_FLG'] == 'on'){
                $HACYU['NO_DENPYO_FLG'] = 1;
            }else{
                $HACYU['NO_DENPYO_FLG'] = 0;
            }
            $HACYU['UPD_TANTCD'] = $user->TANT_CD;
            $HACYU['UPD_YMD'] = $date;
            DB::table('T_HACYU')->where('HACYU_ID',$HACYU_ID)->update($HACYU);

            foreach($details as $k => $v){
                $HACYUMSAI = $v;
                $HACYUMSAI_ID = $k;
                if (isset($HACYUMSAI['SURYO']) && $HACYUMSAI['SURYO'] == ''){
                    $HACYUMSAI['SURYO'] = 0;
                }
                if (isset($HACYUMSAI['KAITO_NOKI']) && $HACYUMSAI['KAITO_NOKI'] == ''){
                    unset($HACYUMSAI['KAITO_NOKI']);
                }elseif (isset($HACYUMSAI['KAITO_NOKI']) && $HACYUMSAI['KAITO_NOKI'] != ''){
                    $HACYUMSAI['KAITO_NOKI'] = str_replace('/', '-', $HACYUMSAI['KAITO_NOKI']);
                }
                if (isset($HACYUMSAI['NOHIN_YMD']) && $HACYUMSAI['NOHIN_YMD'] == ''){
                    unset($HACYUMSAI['NOHIN_YMD']);
                }elseif (isset($HACYUMSAI['NOHIN_YMD']) && $HACYUMSAI['NOHIN_YMD'] != ''){
                    $HACYUMSAI['NOHIN_YMD'] = str_replace('/', '-', $HACYUMSAI['NOHIN_YMD']);
                }   
                $HACYUMSAI['UPD_TANTCD'] = $user->TANT_CD;
                $HACYUMSAI['UPD_YMD'] = $date;             

                DB::table('T_HACYUMSAI')
                ->where('HACYU_ID',$HACYU_ID)
                ->where('HACYUMSAI_ID',$HACYUMSAI_ID)
                ->update($HACYUMSAI);
            }
            if (isset($value['FILE'])){
                $a = 1;
                foreach($files as $key => $item){               
                    //Start of Upload Files
                    $fileName = time(). rand(1111,
                                9999) . '.' . $item->getClientOriginalExtension();
                    $path = './uploads';
                    $item->move($path, $fileName);
                    DB::table('T_FILE')->insert([
                        'HACYU_ID' => $HACYU_ID,
                        'JYUNJO' => $a,
                        'FILE_NAME' => $fileName,
                        'FILE_PATH' => $path.'/'.$fileName,
                        'TANT_CD' => $user->TANT_CD,
                        'UPD_TANTCD' => $user->TANT_CD,
                        'UPD_YMD' => $date
                    ]);                
                    $a++;
                }  
            }
        }
        return redirect()->route('list');
    }
}