<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Auth;
class ExportController extends Controller implements FromCollection, WithHeadings
{
    use Exportable;
    
    public function collection()
    {   
        date_default_timezone_set('Asia/Tokyo');
        $data               = [];
        $lists_checkboxID   = [];
        $lists_HANSU        = [];
        $field_sort         =  session()->get('field_sort');
        $query_sort         =  session()->get('query_sort');
        if(session()->has('list_csv')){
            $data = session()->get('list_csv');
        }
        if(session()->has('data_list_checkbox')){
            $data = session()->get('data_list_checkbox');
        }
        
        foreach($data as $key => $value){
            $lists_checkboxID[] = substr($value,0,strpos($value,'-'));
            $lists_HANSU[]      = substr(strstr($value,'-'), 1);
        }
        $lists = T_IRAI::join('M_KBN_WEB','M_KBN_WEB.KBNMSAI_CD','=','T_IRAI.JYOKYO_CD')
        ->whereIn('T_IRAI.IRAI_ID',$lists_checkboxID)
        ->where(['T_IRAI.DEL_FLG'=>0,'T_IRAI.VISIVLE_FLG'=>1])
        ->where('M_KBN_WEB.KBN_CD',01)
        ->orderBy('JYOKYO_CD','ASC')
        ->orderBy($field_sort,$query_sort)
        ->orderBy('T_IRAI.IRAI_ID','ASC')
        ->orderBy('T_IRAI.HANSU','DESC');
        
        if(Auth::user()->KOJIGYOSYA_CD != ''){
            $lists->where('T_IRAI.KOJIGYOSYA_CD',Auth::user()->KOJIGYOSYA_CD);
        }
        $aray = [];
        $lists = $lists->get();
        foreach($lists as $key => $value){
            if(in_array($value->IRAI_ID."-".$value->HANSU, $data)){
                $KIBO_YMD1 = '';
                $KIBO_YMD2 = '';
                $KIBO_YMD3 = '';
                //YMD1
                $date_now = date('Y-m-d');
                if($value->MOKUTEKI == '下見'){
                    if(strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                        $KIBO_YMD1 = '';
                    else
                        $KIBO_YMD1 = $value->KIBO_YMD1;
                }else{
                    if(date('H:i') < '14:00'){
                        if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                            $KIBO_YMD1 = '';
                        else{
                            $KIBO_YMD1 = $value->KIBO_YMD1;
                        }
                    }
                    else{
                        if( (strtotime($value->KIBO_YMD1) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                            $KIBO_YMD1 = '';
                        else{
                            $KIBO_YMD1 = $value->KIBO_YMD1;
                        }
                    } 
                }
                //END YMD1
                //YMD2
                $date_now = date('Y-m-d');
                if($value->MOKUTEKI == '下見'){
                    if(strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                        $KIBO_YMD2 = '';
                    else
                        $KIBO_YMD2 = $value->KIBO_YMD2;
                }else{
                    if(date('H:i') < '14:00'){
                        if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                            $KIBO_YMD2 = '';
                        else{
                            $KIBO_YMD2 = $value->KIBO_YMD2;
                        }
                    }
                    else{
                        if( (strtotime($value->KIBO_YMD2) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                            $KIBO_YMD2 = '';
                        else{
                            $KIBO_YMD2 = $value->KIBO_YMD2;
                        }
                    } 
                }
                //END YMD2
                //YMD3
                $date_now = date('Y-m-d');
                if($value->MOKUTEKI == '下見'){
                    if(strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days'))))
                        $KIBO_YMD3 = '';
                    else
                        $KIBO_YMD3 = $value->KIBO_YMD3;
                }else{
                    if(date('H:i') < '14:00'){
                        if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 1 days')))))
                            $KIBO_YMD3 = '';
                        else{
                            $KIBO_YMD3 = $value->KIBO_YMD3;
                        }
                    }
                    else{
                        if( (strtotime($value->KIBO_YMD3) <= strtotime(date('Y-m-d', strtotime($date_now. ' + 2 days')))))
                            $KIBO_YMD3 = '';
                        else{
                            $KIBO_YMD3 = $value->KIBO_YMD3;
                        }
                    } 
                }
                //END YMD3
                $aray[] = $lists[$key];
                $data_iraimsai = DB::table('T_IRAIMSAI')->where('IRAI_ID',$value->IRAI_ID)->where('HANSU',$value->HANSU)->get();
                if(count($data_iraimsai) == 0){
                    $lists_csv[] = array(
                        '0'  => $value->MOKUTEKI,
                        '1'  => $value->IRAI_ID,
                        '2'  => $value->CYUMONSYA_NAME,
                        '3'  => $value->SETSAKI_NAME,
                        '4'  => $value->SETSAKI_KNAME,
                        '5'  => $value->SETSAKI_ADDRESS,
                        '6'  => $value->SETSAKI_TELNO,
                        '7'  => $value->TENPO_NAME,
                        '8'  => $value->KOJIGYOSYA_NAME,
                        '9'  => $KIBO_YMD1,
                        '10' => $KIBO_YMD2,
                        '11' => $KIBO_YMD3,
                        '12' => $value->KISETSU_TEL,
                        '13' => $value->KOMOKU_SENTAKUSI,
                        '14' => $value->KIJIRAN,
                        '15' => '',//chua co
                        '16' => '',//chua co
                        '17' => '', // chua co
                        '18' => '', // chua co
                    );
                }
                else{
                    foreach($data_iraimsai as $k => $v){
                        $lists_csv[] = array(
                            '0'  => $value->MOKUTEKI,
                            '1'  => $value->IRAI_ID,
                            '2'  => $value->CYUMONSYA_NAME,
                            '3'  => $value->SETSAKI_NAME,
                            '4'  => $value->SETSAKI_KNAME,
                            '5'  => $value->SETSAKI_ADDRESS,
                            '6'  => $value->SETSAKI_TELNO,
                            '7'  => $value->TENPO_NAME,
                            '8'  => $value->KOJIGYOSYA_NAME,
                            '9'  => $KIBO_YMD1,
                            '10' => $KIBO_YMD2,
                            '11' => $KIBO_YMD3,
                            '12' => $value->KISETSU_TEL,
                            '13' => $value->KOMOKU_SENTAKUSI,
                            '14' => $value->KIJIRAN,
                            '15' => $v->CTGORY,
                            '16' => $v->MAKER,
                            '17' => $v->SYOHIN,
                            '18' => $v->SURYO,
                        );
                    }
                }
            }   
        }
        return (collect($lists_csv));
    }
    public function headings(): array
    {
        return [
            "目的",
            'ID',
            '注文者名',
            '設置者名',
            '設置者名カナ',
            '設置先住所',
            '設置先電話番号',
            '店舗',
            '協力店様名',
            '希望日１',
            '希望日２',
            '希望日３',
            '既設品番・日中の連絡先',
            '項目選択肢',
            '記事欄',
            'カテゴリ',
            'メーカー',
            'コード',
            '個数',
        ];
    }
    public function export(Request $request){
        $now      = getdate();
        $month    = $now['mon'];
        $day      = $now['mday'];
        $hours    = $now['hours'];
        $minute   = $now['minutes'];
        if($month < 10)
            $month = '0'.$month;
        if($day < 10)
            $day = '0'.$day;
        if($hours < 10)
            $hours = '0'.$hours;
        if($minute < 10)
            $minute = '0'.$minute;
        $name = "日程調整依頼書_".$now['year'].$month.$day."_".$hours.$minute.".csv";
        return Excel::download(new ExportController(), $name);
    }
}
