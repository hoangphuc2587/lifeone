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
            $lists_checkboxID = session()->get('list_csv');
        }
        $query = DB::table('T_HACYU')
        ->select(
         'T_HACYU.IRAI_YMD',
         'T_HACYU.HACYU_ID',
         DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.IRAI_CD AND M_KBN_WEB.KBN_CD = '00' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS IRAI_CD_NAME"),
         DB::raw("(SELECT KBNMSAI_NAME FROM M_KBN_WEB WHERE M_KBN_WEB.KBNMSAI_CD = T_HACYU.STS_CD AND M_KBN_WEB.KBN_CD = '03' AND M_KBN_WEB.DEL_FLG = 0 LIMIT 1) AS STS_CD_NAME"),
         'T_HACYU.NONYUSAKI_POSTNO',
         'T_HACYU.NONYUSAKI_ADDRESS',
         'T_HACYU.NONYUSAKI_NAME',
         'T_HACYU.NONYUSAKI_TELNO',
         'T_HACYU.CO_TELNO',
         'T_HACYU.NONYUSAKI_TANT_NAME',
         'T_HACYU.KENMEI',
         'T_HACYU.SYOKEI',
         'T_HACYU.SORYO',
         'T_HACYU.SYOHIZEI',
         'T_HACYU.SUM',
         'T_HACYU.NEBIKI_SUM',
         'T_HACYU.COMMENT1',
         'T_HACYU.IRAI_CD',
        )
        ->whereIn('T_HACYU.HACYU_ID',$lists_checkboxID)
        ->where(['T_HACYU.DEL_FLG'=> 0,'T_HACYU.VISIVLE_FLG'=>1])
        ->orderBy($field_sort,$query_sort);

        
        $lists = $query->get();
        $lists_csv = array();
        foreach($lists as $key => $value){
            $subQuery = DB::table('T_HACYUMSAI')
            ->select(
             'T_HACYUMSAI.HACYUMSAI_ID',
             'T_HACYUMSAI.CTGORY',            
             'T_HACYUMSAI.MAKER',
             'T_HACYUMSAI.HINBAN',
             'T_HACYUMSAI.TANKA',
             'T_HACYUMSAI.SURYO',
             'T_HACYUMSAI.KINGAK',
             'T_HACYUMSAI.SIKIRI_RATE',
             'T_HACYUMSAI.NEBIKI_GAK',
             'T_HACYUMSAI.NEBIKI_YM',
             'T_HACYUMSAI.NOHIN_KIBO_YMD',
             'T_HACYUMSAI.BIKO',
             'T_HACYUMSAI.KAITO_NOKI',
             'T_HACYUMSAI.NOHIN_YMD'  
            )       
            ->where(['T_HACYUMSAI.DEL_FLG'=> 0, 'T_HACYUMSAI.HACYU_ID'=> $value->HACYU_ID]);  

           
            $data = $subQuery->get();
            
            if (count($data) > 0){
                foreach($data as $k => $v){
                    $lists_csv[] = array(
                    '0'  => $value->IRAI_CD_NAME,
                    '1'  => $value->IRAI_YMD,
                    '2'  => $value->HACYU_ID,
                    '3'  => $value->STS_CD_NAME,
                    '4'  => $value->NONYUSAKI_POSTNO,
                    '5'  => $value->NONYUSAKI_ADDRESS,
                    '6'  => $value->NONYUSAKI_NAME,
                    '7'  => $value->CO_TELNO,
                    '8'  => $value->NONYUSAKI_TANT_NAME,
                    '9'  => $value->KENMEI,
                    '10' => $v->HACYUMSAI_ID,
                    '11' => $v->CTGORY,
                    '12' => $v->MAKER,
                    '13' => $v->HINBAN,
                    '14' => $v->TANKA,
                    '15' => $v->SURYO,
                    '16' => $v->KINGAK,
                    '17' => $v->SIKIRI_RATE,
                    '18' => $v->NEBIKI_GAK,
                    '19' => $v->NEBIKI_YM,
                    '20' => $v->NOHIN_KIBO_YMD,
                    '21' => $v->BIKO,
                    '22' => $value->IRAI_CD == '03' ? $v->NOHIN_YMD : $v->KAITO_NOKI,
                    '23' => $value->SYOKEI,
                    '24' => $value->SORYO,
                    '25' => $value->SYOHIZEI,
                    '26' => $value->SUM,
                    '27' => $value->NEBIKI_SUM,
                    '28' => $value->COMMENT1,
                    ); 
                } 
            }else{
                $lists_csv[] = array(
                '0'  => $value->IRAI_CD_NAME,
                '1'  => $value->IRAI_YMD,
                '2'  => $value->HACYU_ID,
                '3'  => $value->STS_CD_NAME,            
                '4'  => $value->NONYUSAKI_POSTNO,
                '5'  => $value->NONYUSAKI_ADDRESS,
                '6'  => $value->NONYUSAKI_NAME,
                '7'  => $value->NONYUSAKI_TELNO,
                '8'  => $value->NONYUSAKI_TANT_NAME,
                '9'  => $value->KENMEI,
                '10' => '',
                '11' => '',
                '12' => '',
                '13' => '',
                '14' => '',
                '15' => '',
                '16' => '',
                '17' => '',
                '18' => '',
                '19' => '',
                '20' => '',
                '21' => '',
                '22' => '',
                '23' => $value->SYOKEI,
                '24' => $value->SORYO,
                '25' => $value->SYOHIZEI,
                '26' => $value->SUM,
                '27' => $value->NEBIKI_SUM,
                '28' => $value->COMMENT1,
                ); 
            }  
  
        }
        return (collect($lists_csv));
    }
    public function headings(): array
    {
        return [           
            '依頼内容',
            '依頼日',
            'ID',
            '状況',
            '納品先郵便番号',
            '納品先住所',
            '納品先名',
            '納品先電話番号',
            '納品先担当者様名',
            '件名',
            '明細№',
            'カテゴリ',
            'メーカー',
            '品番',
            '単価',
            '数量',
            '金額',
            '掛率',
            '値引額',
            '値引予定月',
            '納品希望日',
            '備考',
            '納品日',
            '小計',
            '送料',
            '消費税',
            '合計',
            '値引額合計',
            'ライフワンからのコメント'
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
