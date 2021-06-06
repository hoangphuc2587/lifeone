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
use ZipArchive;
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
    public function search_print($id)
    {
        $cnn = 0;
        $data = array();
      
        return view('detail', compact('data'));
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
            case 'submit_print_pdf':  
                // Files to download
                $urls = [
                    'seminar.pdf',
                    '210832.pdf'
                ];

                $this->__multiple_download($urls);  
              
                break;

            case 'submit_print_excel':    
              
                break;

            case 'submit_detail': 

                return view('detail', compact('data'));
            default:
                break;
        }
    }

    private function __multiple_download(array $urls, $save_path = 'tmp')
    {

        $files = $urls;
        $zipname = 'file.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
          $zip->addFile($file);
        }
        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
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