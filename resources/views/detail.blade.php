<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <title>依頼一覧画面</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link href="{{ asset('datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script>
    var load_page = JSON.parse(sessionStorage.getItem('load_page'))
    if (load_page && load_page == true && window.location.pathname == '/list') {
        window.location.reload();
        sessionStorage.setItem('load_page', JSON.stringify(false));
    }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>

    .dropdown-menu{
        padding: 0.5rem;
    }

    input.datepicker{
        border-radius: unset;
        padding: 3px 4px;
        direction: unset;
        border: 1px solid rgba(0,0,0,.5);
        font-size: 14px;
        background: #FFF2CC;
    }    
        
    label{
        font-size:13px;
    }
    .btn{
        padding: 7px;
    }
    .title-table{
        font-weight: bold;
    }
    .brg-input{
        background-color: #FFF2CC;
        border: 1px solid black;
    }
    .tb_list_checkbox{
        width: 10px !important;
        height: 10px !important;
    }
    .total{
        margin-left: 400px;
        font-size: 12px;
    }
    .total-num{
        margin-left: 80px;
    }
    .total-num-98{
        margin-left: 73px;
    }
    .total-num-90{
        margin-left: 52px;
    }

    .title-cmt{
        font-size: 11px;
    }
    .textarea-cmt{
        resize: none;
        width: 100%;
        height: 105px;
    }

    .textarea-cmt-1{
        resize: none;
        width: 600px;
        height: 60px;
    }
    .text-btn-tb{
        font-size:10px;
        text-align: center;
    }
    .clearfix{
    clear: both;
    }

    .table td, .table th {
        padding: 0px;
    }

    #iy899 {
        padding-top: 10px;
        padding-right: 0px;
        padding-bottom: 30px;
        padding-left: 0px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 0px;
        text-align: right;
    }

    .modal-open {
        overflow: hidden !important;
        padding: 0 !important;
    }
    #iro63i{
        margin-top: 25px;
    }

    #iro64i {
        margin-top: 0px;
        margin-right: 20px;
        margin-bottom: 0px;
        margin-left: 0px;
        float: right;
        width: 120px;
    }


    #iro65i {
        margin-top: 0px;
        margin-right: 20px;
        margin-bottom: 0px;
        margin-left: 0px;
        float: right;
        width: 90px;
        padding: 15px;
    }

    #iro66i {
        text-align: right;
        padding-right: 100px;
        padding-top: 20px;
    }

    #ix1v4u {
        float: right;
        width: 120px;
    }

    #iujvh {
        font-weight: 700;
        font-size: 25px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 0px;
        padding-top: 5px;
        padding-right: 0px;
        padding-bottom: 30px;
        padding-left: 10px;
    }

    .title-header{
        font-weight: 700;
        text-align: center;
        font-size: 36px;
        
    }

    .container {
        width: 1280px;
        margin-top: 20px;
        margin-right: auto;
        margin-bottom: 0px;
        margin-left: auto;
    }

    .c3508 {
        min-height: 300px;
        height: auto;
    }

    .top-f-left {
        float: left;
        margin-top: 10px;
        margin-right: 15px;
        margin-bottom: 8px;
        margin-left: 0px;
    }

    .top-left-btn {
        width: 110px;
        float: right;
    }

    .btn.btn-primary.mb-2 {
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 20px !important;
        margin-left: 20px;
        width: 100px;
    }

    .btn-primary.mb-3 {
        margin-top: 17px;
        margin-left: 20px;
        width: 76px;
    }

    .table-cover {
        width: 100%;
        display: block;
        margin-left: 15px;
        margin-right: 15px;
    }

    .table-cover table {
        margin-bottom: 50px;
        background-color: #ffffff;
        padding: 0.75rem 0.25rem;
        border: 2px solid black;
        font-size: 13px;
    }

    .table-cover table th , .table-cover table td {
      padding: 0.75rem 0.25rem !important;
    }

    .table-bordered,
    .table-bordered th,
    .table-bordered td,
    .table-bordered tr {
        border-color: black !important;
        text-align: center;
        table-layout: fixed;
        overflow: hidden;
    }

    .table-bordered td a {
        text-decoration: underline;
    }

    .grey-bg {
        background-color: #f2f2f2;
    }

    .blue-tr td,
    .blue-tr th {
        background-color: #dce6f1;
    }
    
    .yellow-tr td,
    .yellow-tr th {
        background-color: #ffff99;
    }

    .grey-tr td,
    .grey-tr th {
        background-color: #bfbfbf;
    }
    .blue{
        background-color: #dce6f1;
    }
    .grey{
        background-color: #bfbfbf;
    }
    .yellow{
        background-color: #ffff99;
    }
    .pag-nav {
        margin: auto;
        margin-top: 4px
    }

    .page-link {
        margin-left: 10px !important;
    }

    .sticky {
         position:fixed;
         top: 0;
         z-index: 1000;
         width: 100%;
         background-color: white;
    }

    .sticky .grey-bg {
        border-bottom: none;
    }

    .dot {
        height: 15px;
        width: 15px;
        background-color: black;
        border-radius: 50%;
        display: inline-block;
    }

    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin: 0;
        padding: 0;
    }

    #check_all:hover {
        cursor: pointer;
    }

    .search-panel tr td {
        padding-right: 20px;
    }

    .search-panel label {
        margin: 0 !important;
    }

    #home:hover {
        cursor: pointer;
    }
    .table2 th {
        vertical-align: middle !important;
    }


    .sticky {
        border-bottom: 1px solid black;
    }

    hr.separate-page {
      border: 2px solid black; 
      margin: 0 -15px;
      padding: 0;
    }    

    hr.separate-page:last-child {
      display: none;
    }

    </style>
</head>

<body>
    <form action="{{  route('postUpdate')}}" method="POST" id="form_detail">
        @csrf
        <div class="container-fluid sticky">
            <div class="container">
                <div class="header-box">
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <h1 data-type="header" id="iujvh"><span id="home">ライフワン依頼一覧</span>
                                </h1>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <button type="submit" name="submit" value="submit_data" class="btn btn-primary mb-2 "
                                    style="margin-left: 15px;">保存</button>
                                <button type="button" id="btn-back"
                                    class="btn btn-primary mb-2">閉じる</button>
                            </div>
                        </div>
                    </div>
                 
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <button type="submit" name="submit" value="submit_export" class="btn btn-primary mb-2 error "
                                style="margin-left: 15px;">CSV</button>
                            <button type="submit" name="submit" value="submit_print_pdf"
                                class="btn btn-primary mb-2 error">PDF</button>
                            <button type="submit" name="submit" value="submit_print_excel"
                                class="btn btn-primary mb-2 error">Excel</button>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        @if (!empty($data)) 
        <div class="container-fluid" style="margin-top: 100px">
            @foreach ($data as $item)
            <div class="container">
                <div class="row mt-5">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <span data-type="header" style="padding-left: 10px;" ><span id="home">状況：{{ $item->STS_CD_NAME }}</span>
                        </span>
                        
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <h1 data-type="header" class="title-header"><span>{{ $item->IRAI_CD_NAME }}</span>
                        </h1>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                       <span style="float: right;">{{ !empty($item->IRAI_DAY) ? date('Y/m/d H:i:s', strtotime($item->IRAI_DAY)) : '' }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <span style="padding-left: 65px;">
                                {{ $item->HACYUSAKI_NAME }}　御中												
                                </span>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                                <p style="padding-left: 20px; font-size: 11px;">
                                    拝啓、平素は格別のお引き立てにあずかり御礼申し上げます。<br >
                                    本日、下記商品を注文いたしますので、宜しくお願い致します。
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">                      
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                               {{ $item->TAIO_TANT_NAME }}
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <input onclick="return false;" type="checkbox" <?php if($item->TAIO_CD == '01'){ echo 'checked';} ?> style="position: relative; top: 4px;" />
                                <label style="margin-right: 10px;">対応中</label>
                                <input onclick="return false;" class="ml-1" type="checkbox" <?php if($item->TAIO_CD == '02'){ echo 'checked';} ?> style="position: relative; top: 4px;" />
                                <label>対応完了</label> 
                            </div>
                        </div>                           
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="float:left;">
                                <span>{{ $item->CO_NAME }}<br>〒{{ $item->CO_POSTNO }}</span>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" style="float:right;">
                                <span>担当：{{ $item->CO_TANT_NAME }}</span>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 clearfix">
                            <p style="padding-left: 20px; padding-top: 5px; font-size: 11px;">
                                {{ $item->CO_ADDRESS }}<br >
                                TEL：{{ $item->CO_TELNO }}　FAX：{{ $item->CO_FAX }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="table-cover">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="80" style="vertical-align: middle;">納品場所</td>
                                    <td style="text-align: left; padding-left:5px;"><span>
                                    〒{{ $item->NONYUSAKI_POSTNO }}<br>{{ $item->NONYUSAKI_NAME }}<br>TEL：{{ $item->NONYUSAKI_TELNO }}<br>{{ $item->NONYUSAKI_TANT_NAME }}</span></td> 
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="table-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td width="80" height="50" style="vertical-align: middle;">件名</td>
                                        <td style="vertical-align: middle;">{{ $item->KENMEI }}</td> 
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-right" style="margin-top: 10px;">
                        <span class="title-table">{{ $item->MESSAGE }}</span>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <span style="padding-left:75px; font-size: 12px;">{{ $item->IRAI_YMD_NAME }}：{{ !empty($item->IRAI_YMD) ? date('Y/m/d', strtotime($item->IRAI_YMD)) : '' }}</span>
    
                        <span style="padding-left:55px; font-size: 12px;">発注ID：{{ $item->HACYU_ID }}</span>   
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="iro66i">
                        <div>
                            <label>納品日：</label>
                            <input data-date-format="yyyy/mm/dd" autocomplete="off" class="datepicker" type="text" placeholder=""  class="brg-input"  style="width: 120px;"/>        
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="table-cover">
                        <table class="table table-bordered table2"
                            style="margin-bottom: 0px !important; border:2px solid black; font-size:12px;">
                            <thead>
                                <tr class="blue-tr">
                                    <th scope="col" class="th2" width="40">№</th>
                                    <th class="th3" width="75">カテゴリ</th>
                                    <th class="th4" width="85">メーカー</th>
                                    <th class="th5" width="140">品番</th>
                                    <th class="th6" width="63">単価</th>
                                    <th class="brg-input" scope="col" class="th7" width="80">数量</th>
                                    <th class="th8" width="63">金額</th>
                                    <th class="th9" width="45">掛率</th>
                                    <th class="th9" width="80">値引額</th>
                                    <th class="th9" width="80">値引予定月</th>
                                    <th class="th9" width="80">納品希望日</th>
                                    <th class="th9" width="180">備考</th>
                                    <th class="brg-input" class="th9" width="auto">納品日<br/>※分納の場合は数量を変更して下さい。</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="data[{{ $item->HACYU_ID }}][IRAI_CD]" value="{{ $item->IRAI_CD }}">
                                @foreach ($item->HACYUMSAI as $detail)
                                <tr>
                                    <td>{{ $detail->HACYUMSAI_ID }}</td>
                                    <td>{{ $detail->CTGORY }}</td>
                                    <td>{{ $detail->MAKER }}</td>
                                    <td>{{ $detail->HINBAN }}</td>
                                    <td class="text-right">{{ number_format($detail->TANKA) }}</td>
                                    <td class="brg-input">
                                        <input type="text" name="data[{{ $item->HACYU_ID }}][DETAIL][{{ $detail->HACYUMSAI_ID }}][SURYO]" style="width: 100%;text-align: right;" value="{{ $detail->SURYO }}">
                                    </td>
                                    <td class="text-right">{{ number_format($detail->KINGAK) }}</td>
                                    <td class="text-right">{{ $detail->SIKIRI_RATE }}%</td>
                                    <td class="text-right">{{ number_format($detail->NEBIKI_GAK) }}</td>
                                    <td>{{ $detail->NEBIKI_YM }}</td>
                                    <td>{{ date('Y/m/d', strtotime($detail->NOHIN_KIBO_YMD))}}</td>
                                    <td>{{ $detail->BIKO }}</td>
                                    <td class="brg-input">
                                        <input type="text" data-date-format="yyyy/mm/dd" autocomplete="off" class="datepicker" style="width: 95px;" name="data[{{ $item->HACYU_ID }}][DETAIL][{{ $detail->HACYUMSAI_ID }}][{{ $item->IRAI_CD == '03' ? 'NOHIN_YMD' : 'KAITO_NOKI' }}]" value="{{ $item->IRAI_CD == '03' ? (empty($detail->NOHIN_YMD) ? '' : date('Y/m/d', strtotime($detail->NOHIN_YMD)))  :  (empty($detail->KAITO_NOKI) ? '' : date('Y/m/d', strtotime($detail->KAITO_NOKI))) }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row total">
                    <div>
                        <div>
                            <span>
                            小計
                            </span>
                            <span class="total-num">{{ number_format($item->SYOKEI) }}</span>
                        </div>
                        <div>
                            <span>
                            送料
                            </span>
                            <span class="total-num">{{ number_format($item->SORYO) }}</span>
                        </div>
                        <div style="border-bottom: 1px solid;">
                            <span>
                            消費税
                            </span>
                            <span class="total-num-98">{{ number_format($item->SYOHIZEI) }}</span>
                        </div>
                        <div>
                            <span>
                            合計
                            </span>
                            <span class="total-num">{{ number_format($item->SUM) }}</span>
                        </div>
                    </div>
                    <div class="ml-1">
                        <div>
                            <span>
                            値引額合計
                            </span>
                            <span class="total-num-90">{{ number_format($item->NEBIKI_SUM) }}</span>
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12" style="padding-left: 30px;">
                        <table class="table-no-border" style="width: 100%;">
                            <tbody>
                                <tr>
                                <tr>
                                    <td><span class="title-cmt">ライフワンからのコメント</span>
                                    </td>
                                </tr>
                                <td class="bordered">
                                    <textarea  class="textarea-cmt" readonly="true">{{ $item->COMMENT1 }}</textarea>
                                </td>
                                </tr>
                               
                                <tr>
                                    <td class="title-cmt"><span>ライフワンへのコメント</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bordered">
                                        <textarea name="data[{{ $item->HACYU_ID }}][COMMENT2]" class="textarea-cmt brg-input">{{ $item->COMMENT2 }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div>
                                    <label>【添付ファイル】</label>
                                        <table class="table table-bordered table2"
                                            style="margin-bottom: 0px !important;border:2px solid black; font-size:12px">
                                            <thead>
                                                <tr class="blue-tr">
                                                    <th scope="col" class="th9" width="75">添付元</th>
                                                    <th scope="col" class="th9" width="100">ファイル名</th>
                                                    <th scope="col" class="th9" width="50">対象</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>仕入先様名</td>
                                                    <td></td>
                                                    <td><input name="" class="tb_list_checkbox" type="checkbox" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td>ライフワン担当</td>
                                                    <td></td>
                                                    <td><input name="" class="tb_list_checkbox" type="checkbox" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td>仕入先様名</td>
                                                    <td></td>
                                                    <td><input name="" class="tb_list_checkbox" type="checkbox" value=""></td>
                                                </tr>      
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                                <button type="submit" name="submit" value="submit_export" class="btn btn-primary mb-3 error ">
                                <span class="text-btn-tb">追加</span></button>
                                <button type="submit" name="submit" value="submit_print"
                                    class="btn btn-primary mb-3 error"><span class="text-btn-tb">ダウンロード</span></button>
                                <button type="submit" name="submit" value="submit_print"
                                    class="btn btn-primary mb-3 error"><span class="text-btn-tb">削除</span></button>                        
                            </div>
                        </div>
                    </div>
                </div>
                @if ($item->HAISO_SYBET_CD == '04' && $item->IRAI_CD == '03' )
                <div class="row mt-4">
                    <label style="padding-left: 25px;">【ドライバー情報】</label>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div>
                            <label style="padding-left: 15px;">・ 配送業者</label>
                            <select name="data[{{ $item->HACYU_ID }}][HAISOGYOSYA1]" style="width: 155px;" class="brg-input">
                                <option></option>
                                @foreach ($deliveryCompany as $option)
                                <option value="{{ $option->KBNMSAI_CD }}" {{ $item->HAISOGYOSYA1 == $option->KBNMSAI_CD ? 'selected' : '' }}>{{ $option->KBNMSAI_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                   </div>
                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div>
                            <label>送り状№</label>
                            <input class="brg-input" name="data[{{ $item->HACYU_ID }}][DENPYONO1]"  value="{{ $item->DENPYONO1 }}" type="text" placeholder=""  style="width: 330px;"/>
                        </div>
                   </div>
                </div>
                <div class="row mt-1">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div>
                            <label style="padding-left: 15px;">・ 配送業者</label>
                            <select name="data[{{ $item->HACYU_ID }}][HAISOGYOSYA2]" style="width: 155px;" class="brg-input">
                                <option></option>
                                @foreach ($deliveryCompany as $option)
                                <option value="{{ $option->KBNMSAI_CD }}" {{ $item->HAISOGYOSYA2 == $option->KBNMSAI_CD ? 'selected' : '' }}>{{ $option->KBNMSAI_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                   </div>
                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div>
                            <label>送り状№</label>
                            <input name="data[{{ $item->HACYU_ID }}][DENPYONO2]" class="brg-input" value="{{ $item->DENPYONO2 }}" type="text" placeholder=""  style="width: 330px;"/>
                        </div>
                   </div>

                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div>
                            <label>連絡先</label>
                            <input class="brg-input" name="data[{{ $item->HACYU_ID }}][RENRAKUSAKI2]"  value="{{ $item->RENRAKUSAKI2 }}"  type="text" placeholder=""  style="width: 195px;"/>
                        </div>
                   </div>
                </div>

                <!-- ------------- -->
                

                @if($item->HAISOGYOSYA_MULTI_FLG == 1){
                <div class="row mt-1">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div>
                            <label style="padding-left: 15px;">・ {{ $item->HAISOGYOSYA3_1_LABEL }}</label>
                            <select name="data[{{ $item->HACYU_ID }}][HAISOGYOSYA3_1]" style="width: 155px;" class="brg-input">
                                <option></option>
                                @foreach ($deliveryCompany as $option)
                                <option value="{{ $option->KBNMSAI_CD }}" {{ $item->HAISOGYOSYA3_1 == $option->KBNMSAI_CD ? 'selected' : '' }}>{{ $option->KBNMSAI_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                   </div>
                   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3col-12">
                        <div>
                            <label>送り状№</label>
                            <input name="data[{{ $item->HACYU_ID }}][DENPYONO3_1]" class="brg-input" value="{{ $item->DENPYONO3_1 }}"  type="text" placeholder=""  style="width: 230px;"/>
                        </div>
                   </div>

                   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div>
                            <label style="padding-left: 40px;">{{ $item->HAISOGYOSYA3_2_LABEL }}</label>
                            <select name="data[{{ $item->HACYU_ID }}][HAISOGYOSYA3_2]" style="width: 155px;" class="brg-input">
                                <option></option>
                                @foreach ($deliveryCompany as $option)
                                <option value="{{ $option->KBNMSAI_CD }}" {{ $item->HAISOGYOSYA3_2 == $option->KBNMSAI_CD ? 'selected' : '' }}>{{ $option->KBNMSAI_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                   </div>

                   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div>
                            <label>送り状№</label>
                            <input name="data[{{ $item->HACYU_ID }}][DENPYONO3_2]" class="brg-input" value="{{ $item->DENPYONO3_2 }}" type="text" placeholder=""  style="width: 230px;"/>
                        </div>
                   </div>
                </div>
                @endif

                <!-- ------------- -->


                <div class="row mt-1">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div>
                        <label style="padding-left: 15px;">・ ドライバー名</label>
                            <input class="brg-input" name="data[{{ $item->HACYU_ID }}][DRIVER_NAME]"  type="text" value="{{ $item->DRIVER_NAME }}" placeholder=""  style="width: 190px;"/>
                        </div>
                   </div>
                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="margin-left:-52px;">
                        <div>
                            <label>連絡先</label>
                            <input class="brg-input"  name="data[{{ $item->HACYU_ID }}][RENRAKUSAKI4]"  type="text" value="{{ $item->RENRAKUSAKI4 }}" placeholder=""  style="width: 190px;"/>
                        </div>
                   </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div style="padding-left: 30px;">                            
                            <input name="data[{{ $item->HACYU_ID }}][NO_DENPYO_FLG]" type="checkbox" <?php if($item->NO_DENPYO_FLG == 1){ echo 'checked';} ?> style="position: relative; top: 4px;" />
                            <label style="margin-left: 10px;background: #FFF2CC;">送り状なし。　当日お客様にお電話します。</label>
                        </div>
                   </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="padding-left: 45px;">
                        <table class="table-no-border">
                            <tbody>
                                <tr>
                                <tr>
                                    <td><span class="title-cmt">その他</span>
                                    </td>
                                </tr>
                                <td class="bordered">
                                    <textarea name="data[{{ $item->HACYU_ID }}][BIKO]" class="textarea-cmt-1 brg-input">{{ $item->BIKO }}</textarea>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>    
                </div>

                @endif
            
            </div>
                @if (count($data) > 1)
            <hr class="separate-page">
                @endif
            @endforeach            
        </div>
        @endif

            <!-- static modal-->
            <div class="modal fade show" id="static" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>保存しますか？</p>
                            @if(Auth::user()->HACYUSAKI_CD != '')
                            <p>※保存後10分間は変更可能です。</p>
                            @endif
                        </div>
                        <div class="modal-footer" style="justify-content: center;">
                            <button type="submit" class="btn btn-primary">はい</button>
                            <button type="button" data-dismiss="modal" class="btn btn-default">いいえ</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END modal-->
            <!-- static1 modal-->
            <div class="modal fade in" id="static1" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>入力内容を保存しますか？</p>
                        </div>
                        <div class="modal-footer" style="justify-content: center;">
                            <button type="submit" class="btn btn-primary" id="submit">はい</button>
                            <a id="cancelsub" class="btn btn-raised btn-primary" style="display: none">保存</a>
                            <a href="{{ URL::to(route('list')) }}" class="btn btn-default"
                                style="background: #ddd;color: #000 !important">いいえ</a>
                            <button type="button" data-dismiss="modal" class="btn btn-default">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END modal-->
            <!-- static1 modal-->
            <div class="modal fade in" id="canceler" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>「コメント欄に入力不備があります。」</p>
                        </div>
                        <div class="modal-footer" style="justify-content: center;">
                            <button type="button" data-dismiss="modal" class="btn btn-default">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END modal-->            
        </form>

    <!-- <script src="{{ URL::asset('js/jquery.min.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.7.2.js"></script> -->
    <script src="{{ URL::asset('js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('datepicker/js/bootstrap-datepicker.min.js') }}"></script>    
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>