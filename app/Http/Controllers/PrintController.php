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
        DB::raw("(SELECT TANT_NAME FROM M_TANT_WEB WHERE M_TANT_WEB.TANT_CD = T_HACYU.TAIO_TANT_CD AND M_TANT_WEB.DEL_FLG = 0 LIMIT 1) AS TAIO_TANT_NAME"),
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
        'T_HACYU.STS_CD'
        )
        ->where(['T_HACYU.DEL_FLG'=> 0,'T_HACYU.VISIVLE_FLG'=>1])
        ->whereIn('T_HACYU.HACYU_ID', $lists_id);
        return $query;
    }


    private function getOneSQLHACYU($id){
        $query = DB::table('T_HACYU')
        ->select(
        'T_HACYU.HACYU_ID',
        'T_HACYU.IRAI_DAY',
        'T_HACYU.STS_CD',
        'T_HACYU.HACYU_SYBET_CD',
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
        'T_HACYU.TAIO_CD'
        )
        ->where(['T_HACYU.DEL_FLG'=> 0,'T_HACYU.VISIVLE_FLG'=>1])
        ->where('T_HACYU.HACYU_ID', $id);

        $data = $query->first();
        return $data;
    }

    private function getDataOneHACYUMSAI($id, $id_detail, $no = 1){
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
        ->where('T_HACYUMSAI.HACYU_ID', $id)
        ->where('T_HACYUMSAI.HACYUMSAI_ID', $id_detail)
        ->where('T_HACYUMSAI.SPLIT_NO', $no);
        return $query->first();
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
        ->where('T_HACYUMSAI.HACYU_ID', $id)
        ->orderBy('T_HACYUMSAI.HACYUMSAI_ID', 'asc')
        ->orderBy('T_HACYUMSAI.SPLIT_NO', 'asc');
        return $query->get();
    }

    private function getMaxSPLITNO($id){
        $query = DB::table('T_HACYUMSAI')
        ->select(
        DB::raw("MAX(T_HACYUMSAI.SPLIT_NO) AS SPLIT_NO")   
        )
        ->where(['T_HACYUMSAI.DEL_FLG'=> 0])
        ->where('T_HACYUMSAI.HACYUMSAI_ID', $id)
        ->groupBy('T_HACYUMSAI.HACYUMSAI_ID');

        $rs = $query->first();
        $no = 0;
        if (!empty($rs)){
            $no  = (int)$rs->SPLIT_NO;
        }
        return $no;
    }    

    private function getDataFILE($id){
        $query = DB::table('T_FILE')
        ->select(
        'T_FILE.ID',
        'T_FILE.FILE_NAME',
        'T_FILE.FILE_PATH',
        'M_TANT_WEB.HACYUSAKI_CD'
        )
        ->join('M_TANT_WEB', 'M_TANT_WEB.TANT_CD', '=', 'T_FILE.TANT_CD' )
        ->where(['T_FILE.DEL_FLG'=> 0])
        ->where('T_FILE.HACYU_ID', $id);
        return $query->get();
    }

    private function getDriverInfo(){
        $query = DB::table('M_KBN_WEB')
        ->select(
        'M_KBN_WEB.KBNMSAI_CD',
        'M_KBN_WEB.KBNMSAI_NAME'
        )
        ->where(['M_KBN_WEB.DEL_FLG'=> 0])
        ->where('M_KBN_WEB.KBN_CD', '05');
        $data =  $query->get();
        $arr = array();
        foreach ($data as $value) { 
           $arr[$value->KBNMSAI_CD] = $value->KBNMSAI_NAME;          
        }
        return $arr;
    } 


    private function deliveryCompany(){
        // 配送業者
        $query = DB::table('M_KBN_WEB')
        ->where('KBN_CD','05')
        ->where('DEL_FLG', 0);

        $delivery_company = $query->get(); 
        return $delivery_company;
    }

    private function displayData($list_id){
        $sourceName = 'ライフワン担当';
        $isUserLifeOne = true;
        if(Auth::user()->HACYUSAKI_CD != ''){
            $sourceName = '仕入先様名';
            $isUserLifeOne = false;
        }       
        $deliveryCompany = $this->deliveryCompany();
        $data = array();
        $query = $this->getSQLHACYU($list_id);
        $data = $query->get();
        foreach($data as &$item){
            $detail = $this->getDataHACYUMSAI($item->HACYU_ID);
            $item->HACYUMSAI = $detail;
            $item->FILE = $this->getDataFILE($item->HACYU_ID);
        }
        $hasSTS01Load = false;  
        if(session()->has('hasSTS01')){           
            $hasSTS01Load = true;
            session()->forget('hasSTS01');
        }        
        return compact('deliveryCompany', 'data', 'sourceName', 'isUserLifeOne' ,'hasSTS01Load'); 
    }

    public function search_print($id)
    {
         $item = $this->displayData(array($id));
         return view('detail', $item); 
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
                $item = $this->displayData($lists_checkboxID);
                return view('detail', $item); 
                break;
            default:
                break;
        }
    }

    public function get_search_print()
    {
        if(session()->has('data_list_checkbox')){
            if( empty(session()->get('data_list_checkbox')) )
                return redirect()->route('list');
        }
        $data               = [];
        $lists_checkboxID   = [];        
        if(session()->has('data_list_checkbox')){
            $data = session()->get('data_list_checkbox');
        }
        
        foreach($data as $key => $value){
            $lists_checkboxID[] = substr($value,0,strpos($value,'-'));
        }
        $item = $this->displayData($lists_checkboxID);
        return view('detail', $item); 
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
        $HACYU_ID = '0';
        $hasSTS01 = false;

        // echo '<pre>',print_r($data,1),'</pre>';
        // die;

        if (isset($request->submit) && $request->submit == 'delete_file'){
            foreach($data as $key => $value){
                $delete_files = '';
                $HACYU_ID = $key;
                if (!empty($value['FILE_DELETE'])){
                    $delete_files = $value['FILE_DELETE'];                
                }
                if ($delete_files !== ''){
                    $arrFiles = explode(',', $delete_files);
                    $TFILE = array();
                    $TFILE['DEL_FLG'] = 1;
                    $TFILE['UPD_TANTCD'] = $user->TANT_CD;
                    $TFILE['UPD_YMD'] = $date;
                    DB::table('T_FILE')
                    ->whereIn('ID',$arrFiles)
                    ->update($TFILE);
                }
            }           
        }elseif(isset($request->submit) && $request->submit == 'submit_export'){
            $lists_checkboxID = array();
            $lists_checkboxID2 = array();
            foreach($data as $key => $value){
                $lists_checkboxID[] = $key; 
                $lists_checkboxID2[] = $key.'-0';
            }
            $request->session()->put('list_csv',$lists_checkboxID2);
            $this->__updateStatus($lists_checkboxID);
            return redirect()->route('export');
        }elseif(isset($request->submit) && ($request->submit == 'submit_print_pdf' || $request->submit == 'submit_print_excel' || $request->submit == 'order_sale')){
            $lists_checkboxID = array();
            foreach($data as $key => $value){
                $lists_checkboxID[] = $key;                
            }            
            $this->__updateStatus($lists_checkboxID);
            return redirect()->route('list');
        }else{
            $arrDriverName = $this->getDriverInfo();
            foreach($data as $key => $value){
                $HACYU_ID = $key;
                $HACYU = $value;
                $details = array();
                $dataUpdate = array();
                $driverChange = false;
                if (isset($value['DETAIL'])){
                   $details = $value['DETAIL'];
                   unset($HACYU['DETAIL']);
                }            
                
                $files = array();
                if (isset($value['FILE'])){
                    $files = $value['FILE'];
                    unset($HACYU['FILE']);
                }

                unset($HACYU['FILE_DELETE']);

                if (isset($HACYU['NO_DENPYO_FLG']) && $HACYU['NO_DENPYO_FLG'] == 'on'){
                    $HACYU['NO_DENPYO_FLG'] = 1;
                }else{
                    $HACYU['NO_DENPYO_FLG'] = 0;
                }

                $oldData = $this->getOneSQLHACYU($HACYU_ID);
                $arrDateNoHin = array();

                if($user->HACYUSAKI_CD != ''){
                    if (isset($value['TAIO_CD1'])){
                       unset($HACYU['TAIO_CD1']);
                    }
                    if (isset($value['TAIO_CD2'])){
                       unset($HACYU['TAIO_CD2']);
                    }                    
                    if (isset($value['COMMENT1'])){
                       unset($HACYU['COMMENT1']);
                    }
                    $comment2 = $oldData->COMMENT2;
                    if (!empty(trim($HACYU['COMMENT2'])) && trim($HACYU['COMMENT2']) != trim($oldData->COMMENT2)){
                        $comment2 = '【'.date('Y/m/d H:i').'】' . $HACYU['COMMENT2'];
                    }elseif(empty(trim($HACYU['COMMENT2']))){
                        $comment2 = '';
                    }

                    foreach($details as $k => $v){
                        $HACYUMSAI = $v;
                        $arrData = explode('-', $k);
                        $HACYUMSAI_ID = $arrData[0];
                        $HACYUMSAI['SPLIT_NO'] = $arrData[1];

                        $oddDetail = $this->getDataOneHACYUMSAI($HACYU_ID, $HACYUMSAI_ID, $HACYUMSAI['SPLIT_NO']);

                        if (isset($HACYUMSAI['SURYO']) && $HACYUMSAI['SURYO'] == ''){
                            $HACYUMSAI['SURYO'] = 0;
                        }
                        if (isset($HACYUMSAI['KAITO_NOKI']) && $HACYUMSAI['KAITO_NOKI'] == ''){
                            unset($HACYUMSAI['KAITO_NOKI']);
                        }elseif (isset($HACYUMSAI['KAITO_NOKI']) && $HACYUMSAI['KAITO_NOKI'] != ''){
                            $HACYUMSAI['KAITO_NOKI'] = str_replace('/', '-', $HACYUMSAI['KAITO_NOKI']);
                            $arrDateNoHin[] = $HACYUMSAI['KAITO_NOKI'];
                        }
                        if (isset($HACYUMSAI['NOHIN_YMD']) && $HACYUMSAI['NOHIN_YMD'] == ''){
                            unset($HACYUMSAI['NOHIN_YMD']);
                        }elseif (isset($HACYUMSAI['NOHIN_YMD']) && $HACYUMSAI['NOHIN_YMD'] != ''){
                            $HACYUMSAI['NOHIN_YMD'] = str_replace('/', '-', $HACYUMSAI['NOHIN_YMD']);
                            $arrDateNoHin[] = $HACYUMSAI['NOHIN_YMD'];
                        }

                        $dataUpdateDetail = array();
                        $split = false;

                        if($oddDetail->SURYO != $HACYUMSAI['SURYO'] && $HACYUMSAI['SURYO'] > 0){
                            $dataUpdateDetail['SURYO'] = $HACYUMSAI['SURYO'];
                            $dataUpdateDetail['KINGAK'] = $HACYUMSAI['SURYO'] * $oddDetail->TANKA;
                            $dataUpdateDetail['NEBIKI_GAK'] = $HACYUMSAI['SURYO'] * $oddDetail->NEBIKI_TANKA;                            
                            $split = true;                            
                        }

                        if(!empty($HACYUMSAI['KAITO_NOKI']) && $oddDetail->KAITO_NOKI != $HACYUMSAI['KAITO_NOKI']){
                            $dataUpdateDetail['KAITO_NOKI'] = $HACYUMSAI['KAITO_NOKI'];
                        }

                        if(!empty($HACYUMSAI['NOHIN_YMD']) && $oddDetail->NOHIN_YMD != $HACYUMSAI['NOHIN_YMD']){
                            $dataUpdateDetail['NOHIN_YMD'] = $HACYUMSAI['NOHIN_YMD'];
                        }                        

                        if (!empty($dataUpdateDetail)){

                            $dataUpdateDetail['UPD_TANTCD'] = $user->TANT_CD;
                            $dataUpdateDetail['UPD_YMD'] = $date;             

                            DB::table('T_HACYUMSAI')
                            ->where('HACYU_ID',$HACYU_ID)
                            ->where('HACYUMSAI_ID',$HACYUMSAI_ID)
                            ->where('SPLIT_NO',$HACYUMSAI['SPLIT_NO'])
                            ->update($dataUpdateDetail);
                        }
                        $dateNoHinChange = '';                      
                        $dateNoHinOld = '';
                        if ($split){
                            $dataUpdateDetailNew = $dataUpdateDetail;
                            $dataUpdateDetailNew['HACYU_ID'] = $HACYU_ID;
                            $dataUpdateDetailNew['HACYUMSAI_ID'] = $HACYUMSAI_ID;
                            $dataUpdateDetailNew['SPLIT_NO'] = $this->getMaxSPLITNO($HACYUMSAI_ID) + 1;
                            $dataUpdateDetailNew['CTGORY'] = $oddDetail->CTGORY;
                            $dataUpdateDetailNew['MAKER'] = $oddDetail->MAKER;
                            $dataUpdateDetailNew['HINBAN'] = $oddDetail->HINBAN;
                            $dataUpdateDetailNew['TANKA'] = $oddDetail->TANKA;
                            $dataUpdateDetailNew['SIKIRI_RATE'] = $oddDetail->SIKIRI_RATE;
                            $dataUpdateDetailNew['NEBIKI_TANKA'] = $oddDetail->NEBIKI_TANKA;
                            $dataUpdateDetailNew['DEL_FLG'] = 0;
                            $dataUpdateDetail['ADD_TANTCD'] = $user->TANT_CD;
                            $dataUpdateDetail['ADD_YMD'] = $date; 

                            if(empty($dataUpdateDetailNew['KAITO_NOKI'])){
                               $dataUpdateDetailNew['KAITO_NOKI'] = $oddDetail->KAITO_NOKI;
                               $dateNoHinOld = str_replace('-', '/', $dataUpdateDetailNew['KAITO_NOKI']);
                            }else{
                               $dateNoHinChange = str_replace('-', '/', $dataUpdateDetailNew['KAITO_NOKI']);
                            }

                            if(empty($dataUpdateDetailNew['NOHIN_YMD'])){
                               $dataUpdateDetailNew['NOHIN_YMD'] = $oddDetail->NOHIN_YMD;
                               $dateNoHinOld = str_replace('-', '/', $dataUpdateDetailNew['NOHIN_YMD']);
                            }else{
                               $dateNoHinChange = str_replace('-', '/', $dataUpdateDetailNew['NOHIN_YMD']);
                            }                            

                            $new_suryo = $oddDetail->SURYO - $HACYUMSAI['SURYO'];
                            $dataUpdateDetailNew['SURYO'] = $new_suryo;
                            $dataUpdateDetailNew['KINGAK'] = $new_suryo * $oddDetail->TANKA;
                            $dataUpdateDetailNew['NEBIKI_GAK'] = $new_suryo * $oddDetail->NEBIKI_TANKA;
                            DB::table('T_HACYUMSAI')->insert($dataUpdateDetailNew);

                            if (!empty($comment2)){
                                $comment2 .= PHP_EOL;
                            }                            
                            $comment2 .= '【'.date('Y/m/d H:i').'　('.$oddDetail->SURYO.')'.( !empty($dateNoHinChange) ? ':'.$dateNoHinOld : '' ).' → ('.$new_suryo.')'.( !empty($dateNoHinChange) ? ':'.$dateNoHinChange : '' ).'】';
                        }else{
                            if(!empty($HACYUMSAI['KAITO_NOKI']) && $oddDetail->KAITO_NOKI != $HACYUMSAI['KAITO_NOKI']){                               
                                $dateNoHinChange = str_replace('-', '/', $HACYUMSAI['KAITO_NOKI']);
                                $dateNoHinOld = str_replace('-', '/', $oddDetail->KAITO_NOKI);
                            }

                            if(!empty($HACYUMSAI['NOHIN_YMD']) && $oddDetail->NOHIN_YMD != $HACYUMSAI['NOHIN_YMD']){
                                $dateNoHinChange = str_replace('-', '/', $HACYUMSAI['NOHIN_YMD']);
                                $dateNoHinOld = str_replace('-', '/', $oddDetail->NOHIN_YMD);
                            }

                            if (!empty($dateNoHinChange)){
                                if (!empty($comment2)){
                                    $comment2 .= PHP_EOL;
                                }                                
                                $comment2 .= '【'.date('Y/m/d H:i').'　'.$dateNoHinOld.' → '.$dateNoHinChange.'】'; 
                            }                             
                        }

                    }

                    $arrItemChange = array('HAISOGYOSYA1', 'DENPYONO1','HAISOGYOSYA2', 'DENPYONO2', 'RENRAKUSAKI2', 'HAISOGYOSYA3_1', 'DENPYONO3_1', 'HAISOGYOSYA3_2', 'DENPYONO3_2' , 'DRIVER_NAME', 'RENRAKUSAKI4', 'NO_DENPYO_FLG', 'BIKO');
                    $dataChange = array();

                    foreach ($arrItemChange as $itemChange) {
                        if (isset($HACYU[$itemChange]) && $HACYU[$itemChange]  != $oldData->$itemChange){
                        
                            $dataChange[] = $oldData->$itemChange.' → '.$HACYU[$itemChange];
                        }
                    }                                     

                    if(!empty($dataChange)){
                        if (!empty($comment2)){
                            $comment2 .= PHP_EOL;
                        }                         
                        $comment2 .= '【'.date('Y/m/d H:i').'　'.implode(', ', $dataChange).'】';  
                    } 

                    $HACYU['COMMENT2'] = $comment2;
                    $dataUpdate = $HACYU;
                }else{
                    $dataUpdate = array();
                    $TAIO_CD = '';
                    if (isset($HACYU['TAIO_CD1']) && $HACYU['TAIO_CD1'] == 'on'){
                        $TAIO_CD = '01';
                    }
                    if (isset($HACYU['TAIO_CD2']) && $HACYU['TAIO_CD2'] == 'on'){
                        $TAIO_CD = '02';
                    }
                    if ($TAIO_CD != $oldData->TAIO_CD){
                        $dataUpdate['TAIO_CD'] = $TAIO_CD;
                    }
                    if ($HACYU['COMMENT1'] != $oldData->COMMENT1){
                        $dataUpdate['COMMENT1'] = '【'.date('Y/m/d H:i').' '.$user->TANT_NAME.'】' . $HACYU['COMMENT1'];
                    }
                }
                $countNoHin = 0;
                if (!empty($dataUpdate)){
                    if (!empty($arrDateNoHin)){
                        $countNoHin = count(array_count_values($arrDateNoHin));
                    }
                    if (in_array($oldData->STS_CD, array('01', '02', '03', '04'))){
                        if ($countNoHin == 1){
                            if ($oldData->IRAI_CD == '01' || $oldData->IRAI_CD == '02'){
                                $dataUpdate['STS_CD'] = '05';    
                            }elseif ($oldData->IRAI_CD == '03'){
                                if ($oldData->HACYU_SYBET_CD == '04'){
                                    $dataUpdate['STS_CD'] = '06';
                                }else{
                                    $dataUpdate['STS_CD'] = '10';
                                }
                            }
                        }elseif ($countNoHin == count($arrDateNoHin)){
                            $dataUpdate['STS_CD'] = '02';
                        }else{
                            $dataUpdate['STS_CD'] = '03';
                        }
                    
                    }elseif($oldData->STS_CD == '06' && $driverChange){
                        $dataUpdate['STS_CD'] = '07';
                    }
                    $dataUpdate['UPD_TANTCD'] = $user->TANT_CD;
                    $dataUpdate['UPD_YMD'] = $date;
                    DB::table('T_HACYU')->where('HACYU_ID',$HACYU_ID)->update($dataUpdate);
                }

                if (((!empty($dataUpdate['STS_CD']) && $dataUpdate['STS_CD'] != '01') || empty($dataUpdate['STS_CD'])) && $oldData->STS_CD == '01'){
                    $hasSTS01 = true;
                }

                if (isset($value['FILE'])){
                    $a = count($this->getDataFILE($HACYU_ID)) + 1;
                    foreach($files as $key => $item){
                        //Start of Upload Files
                        $fileName = time(). rand(1111,
                                    9999) . '.' . $item->getClientOriginalExtension();
                        $path = './uploads/'.$HACYU_ID;
                        $item->move($path, $fileName);
                        DB::table('T_FILE')->insert([
                            'HACYU_ID' => $HACYU_ID,
                            'JYUNJO' => $a,
                            'FILE_NAME' => $fileName,
                            'FILE_PATH' => '/uploads/'.$HACYU_ID.'/'.$fileName,
                            'TANT_CD' => $user->TANT_CD,
                            'UPD_TANTCD' => $user->TANT_CD,
                            'UPD_YMD' => $date
                        ]);
                        $a++;
                    }  
                }
            }
        }

        if (isset($request->submit) && $request->submit == 'submit_back_list' && !$hasSTS01){
            return redirect()->route('list');
        }else{
            if($hasSTS01){
              $request->session()->put('hasSTS01',1);  
            }            
            if (count($data) > 1){
                return redirect()->route('get_search_print');
            }else{
                return redirect()->route('search_print', array('id' => $HACYU_ID));
            } 
        }
    }
}