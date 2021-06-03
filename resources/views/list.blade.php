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
        
    label{
        font-size:13px;
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
        border-top-width: 1px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-top-color: rgb(33, 37, 41);
        border-right-color: rgb(33, 37, 41);
        border-bottom-color: rgb(33, 37, 41);
        border-left-color: rgb(33, 37, 41);
        border-image-source: initial;
        border-image-slice: initial;
        border-image-width: initial;
        border-image-outset: initial;
        border-image-repeat: initial;
        width: 1200px;
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

    .table-cover {
        width: 100%;
        display: block;
        margin-left: 30px;
        margin-right: 30px;
    }

    .table-cover table {
        margin-bottom: 50px;
        background-color: #ffffff;
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
    </style>
</head>

<body>
    <form action="{{  route('post_search_print')}}" method="POST" class="form_list">
        <div class="container-fluid sticky">
            <div class="container-fluid grey-bg">
                <div class="header-box">
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <p data-type="paragraph" id="iy899">
                            @if(Auth::guard('m_tant_web')->check())
                            {{Auth::user()->TANT_NAME}}
                            @endif
                            様
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <h1 data-type="header" id="iujvh"><span id="home">ライフワン依頼一覧</span>
                        </h1>
                        
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <h1 data-type="header" class="title-header"><span>仕入先名</span>
                        </h1>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <a href="{{ route('logout') }}" id="ix1v4u" class="btn btn-primary logout">ログアウト</a>
                        <a href="{{ route('changepass') }}" id="iro64i" class="btn btn-primary">個別設定</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                        <button type="submit" name="submit" value="submit_export" class="btn btn-primary mb-2 error "
                            style="margin-left: 15px;">CSV</button>
                        <button type="submit" name="submit" value="submit_print"
                            class="btn btn-primary mb-2 error">PDF</button>
                        <button type="submit" name="submit" value="submit_print"
                            class="btn btn-primary mb-2 error">Excel</button>                        
                        <button type="submit" name="submit" value="submit_detail"
                            class="btn btn-primary mb-2 error">詳細</button>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="search-panel-4">
                            <label>仕入先様名</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/>        
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12" id="a234xzc">
                        <table class="search-panel">
                            <tr>
                                <td class="search-panel-1">
                                    <label style="padding-left: 10px;">
                                    1～5件(全5件)
                                    </label>
                                </td>
                                <td class="search-panel-2">
                                    <input type="checkbox" <?php if(Session::has('search_reply')){ echo 'checked';} ?>
                                        class="search_reply" value="未回答" style="position: relative; top: 4px;" />
                                    <label>完了</label> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-1 col-lg-9 col-md-9 col-sm-9 col-12">
                   
                    </div>

                    <div class="col-xl-3 col-lg-9 col-md-9 col-sm-9 col-12" style="padding-left: 100px;">
                        <div>
                            <label>依頼内容</label>
                            <select>
                                <option>
                                    
                                </option>
                                <option value="T_IRAI.IRAI_ID"
                                    <?php if(session()->get('field_sort') == 'T_IRAI.IRAI_ID') {echo "selected";}?>>
                                    ID</option>
                                <option value="SETSAKI_NAME"
                                    <?php if(session()->get('field_sort') == 'SETSAKI_NAME') {echo "selected";}?>>
                                    設置者名</option>
                                <option value="SETSAKI_ADDRESS"
                                    <?php if(session()->get('field_sort') == 'SETSAKI_ADDRESS') {echo "selected";}?>>
                                    設置先住所</option>
                                <option value="M_KBN_WEB.KBNMSAI_NAME"
                                    <?php if(session()->get('field_sort') == 'M_KBN_WEB.KBNMSAI_NAME') {echo "selected";}?>>
                                    変更可否</option>
                                <option value="COMMENT1"
                                    <?php if(session()->get('field_sort') == 'COMMENT1') {echo "selected";}?>>
                                    コメント有</option>
                                <option value="KOJIGYOSYA_NAME"
                                    <?php if(session()->get('field_sort') == 'KOJIGYOSYA_NAME') {echo "selected";}?>>
                                    協力店様名</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-9 col-md-9 col-sm-9 col-12" style="margin-right: -70px;">
                        <div>
                            <label>依頼日</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/><label style="padding:0px 15px">～</label><input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/>        
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-9 col-md-9 col-sm-9 col-12" style="margin-right: -35px;">
                        <div>
                            <label>ID</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px;"/>    
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-9 col-md-9 col-sm-9 col-12">
                        <div>
                            <label>状況</label>
                            <select>
                                <option>
                                    
                                </option>
                                <option value="T_IRAI.IRAI_ID"
                                    <?php if(session()->get('field_sort') == 'T_IRAI.IRAI_ID') {echo "selected";}?>>
                                    ID</option>
                                <option value="SETSAKI_NAME"
                                    <?php if(session()->get('field_sort') == 'SETSAKI_NAME') {echo "selected";}?>>
                                    設置者名</option>
                                <option value="SETSAKI_ADDRESS"
                                    <?php if(session()->get('field_sort') == 'SETSAKI_ADDRESS') {echo "selected";}?>>
                                    設置先住所</option>
                                <option value="M_KBN_WEB.KBNMSAI_NAME"
                                    <?php if(session()->get('field_sort') == 'M_KBN_WEB.KBNMSAI_NAME') {echo "selected";}?>>
                                    変更可否</option>
                                <option value="COMMENT1"
                                    <?php if(session()->get('field_sort') == 'COMMENT1') {echo "selected";}?>>
                                    コメント有</option>
                                <option value="KOJIGYOSYA_NAME"
                                    <?php if(session()->get('field_sort') == 'KOJIGYOSYA_NAME') {echo "selected";}?>>
                                    協力店様名</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12">
                        <label style="padding-left: 10px;">
                        納期催促：○件
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-2 col-lg-9 col-md-9 col-sm-9 col-12">
                        <label style="padding-left: 10px;">
                        納期回答未・一部未回答：○件
                        </label>
                    </div>

                    <div class="col-xl-2 col-lg-9 col-md-9 col-sm-9 col-12">
                        <div>
                            <label>メーカー</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-lg-9 col-md-9 col-sm-9 col-12"     style="margin-right: -105px;">
                        <div>
                            <label>配送先情報</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/>    
                        </div>
                    </div>

                     <div class="col-xl-4 col-lg-9 col-md-9 col-sm-9 col-12" style="margin-right: -50px;">
                        <div>
                            <label>納品日</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/><label style="padding:0px 15px">～</label><input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/>        
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-9 col-md-9 col-sm-9 col-12">
                        <div>
                            <label>品番</label>
                            <input type="text" placeholder="" id="i0tgl7-2-2" style="width: 120px; "/>    
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12">
                        <label style="padding-left: 10px;">
                        納期催促：○件
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <label style="padding-left: 10px;">
                        ドライバー情報入力未：○件
                        </label>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <nav class="pag-nav" aria-label="...">
                        <ul class="pagination">
                         
                            <li class="page-item ">
                                <a class="page-link" style="visibility: hidden;">0</a>
                            </li>
                  
                            <li class="page-item ">
                                <a class="page-link " href="" tabindex="-1">前へ</a>
                            </li>
                  
                            <li class="page-item">
                                <a class="page-link "
                                    href="">1
                                </a>
                            </li>
                     
                            <li class="page-item">
                                <a class="page-link " href="">次へ</a>
                            </li>
              
                        </ul>
                    </nav>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="iro63i">
                            <label>表示</label>
                            <select>
                                <option>50件</option>  
                            </select>
                            
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <a href="" id="iro65i" class="btn btn-primary">検索</a>
                            </div>
                            
                        </div>    
                    </div>
                   
                </div>
               
                <div class="row">
                    <div class="table-cover">
                    <label>仕入先様ログイン時の明細</label>
                        <table class="table table-bordered table2"
                            style="margin-bottom: 0px !important;border:2px solid black; font-size:12px">
                            <thead>
                                <tr class="blue-tr">
                                    <th scope="col" class="th1" id="check_all" style="text-decoration: underline;"
                                        width="97"><a>全てチェック</a></th>
                                    <th scope="col" class="th2" width="100">依頼内容</th>
                                    <th scope="col" class="th3" width="85">依頼日</th>
                                    <th scope="col" class="th4" width="100">ID</th>
                                    <th scope="col" class="th5" width="100">状況</th>
                                    <th scope="col" class="th6" width="100">メーカー</th>
                                    <th scope="col" class="th7" width="150">配送先情報</th>
                                    <th scope="col" class="th8" width="63">備考有</th>
                                    <th scope="col" class="th9" width="85">納品希望有</th>
                                    <th scope="col" class="th10" width="250">フリースペース<br/>御社自由入力欄(ライフワン閲覧権限なし)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td>発注書</td>
                                    <td>24/03/2021</td>
                                    <td>0400123090</td>
                                    <td></td>
                                    <td>TOTO</td>
                                    <td>群馬県伊勢崎市中町</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td>仮発注書</td>
                                    <td>24/03/2021</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="tdDot"><span class="dot"></span></td>
                                    <td></td>
                                    <td></td>
                                </tr>    
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td>納期確認書</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="tdDot"><span class="dot"></span></td>
                                    <td></td>
                                </tr>    
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>            
                                    <td></td>
                                </tr>        
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="table-cover">
                    <label>ライフワン様ログイン時の明細</label>
                        <table class="table table-bordered table2"
                            style="margin-bottom: 0px !important;border:2px solid black; font-size:12px">
                            <thead>
                                <tr class="blue-tr">
                                    <th scope="col" class="th1" id="check_all" style="text-decoration: underline;"
                                        width="97"><a>全てチェック</a></th>
                                    <th scope="col" class="th2" width="100">依頼内容</th>
                                    <th scope="col" class="th3" width="62">依頼日</th>
                                    <th scope="col" class="th3" width="62">発注種別</th>
                                    <th scope="col" class="th4" width="62">ID</th>
                                    <th scope="col" class="th5" width="100">状況</th>
                                    <th scope="col" class="th6" width="100">メーカー</th>
                                    <th scope="col" class="th7" width="150">配送先情報</th>
                                    <th scope="col" class="th8" width="63">備考有</th>
                                    <th scope="col" class="th9" width="85">担当者</th>
                                    <th scope="col" class="th9" width="83">対応状況</th>
                                    <th scope="col" class="th9" width="85">最終入荷予定日</th>
                                    <th scope="col" class="th9" width="83">仕入先様名</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td>発注書</td>
                                    <td>24/03/2021</td>
                                    <td></td>
                                    <td>0400123090</td>
                                    <td></td>
                                    <td>TOTO</td>
                                    <td>群馬県伊勢崎市中町</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td>仮発注書</td>
                                    <td>24/03/2021</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="tdDot"><span class="dot"></span></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>    
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td>納期確認書</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>    
                                <tr>
                                    <td>
                                        <input name="" class="save_list_checkbox" type="checkbox" value="">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>        
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </form>

    <!-- <script src="{{ URL::asset('js/jquery.min.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.7.2.js"></script> -->
    <script src="{{ URL::asset('js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>