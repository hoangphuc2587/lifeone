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

    #iro64i {
        margin-top: 0px;
        margin-right: 20px;
        margin-bottom: 0px;
        margin-left: 0px;
        float: right;
        width: 120px;
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
        margin-top: 32px;
        margin-bottom: 20px;
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
    </style>
</head>

<body>
    <form action="{{  route('post_search_print')}}" method="POST" class="form_list">
        <div class="container-fluid sticky">
            <div class="container grey-bg">
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
                    <button type="submit" name="submit" value="submit_export" class="btn btn-primary mb-2 error "
                        style="margin-left: 25px;"> CSV出力 </button>
                    <button type="submit" name="submit" value="submit_print"
                        class="btn btn-primary mb-2 error">PDF</button>
                    <button type="submit" name="submit" value="submit_print"
                        class="btn btn-primary mb-2 error">Excel</button>                        
                    <button type="submit" name="submit" value="submit_detail"
                        class="btn btn-primary mb-2 error">詳細</button>
                </div>
                
                <div class="row" style="height: 40px;">
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12" id="a234xzc">
                        <table class="search-panel">
                            <tr>
                                <td class="search-panel-1">
                                    <label style="padding-left: 10px;">
                                        @if($total_datas != 0)
                                        {{ ($page_click - 1)  * session()->get('total_row_on_one_page') + 1 }}
                                        @else
                                        {{ 0 }}
                                        @endif
                                        ～
                                        @if( ($page_click) * session()->get('total_row_on_one_page') >= $total_datas)
                                        {{ $total_datas }} 件(全{{ $total_datas }}件)
                                        @else
                                        {{   ($page_click) * session()->get('total_row_on_one_page') }}
                                        件(全{{ $total_datas }}件)
                                        @endif
                                    </label>
                                </td>
                                <td class="search-panel-2">
                                    <label>未回答</label>
                                    <input type="checkbox" <?php if(Session::has('search_reply')){ echo 'checked';} ?>
                                        class="search_reply" value="未回答" style="position: relative; top: 4px;" />
                                </td>
                                <td class="search-panel-3">
                                    <label>回答済</label>
                                    <input type="checkbox"
                                        <?php if(Session::has('search_no_reply')){ echo 'checked';} ?>
                                        class="search_no_reply" value="回答済" style="position: relative; top: 4px;" />
                                </td>
                                <td class="search-panel-4">
                                    <label>並び替え</label>
                                    <select id="illur5">
                                        <option value="MOKUTEKI"
                                            <?php if(session()->get('field_sort') == 'MOKUTEKI') {echo "selected";}?>>目的
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
                                </td>
                                <td class="search-panel-5">
                                    <select id="imrevo">
                                        <option value="asc"
                                            <?php if(session()->get('query_sort') == 'asc') {echo "selected";}?>>昇順
                                        </option>
                                        <option value="desc"
                                            <?php if(session()->get('query_sort') == 'desc') {echo "selected";}?>>降順
                                        </option>
                                    </select>
                                </td>
                                <td class="search-panel-6">
                                    <label>表示</label>
                                    <select id="icb8hk">
                                        <option value="10"
                                            <?php if(session()->get('total_row_on_one_page') == 10) {echo "selected";}?>>
                                            10件</option>
                                        <option value="30"
                                            <?php if(session()->get('total_row_on_one_page') == 30) {echo "selected";}?>>
                                            30件</option>
                                        <option value="50"
                                            <?php if(session()->get('total_row_on_one_page') == 50) {echo "selected";}?>>
                                            50件</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" id="tableSearch">
                        <table style="border: 1px solid #cccccc;">
                            <tr>
                                <td width="100px;"><label style="margin-left: 10px; margin-top: 10px;">絞込みID</label>
                                </td>
                                <td><input type="text" placeholder="" id="i0tgl7-2-2"
                                        style="width: 140px; margin-right: 10px; margin-top: 10px;"
                                        value="{{ Session::get('key_search_id') ?? ''}}" /></td>
                            </tr>
                            <tr <?php if(Auth::user()->KOJIGYOSYA_CD != ''){ echo "style='display: none;'";}?>>
                                <td><label style="margin-left: 10px; ">協力店様名</label></td>
                                <td><input value="{{ Session::get('key_search_name') ?? ''}}" type="text" id="if8qmi"
                                        style="width: 140px; margin-right: 10px;" /></td>
                            </tr>
                            <tr>
                                <td><br></td>
                                <td> <input type="button" class="btn btn-primary search_id_and_name" value="検索"
                                        style="margin-top:5px; margin-bottom: 5px;" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <nav class="pag-nav" aria-label="...">
                        <ul class="pagination">
                            <?php if($total_datas == 0) {?>
                            <li class="page-item ">
                                <a class="page-link" style="visibility: hidden;">0</a>
                            </li>
                            <?php } ?>
                            <?php
						$page_avg = floor($page_center / 2);
						if($total_datas != 0){
						if ($page_click != 1 && $total_datas > 0) { //Load prev
							?>
                            <li class="page-item ">
                                <a class="page-link " href="{{route('asc_page_current')}}" tabindex="-1">前へ</a>
                            </li>
                            <?php
						}
						$page_pre  = $page_click - $page_avg; //số page bên trái của page được click
						$page_next = $page_click + $page_avg; //số page bên phải của page được click
						if($page_pre<=0){ //Nếu page trái <=0 thì cộng dồn qua phải
							$page_next -= $page_pre;
							$page_next += 1;
							$page_pre   = 1;
						}
						if($page_next > $page_total){ //Nếu page phải > tổng trang thì cộng dồn về trái
							if($page_pre-($page_next-$page_total)>0){
								$page_pre-=$page_next-$page_total;
							}
							if($page_click == $page_total && $page_click > 1){
								$page_pre = $page_total - 4;
								if($page_pre <= 0)
									$page_pre = 1;
							}
							$page_next = $page_total;
						}
						for ($i = $page_pre; $i <= $page_next; $i++) {
							?>
                            <li class="page-item <?php if($i==$page_click){echo "active";}?>">
                                <a class="page-link "
                                    href="{{route('page_click',['page_click'=> $i])}}"><?php echo $i; ?>
                                </a>
                            </li>
                            <?php
						}
						if ($page_click != $page_total && $total_datas > 0) {
							?>
                            <li class="page-item">
                                <a class="page-link " href="{{route('desc_page_current')}}">次へ</a>
                            </li>
                            <?php
							} }
						?>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <div class="table-cover">
                        <table class="table table-bordered tbale2"
                            style="margin-bottom: 0px !important;border:2px solid black">
                            <thead>
                                <tr class="blue-tr">
                                    <th scope="col" class="th1" id="check_all" style="text-decoration: underline;"
                                        width="130px"><a>全てチェック</a></th>
                                    <th scope="col" class="th2" width="100px">依頼内容</th>
                                    <th scope="col" class="th3" width="90px">依頼日</th>
                                    <th scope="col" class="th4" width="132px">ID</th>
                                    <th scope="col" class="th5" width="163px">状況</th>
                                    <th scope="col" class="th6" width="86px">メーカー</th>
                                    <th scope="col" class="th7" width="108px">配送先情報</th>
                                    <th scope="col" class="th8" width="126px">備考有</th>
                                    <th scope="col" class="th9" width="126px">納品希望有</th>
                                    <th scope="col" class="th10" width="auto">フリースペース</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

        <div class="container-fluid">
            <div class="container grey-bg">
                <div class="row" style="margin-top:330px;"></div>
                <div class="row">
                    <div class="table-cover">
                        <?php if ($total_datas != 0 ) {?>
                        <table class="table table-bordered table1" style="border: 2px solid black;">
                            <thead>
                                <tr class="blue-tr">
                                    <th scope="col" class="th1" style="text-decoration: underline;" width="144px">
                                        <a>全てチェック</a></th>
                                    <th scope="col" class="th2" width="68px">依頼内容</th>
                                    <th scope="col" class="th3" width="132px">依頼日</th>
                                    <th scope="col" class="th4" width="181px">ID</th>
                                    <th scope="col" class="th5" width="163px">状況</th>
                                    <th scope="col" class="th6" width="86px">メーカー</th>
                                    <th scope="col" class="th7" width="108px">配送先情報</th>
                                    <th scope="col" class="th8" width="126px">備考有</th>
                                    <th scope="col" class="th9" width="auto">納品希望有</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$data = [];
								date_default_timezone_set('Asia/Tokyo');
								$time_current = strtotime(date('Y-m-d H:i:s'));
								$time_last_10_minute = strtotime(date('Y-m-d H:i:s')) - 600;
								if(Session::get('field_sort') == 'M_KBN_WEB.KBNMSAI_NAME'){
									foreach($lists as $key => $value){
										if($value->KBNMSAI_NAME == '未回答'){
											$data[$key] = $value;
											$data[$key]->kbn = 1;
										}
										else if( 
											($value->KBNMSAI_NAME == '回答済' ) && 
											(  	 (strtotime($value->GYOSYA_ANS_YMD) <= $time_current) && (strtotime($value->GYOSYA_ANS_YMD) >= $time_last_10_minute)    )
										)	
										{
											$data[$key] = $value;
											$data[$key]->kbn = 3;
										}
										else{
											$data[$key] = $value;
											$data[$key]->kbn = 2;
										}
									}
									$lists = [];
									if(Session::get('query_sort') == 'asc'){
										for($i = 3 ; $i > 0 ; $i--){
											foreach($data as $k => $v){
												if($v->kbn == $i){
													$lists[] = $v;
												}
											}
										}
									}
									else{
										for($i = 1 ; $i < 4 ; $i++){
											foreach($data as $k => $v){
												if($v->kbn == $i){
													$lists[] = $v;
												}
											}
										}
									}
								}
							?>
                                @foreach($lists as $item)
                                <tr <?php
							date_default_timezone_set('Asia/Tokyo');
							$time_current = strtotime(date('Y-m-d H:i:s'));
							$time_last_10_minute = strtotime(date('Y-m-d H:i:s')) - 600;
							if($item->KBNMSAI_NAME == '未回答'){
							}
							else if( 
								($item->KBNMSAI_NAME == '回答済' ) && 
								(  	 (strtotime($item->GYOSYA_ANS_YMD) <= $time_current) && (strtotime($item->GYOSYA_ANS_YMD) >= $time_last_10_minute)    )
							)	
							{
								echo 'class="yellow-tr"';
							}
							else{
								echo 'class="grey-tr"';
							}
							?>>
                                    <td>
                                        <input name="check_box_list[]" class="save_list_checkbox" type="checkbox"
                                            value="{{$item->IRAI_ID}}-{{ $item->HANSU }}">
                                    </td>
                                    <td>{{$item->MOKUTEKI}}</td>
                                    <td><a class="single_choose"
                                            href="{{ route('search_print',['id'=>$item->IRAI_ID,'hansu'=>$item->HANSU]) }}">{{$item->IRAI_ID}}</a>
                                    </td>
                                    <td>{{$item->SETSAKI_NAME}}</td>
                                    <td>{{$item->SETSAKI_ADDRESS}}</td>
                                    <td>{{$item->KBNMSAI_NAME}}</td>
                                    <td>
                                        <?php
									if($item->KBNMSAI_NAME == '未回答'){
										echo '変更可';
									}
									else if( 
										($item->KBNMSAI_NAME == '回答済' ) && 
										(  	 (strtotime($item->GYOSYA_ANS_YMD) <= $time_current) && (strtotime($item->GYOSYA_ANS_YMD) >= $time_last_10_minute)    )
									)
									{
										echo '変更可';
									}
									else{
										echo '変更不可';
									}
								?>
                                    </td>
                                    <td class="tdDot">
                                        @if($item->COMMENT1 != '')
                                        <span class="dot"></span>
                                        @endif
                                    </td>
                                    <td>{{$item->KOJIGYOSYA_NAME}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{  route('post_search_print')}}" method="POST" class="form_list_mobile" style="display:none;">
        <div class="container-fluid sticky">
            <div class="container grey-bg" style="padding-bottom:50px;" id="nvhjc">
               <div class="header-box">
               </div>
               <div class="row" id="kmjs3s">
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
               <div class="row" id="jg84c">
                    <div id="f8dfgjf" style="width:80%;">
                        <h1 data-type="header" id="iujvh"><span id="home">ライフワン日程調整依頼一覧</span>
                        </h1>
                    </div>
                    <div id="md9kfx" style="text-align:right;width:20%;">
                        <i class="fas fa-bars dropDown"></i>
                        <div id="cvnwefj43">
                            <div class="row">
                                <a href="{{ route('changepass') }}">個別設定</a>
                            </div>
                            <div class="row">
                                <a href="{{ route('logout') }}">ログアウト</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="jmtxc">
                     <div id="f84jf" style="font-size:30px;font-weight:bold;padding-left:50px;width:50%">
                        <input type="checkbox" <?php if(Session::has('search_reply')){ echo 'checked';} ?>
                        class="search_reply" value="未回答" style="position:relative;top: 4px;width:30px;height:30px;" />
                        <label>未回答</label>
                     </div>
                     <div id="f84jfcf" style="font-size:30px;font-weight:bold;width:50%">
                        
                        <input type="checkbox"
                              <?php if(Session::has('search_no_reply')){ echo 'checked';} ?>
                              class="search_no_reply" value="回答済" style="position:relative;top:4px;width:30px;height:30px;" />
                        <label>回答済</label>
                     </div>
                  </div>
                  <div class="row"  id="dfgjf" style="font-size:25px;">
                     <label style="padding-left: 15px;">
                           @if($total_datas != 0)
                           {{ ($page_click - 1)  * session()->get('total_row_on_one_page') + 1 }}
                           @else
                           {{ 0 }}
                           @endif
                           ～
                           @if( ($page_click) * session()->get('total_row_on_one_page') >= $total_datas)
                           {{ $total_datas }} 件(全{{ $total_datas }}件)
                           @else
                           {{   ($page_click) * session()->get('total_row_on_one_page') }}
                           件(全{{ $total_datas }}件)
                           @endif
                     </label> 
                  </div>       
                  <div class="row"  id="lokd84">
                     <div style="width:50%;">
                        <input type="checkbox" id="a2s1">
                        <a id="adfkgj85"><span>詳細</span></a>
                        <button style="display:none;" type="submit" name="submit" id="submit_detail_mobile" value="submit_detail"
                        class="btn btn-primary mb-2 error">詳細</button>
                     </div>
                     <div class="divPhanTrang"  style="width:50%;">
                        @if($page_click != 1 && $total_datas > 0)
                            <a  href="{{route('asc_page_current')}}" tabindex="-1">前へ</a>
                        @endif
                        @if($page_click != $page_total && $total_datas > 0)
                            <a href="{{route('desc_page_current')}}">次へ</a>
                        @endif
                     </div>
                  </div> 
            </div>
        </div>
        <div class="container-fluid" style="margin-top:320px;" id="hjng7s">
            <div class="container grey-bg" style="border-bottom: 1.5px solid #776d6d !important;padding-bottom:20px;">
                  <div class="row list">
                  <?php
                        $data = [];
                        date_default_timezone_set('Asia/Tokyo');
                        $time_current = strtotime(date('Y-m-d H:i:s'));
                        $time_last_10_minute = strtotime(date('Y-m-d H:i:s')) - 600;
                        if(Session::get('field_sort') == 'M_KBN_WEB.KBNMSAI_NAME'){
                            foreach($lists as $key => $value){
                                if($value->KBNMSAI_NAME == '未回答'){
                                    $data[$key] = $value;
                                    $data[$key]->kbn = 1;
                                }
                                else if( 
                                    ($value->KBNMSAI_NAME == '回答済' ) && 
                                    (  	 (strtotime($value->GYOSYA_ANS_YMD) <= $time_current) && (strtotime($value->GYOSYA_ANS_YMD) >= $time_last_10_minute)    )
                                )	
                                {
                                    $data[$key] = $value;
                                    $data[$key]->kbn = 3;
                                }
                                else{
                                    $data[$key] = $value;
                                    $data[$key]->kbn = 2;
                                }
                            }
                            $lists = [];
                            if(Session::get('query_sort') == 'asc'){
                                for($i = 3 ; $i > 0 ; $i--){
                                    foreach($data as $k => $v){
                                        if($v->kbn == $i){
                                            $lists[] = $v;
                                        }
                                    }
                                }
                            }
                            else{
                                for($i = 1 ; $i < 4 ; $i++){
                                    foreach($data as $k => $v){
                                        if($v->kbn == $i){
                                            $lists[] = $v;
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                    @foreach($lists as $item)
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 itemList <?php
							date_default_timezone_set('Asia/Tokyo');
							$time_current = strtotime(date('Y-m-d H:i:s'));
							$time_last_10_minute = strtotime(date('Y-m-d H:i:s')) - 600;
							if($item->KBNMSAI_NAME == '未回答'){
							}
							else if( 
								($item->KBNMSAI_NAME == '回答済' ) && 
								(  	 (strtotime($item->GYOSYA_ANS_YMD) <= $time_current) && (strtotime($item->GYOSYA_ANS_YMD) >= $time_last_10_minute)    )
							)	
							{
								echo "yellow";
							}
							else{
								echo "grey";
							}
                        ?>">
                        <div class="row rowItem1">
                            <div style="width:10%;text-align:center;">
                                <input type="checkbox" name="check_box_list[]" class="save_list_checkbox" value="{{$item->IRAI_ID}}-{{ $item->HANSU }}">
                            </div>
                            <div style="width:20%;text-align:center;@if($item->MOKUTEKI == '下見')background:#ffccff @else background:#9cd1ff @endif">
                                {{$item->MOKUTEKI}}
                            </div>
                            <div style="width:40%;text-align:center;">
                                <a class="single_choose"
                                            href="{{ route('search_print',['id'=>$item->IRAI_ID,'hansu'=>$item->HANSU]) }}">{{$item->IRAI_ID}}</a>
                            </div>
                            <div style="width:30%;text-align:center;">
                                {{$item->KBNMSAI_NAME}}
                            </div>
                        </div>
                        <div class="row rowItem2">
                            <div style="width:40%;text-align:center;">
                                <span>{{ mb_substr($item->SETSAKI_NAME,0,5)}}</span>
                            </div>
                            <div style="width:60%;text-align:center;"><?php echo mb_substr($item->SETSAKI_ADDRESS,0,9) ?></div>
                        </div>         
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    </form>
    <a id="jumplist1" class="btn btn-raised btn-primary" data-remote="false" data-toggle="modal" data-target="#canceler"
        data-href="#canceler" href="#canceler" style="display:none;">保存</a>
    <div class="modal fade show" id="canceler" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="canceler"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>メッセージ</p>
                    <p>明細が選択されていません !</p>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" data-dismiss="modal" class="btn btn-default">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="{{ URL::asset('js/jquery.min.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.7.2.js"></script> -->
    <script src="{{ URL::asset('js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>