<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>日程調整依頼詳細画面</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/details.css') }}">
</head>

<body>
<form action="{{  route('postUpdate')}}" method="POST" id="form_detail">
@csrf
    <div class="container-fluid header sticky">

        <div class="container-fluid">
            <div class="container">                
                    <div class="header-box">
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <h1 data-type="header" class="title">ライフワン日程調整依頼詳細
                            </h1>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-12 col-12 button-header">
{{--BUTTON SUBMIT--}}
<a id="jumplist1" class="btn btn-raised btn-primary" data-remote="false" data-toggle="modal" data-target="#canceler" data-href="#canceler" href="#canceler" style="display: none">保存</a>
<a id="jumplist2" class="btn btn-raised btn-primary" data-remote="false" data-toggle="modal" data-target="#static" data-href="#static" href="#static" style="display: none">保存</a>
<a id="jumplist3" class="btn btn-raised btn-primary">保存</a>

{{--BUTTON CANCEL--}}
<a id="check_jumplist1" class="btn btn-raised btn-primary" style="color:white;margin-left:5px;">閉じる</a>
<a id="check_jumplist2" class="btn btn-raised btn-primary" data-toggle="modal" data-target="#static1" data-href="#static1" href="#static1" style="display: none">閉じる</a>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-12 col-12 user-header">
                            <span>
                                <p data-type="paragraph" id="iy899">
                                    @if(Auth::guard('m_tant_web')->check())
                                    {{Auth::user()->TANT_NAME}}
                                    @endif
                                    様
                                </p>
                            </span>
                        </div>
                    </div>
            </div>
        </div>
    </div>
        <div class="life-hr"><br></div>
    <?php $count = 0
    ?>
    @foreach($data as $item)
    <!--////////////////////////////////////////////////////////////////////////////////////////-->
<?php 
        $title = '';
        $div ="";
      $read = false;
      $ra1 = $item['ANSWER_CD'];
      $comment1[$count] = $item['COMMENT1'];
      $comment2[$count] = $item['COMMENT2'];
      date_default_timezone_set('Asia/Tokyo');
      $time_current = strtotime(date('Y-m-d H:i:s'));
      $time_last_10_minute = strtotime(date('Y-m-d H:i:s')) - 600;         
      if($item['KBNMSAI_NAME'] == '未回答'){
        $div = '<div class="container-flui" style="padding-top: 20px;" >';
        $title = $item['MOKUTEKI'].'日程調整依頼';
      }
      else if
            ($item['KBNMSAI_NAME'] == '回答済' && strtotime($item['GYOSYA_ANS_YMD']) <= $time_current && strtotime($item['GYOSYA_ANS_YMD']) >= $time_last_10_minute)
      {
        $div = '<div class="container-flui input-yl" style="padding-top: 20px;background-color:#ffff99">';
        $title = $item['MOKUTEKI'].'日程調整依頼';
      }
      else{
        $div = '<div class="container-flui not_edit" style="padding-top: 20px;background-color:#e1e1e1">';
        $title = $item['MOKUTEKI'].'日程調整依頼';
        $read = true;
      }
    ?>
    <?=$div?>
        <div class="container">
            <h1 data-type="header" id="itq5"
                style="@if($item['MOKUTEKI'] == '下見')background:#ffccff @else background:#9cd1ff @endif"><?=$title?></h1>
            <h2 data-type="header" id="itq8">@if($item['KINKYUTAIO_FLG'] == 1) 緊急対応 @endif</h2>
            <div style="clear:both;"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12 top-pc" style=" margin: 20px 0;">
                    <table class="table-top">
                        <tbody>
                            <tr>
                                <td class="mo-1">
                                    <span>ID</span>
                                    <input type="text" class="text-control life-id" name="IRAI_ID[]" readonly
                                        value="{{$item['IRAI_ID']}}">
                                    <input type="hidden" name="hansu[]" value="{{$item['HANSU']}}">
                                </td>
                                <td class="mo-2">
                                    <span>注文者名</span>
                                    <input type="text" id="maxlength0<?=$count?>" class="text-control life-name" readonly
                                        value="{{$item['CYUMONSYA_NAME']}}">
                                </td>
                                <td class="mo-3">
                                    <span>設置者名</span>
                                    <input type="text" id="maxlength1<?=$count?>" class="life-title-1" readonly
                                        value="{{$item['SETSAKI_NAME']}}">
                                    <input type="text" id="maxlength3<?=$count?>" class="life-kname" readonly
                                        value="{{$item['SETSAKI_KNAME']}}">
                                </td>
                                <td class="mo-4">
                                    <span>協力店様名</span>
                                    <input type="text" class="life-kojigyosa" readonly
                                        value="{{$item['KOJIGYOSYA_NAME']}}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table-top">
                        <tbody>
                            <tr>
                                <td class="mo-5">
                                    <span>店舗名</span>
                                    <input type="text" class="life-tenpo-name" readonly value="{{$item['TENPO_NAME']}}">
                                </td>
                                <td class="mo-6">
                                    <span>〒</span>
                                    <input type="text" class="life-postino" readonly value="{{$item['SETSAKI_POSTNO']}}">
                                    <input type="text" id="maxlength2<?=$count?>" class="life-address" readonly
                                        value="{{$item['SETSAKI_ADDRESS']}}">
                                </td>
                                <td  class="life-title-tel m-6">
                                    <span>TEL</span>
                                    <input type="text" class="life-tel" readonly value="{{$item['SETSAKI_TELNO']}}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row top-mb ">
                        <div class="col-md-6 col-sm-6 col-4 life-mb-id">{{$item['IRAI_ID']}}</div>
                        <div class="col-md-6 col-sm-6 col-8 life-mb-tenpo">{{$item['TENPO_NAME']}}</div>
                        <div class="col-md-6 col-sm-6 col-4 life-mb-1">【注文者名】</div>
                        <div class="col-md-6 col-sm-6 col-8 life-mb-id">{{$item['CYUMONSYA_NAME']}}</div>
                        <div class="col-md-12 col-sm-12 col-12 life-mb-2">【設置先】</div>
                        <div class="col-md-6 col-sm-6 col-4 life-mb-setsaki">{{$item['SETSAKI_NAME']}}</div>
                        <div class="col-md-6 col-sm-6 col-8 life-mb-kname">{{$item['SETSAKI_KNAME']}}</div>
                        <div class="col-md-12 col-sm-12 col-12 life-mb-postino">〒 {{$item['SETSAKI_POSTNO']}}</div>
                        <div class="col-md-12 col-sm-12 col-12 life-mb-address">{{$item['SETSAKI_ADDRESS']}}</div>
                        <div class="col-md-12 col-sm-12 col-12 life-mb-tel">{{$item['SETSAKI_TELNO']}}</div>
                </div>
                    
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12">
                    <table class="table-bordered table-pc">
                        <thead>
                            <tr>
                                <th class="grey-th" style="width:25%">カテゴリ</th>
                                <th class="grey-th" style="width:25%">メーカー</th>
                                <th class="grey-th" style="width:40%">コード</th>
                                <th class="grey-th" style="width:10%">個数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $iraimsai = \DB::table('T_IRAIMSAI')->where('IRAI_ID', $item['IRAI_ID'])->where('HANSU', $item['HANSU'])->get(); ?>
                            @foreach($iraimsai as $row)
                            <tr>
                                <td><label class="text-control">{{$row->CTGORY}}</td>
                                <td><label class="text-control">{{$row->MAKER}}</td>
                                <td><label class="text-control">{{$row->SYOHIN}}</td>
                                <td><label class="text-control" style="text-align: right;">{{$row->SURYO}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table-bordered table-mb">
                        <thead>
                            <tr>
                                <th class="grey-th" style="width:25%">カテゴリ<br/>メーカー</th>
                                <th class="grey-th" style="width:40%">コード</th>
                                <th class="grey-th" style="width:10%">個数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $iraimsai = \DB::table('T_IRAIMSAI')->where('IRAI_ID', $item['IRAI_ID'])->where('HANSU', $item['HANSU'])->get(); ?>
                            @foreach($iraimsai as $row)
                            <tr>
                                <td><label class="text-control">{{$row->CTGORY}}<br/>{{$row->MAKER}}</td>
                                <td><label class="text-control">{{$row->SYOHIN}}</td>
                                <td  style="text-align: right;padding-right: 10px;"><label class="text-control">{{$row->SURYO}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12 life-img">
                    <table class="table-no-border">
                        <tbody>
                            <tr>
                                <td class="title-pc">既設品番・日中の連絡先</td>
                                <td class="title-mb">【既設品番・日中の連絡先】</td>
                            </tr>
                            <tr>
                                <td class="bordered">
                                    <textarea rows='2' class="text-control"
                                        disabled="true">{{ $item['KISETSU_TEL']}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="bordered">
                                    <textarea rows='7' class="text-control"
                                        disabled="true">{{$item['KOMOKU_SENTAKUSI']}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="bordered">
                                    <img data-type="image" style="margin:0; padding:0; width:100%;border: 1px solid #000;"
                                        src="{{ URL::to('/img/'.$item['KIJIRAN_PATH']) }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 show-mb">
                    <div class="bordered comment1-mb">
                                    <span class="title-pc">ライフワンからのコメント</span>
                                    <span class="title-mb">【ライフワンからのコメント】</span>
                                    <textarea class="text-control" name="COMMENT1[]" id="comment1<?=$count?>"
                                        @if(Auth::user()->KOJIGYOSYA_CD != '' || $read == true) readonly @endif 
                  >{!!$item['COMMENT1']!!}</textarea>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 life-check">
                    <div class="text-left title-mb">【回答】</div>
                    <table class="table-radio">
                        <tbody>
                            <tr class="mbc-1">
                                <td>
                                    <div class="title-check-pc">希望日１</div>
                                    <div class="title-check-mb">１:</div>
                                    <div class="radio-inline">                                        
                                        <input class="radio" id="awesome-item-1-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="01" @if($item['ANSWER_CD'] == '01') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '' || $item['KIBO_YMD1'] == '')disabled="true"
                                        @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                          for="awesome-item-1-<?=$count?>"
                                          @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                          @endif
                                        >{{$item['KIBO_YMD1']}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="mbc-2">
                                <td>
                                    <div class="title-check-pc">希望日２</div>
                                    <div class="title-check-mb">２:</div>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-2-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="02" @if($item['ANSWER_CD'] == '02') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '' || $item['KIBO_YMD2'] == '')disabled="true"
                                        @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-2-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >{{$item['KIBO_YMD2']}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="mbc-3">
                                <td>
                                    <div class="title-check-pc">希望日３</div>
                                    <div class="title-check-mb">３:</div>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-3-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="03" @if($item['ANSWER_CD'] == '03') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '' || $item['KIBO_YMD3'] == '')disabled="true"
                                        @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-3-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >{{$item['KIBO_YMD3']}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-4-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="04" @if($item['ANSWER_CD'] == '04') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '')disabled="true" @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-4-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >エリア外で対応不可</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-5-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="05" @if($item['ANSWER_CD'] == '05') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '')disabled="true" @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-5-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >対応不可アイテム</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="mbc-text-1">
                                <td>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-6-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="06" @if($item['ANSWER_CD']== '06') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '')disabled="true" @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-6-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >日程合わず</label>
                                    </div>
                                </td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-7-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="07" @if($item['ANSWER_CD'] == '07') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '')disabled="true" @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-7-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >お客様と調整済み</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="radio-inline">
                                        <input class="radio" id="awesome-item-8-<?=$count?>" name="radiox[<?=$count?>]"
                                            type="radio" value="08" @if($item['ANSWER_CD'] == '08') checked="true" @endif
                                        @if(Auth::user()->KOJIGYOSYA_CD == '')disabled="true" @endif
                                        >
                                        <label class="radio__label" @if($read==false && Auth::user()->KOJIGYOSYA_CD != '')
                                            for="awesome-item-8-<?=$count?>"
                                            @elseif( $read == true && Auth::user()->KOJIGYOSYA_CD == '') for=""
                                            @endif
                                            >日程調整中</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>                        
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
                    <table class="table-no-border">
                        <tbody>
                            <tr class="show-pc">
                                <td class="bordered comment1-mb">
                                    <span class="title-pc">ライフワンからのコメント</span>
                                    <span class="title-mb">【ライフワンからのコメント】</span>
                                    <textarea class="text-control" name="COMMENT1[]" id="comment1<?=$count?>"
                                        @if(Auth::user()->KOJIGYOSYA_CD != '' || $read == true) readonly @endif 
                  >{!!$item['COMMENT1']!!}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td><span class="title-pc">ライフワンへのコメント</span>
                                    <span class="title-mb">【ライフワンへのコメント】</span>
                                    @if($item['ANSWER_CD'] == "06" || $item['ANSWER_CD'] == "07")
                                    <span id="checknull<?=$count?>"
                                        style="color:red; font-weight:bold; padding-left:20px;display: inline-block;">※必須入力です</span>
                                    @else
                                    <span id="checknull<?=$count?>"
                                        style="color:red; font-weight:bold; padding-left:20px;display: none;">※必須入力です</span>
                                    @endif
                                    <span id="checknumber<?=$count?>"
                                        style="color:red; font-weight:bold; padding-left:20px;display: none;">「文字数は400文字以下で入力してください。」</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bordered">
                                    <textarea id="comment2<?=$count?>" name="COMMENT2[]" class="text-control"
                                        @if(Auth::user()->KOJIGYOSYA_CD == '' || $item['ANSWER_CD'] == "00" || $item['ANSWER_CD'] == "08") readonly @endif
                  @if($read == true) readonly="true" @endif
                  @if($item['ANSWER_CD'] == "06") placeholder = "「日程合わず　→　月日以降可能」" 
                  @elseif($item['ANSWER_CD'] == "07") placeholder = "「お客様と調整済み　→　月日」" 
                  @endif
                  >{!!$item['COMMENT2']!!}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"></div>
            </div>
        </div>
        <div style="margin-top: 50px;"><br></div>
    </div>

    <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <hr style="border: 2px solid black; margin: 0; padding: 0;">

    <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <?php $count++ ?>
    @endforeach
    <!-- static modal-->
    <div class="modal fade show" id="static" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>保存しますか？</p>
                    @if(Auth::user()->KOJIGYOSYA_CD != '')
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
    </div>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.quickfit.js') }}"></script>
    <script src="{{ URL::asset('js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>  
<script>
  $(document).ready(function() {       
    window.onpopstate = function() {
		window.localtion = "/test/list";
        };        
	function convert_maxlength_to_px_css(length){
            if(length < 30)
                px = 10 - ((((length-20) / 3 ) + 0.2 )) ;
            if(length <= 50)
                px = 10 - ((((length-20) / 5 ) + 0.8 )) ;
            if(length > 50)
                px = 10 - ((((length-20) / 10 ) + 3  )) ;
            if(px < 0)
                px = 1;
            return px;
        }
        function convert_maxlength2_to_px_css(length){
            if(length < 46){
                px = 10 - ((((length-50) / 10 ) + 0.2 )) ;
            }
            else if(length >= 46){
                px = 9 - ((((length-50) / 10 ) + 0.5 )) ;
            }
            else if(length >= 85){
                px = 9 - ((((length-50) / 20 ) + 1 )) ;
            }
            if(px < 0)
                    px = 1;
            return px;
        }
    //radio button click
      <?php if (Auth::user()->KOJIGYOSYA_CD != '') {?>
        $('.radio__label').click(function(){
            var radio = $('#'+$(this).attr('for')).val();  
            var raval = $(this).text();      
            console.log(raval);  
            var string = $(this).attr('for');  
            var array = string.split("-");      
            if (radio != "08" && raval != '') {              
              $('#comment2'+array[3]).attr('readonly', false);
              switch(radio){
                case "06":
                  $('#comment2'+array[3]).attr('placeholder', '「日程合わず　→　例 １月１日以降可能」');
                  $("#checknull"+array[3]).css("display", "inline-block");
                  break;
                case "07":
                  $('#comment2'+array[3]).attr('placeholder', '「お客様と調整済み　→　例 １月１日」');
                  $("#checknull"+array[3]).css("display", "inline-block");
                  break;
                default:
                  $('#comment2'+array[3]).attr('placeholder', '');
                  $("#checknull"+array[3]).css("display", "none");
              }
            }else if(radio == "08"){
              $('#comment2'+array[3]).val('');
              $('#comment2'+array[3]).attr('readonly', true);
              $('#comment2'+array[3]).attr('placeholder', '');                
              $("#checknull"+array[3]).css("display", "none");
            }            
        }); 
      <?php } ?>
      $('textarea').focus(function(){
        $(this).removeAttr('placeholder');
      });
    //check number char in label
        var count = <?=$count?>;
        $.each($("textarea"), function () {
            var scrollHeight = parseInt(this.scrollHeight);
            if ($("this").val() != ""  && scrollHeight > $(this).height()) {
                $(this).height(scrollHeight);
            }
        });
        for (let i = 0; i < count; i++) {      
            console.log($("#comment2"+i).scrollHeight);    
          $("#comment1"+i).charCounter(400,{container: "#counter1"+i});
          $("#comment2"+i).charCounter(400,{container: "#counter2"+i});
          $('#comment1'+i).keyup(function(){            
            var comment1 = $(this).val();
            //var heighttext = this.scrollHeight;
            if (comment1.length == 400) { $('#checknumber'+i).css('display', 'inline-block');}
            else{$('#checknumber'+i).css('display', 'none');}

            var textarea = document.querySelector('#comment1'+i);
            textarea.style.cssText = 'height:auto';
            textarea.style.cssText = 'height:' + this.scrollHeight + 'px';
          });

          $('#comment2'+i).keyup(function(){            
            var comment2 = $(this).val();
            //var heighttext = this.scrollHeight;
            if (comment2.length == 400) { $('#checknumber'+i).css('display', 'inline-block');}
            else{$('#checknumber'+i).css('display', 'none');}

            var textarea = document.querySelector('#comment2'+i);
            textarea.style.cssText = 'height:auto';
            textarea.style.cssText = 'height:' + this.scrollHeight + 'px';

            //$(this).css('height', heighttext + 'px');
          });                         
                   
          var maxlength0 = $('#maxlength0'+i).val();//console.log(maxlength0);
          var maxlength1 = $("#maxlength1"+i).val();
          var maxlength2 = $("#maxlength2"+i).val();
          var maxlength3 = $("#maxlength3"+i).val();          
          if (maxlength0.length > 17) {
                
                $('#maxlength0' + i).css('font-size', convert_maxlength_to_px_css(maxlength0.length) + 'px');
            }
            if (maxlength1.length > 17) {
                $('#maxlength1' + i).css('font-size', convert_maxlength_to_px_css(maxlength1.length) + 'px');
            }
            if (maxlength2.length > 32  ) {
                console.log(maxlength2.length);
                $('#maxlength2' + i).css('font-size', convert_maxlength2_to_px_css(maxlength2.length) + 'px');
            }
          if (maxlength3.length - 9 > 0) { 
            var cnnn = 2;
            var size = 13;
            for (var ii = 1; ii <= maxlength3.length - 9; ii++) {
              if (ii == cnnn) {
                if (size > 1) {size = size - 1;}
                cnnn = cnnn + 2;
              }        
            }
            $('#maxlength3'+i).css('font-size', size + 'px');
          }
        }
    //button submit click
        $('#jumplist3').on('click', function(){
            for (let i = 0; i < count; i++) {
                const element = document.querySelector('#checknull'+i);
                const display = element.style.display;
                if (display == "inline-block" && $('#comment2'+i).val() == '') {              
                    $('#jumplist1').trigger('click');
                    return false;
                }
            }
            let checked2 = new Array();
            var cnn2 = 0;
            var radios2 = document.getElementsByClassName("radio");            
            for( i = 0; i < radios2.length; i++ ) {                
                if( radios2[i].checked == true ) {                    
                    checked2[cnn2] = radios2[i].value;
                    cnn2++;
                }
            }
            var check = false;            
            for (let i = 0; i < count; i++) {
                let com1 = $('#comment1'+i).val(); 
                let com2 = $('#comment2'+i).val(); 
                if (acomment2[i] == null) {
                    acomment2[i] = '';
                }                 
                <?php if (Auth::user()->KOJIGYOSYA_CD != '') { ?>
                     if(com2 != acomment2[i] || checked.length < checked2.length){
                        $('#jumplist2').trigger('click');                        
                        check = true;
                        return false;                    
                    }else if(checked[i] != checked2[i]){
                        $('#jumplist2').trigger('click');
                        check = true;
                        return false;
                    }
                <?php }else{ ?>
                    if (acomment1[i] == null) {
                        acomment1[i] = '';
                    } 
                    if (com1 != acomment1[i]) {                
                        $('#jumplist2').trigger('click');
                        check = true;
                        return false;
                    }
                <?php } ?>
            }
            if (check == false) {
                window.location.href = '<?php echo route('list'); ?>';
            }
        });
        $('#submit').click(function(){
            for (let i = 0; i < count; i++) {
                const element = document.querySelector('#checknull'+i);
                const display = element.style.display;
                if (display == "inline-block" && $('#comment2'+i).val() == '') {              
                    $('#jumplist1').trigger('click');
                    return false;
                }
            }
        });
    //button cancel click
        var acomment2 = <?php echo json_encode($comment2); ?>;    
        var acomment1 = <?php echo json_encode($comment1); ?>;  
        let checked = new Array();
        var cnn = 0;
        var radios = document.getElementsByClassName("radio");                  
        for( i = 0; i < radios.length; i++ ) {                
            if( radios[i].checked == true ) {                                
                checked[cnn] = radios[i].value;   
                cnn++;             
            }
        }    
        $('#check_jumplist1').on('click', function(){            
            let checked2 = new Array();
            var cnn2 = 0;
            var radios2 = document.getElementsByClassName("radio");            
            for( i = 0; i < radios2.length; i++ ) {                
                if( radios2[i].checked == true ) {                    
                    checked2[cnn2] = radios2[i].value;
                    cnn2++;
                }
            }
            var check = false;            
            for (let i = 0; i < count; i++) {
                let com1 = $('#comment1'+i).val(); 
                let com2 = $('#comment2'+i).val(); 
                if (acomment2[i] == null) {
                    acomment2[i] = '';
                }                 
                <?php if (Auth::user()->KOJIGYOSYA_CD != '') { ?>
                     if(com2 != acomment2[i] || checked.length < checked2.length){
                        $('#check_jumplist2').trigger('click');                        
                        check = true;
                        return false;                    
                    }else if(checked[i] != checked2[i]){
                        $('#check_jumplist2').trigger('click');
                        check = true;
                        return false;
                    }
                <?php }else{ ?>
                    if (acomment1[i] == null) {
                        acomment1[i] = '';
                    } 
                    if (com1 != acomment1[i]) {                
                        $('#check_jumplist2').trigger('click');
                        check = true;
                        return false;
                    }
                <?php } ?>
            }
            if (check == false) {
              window.location.href = '<?php echo route('list'); ?>';
            }
        });      
    });
</script>

<script type="text/javascript">
(function($) {  
$.fn.charCounter = function (max, settings) {   
    max = max || 400;   
    settings = $.extend({   
        container: "<span></span>", 
        classname: "charcounter",   
        format: "(残り %1 文字)",   
        pulse: true,    
        delay: 0    
    }, settings);   
 
    var p, timeout; 
            function count(el, container) { 
        el = $(el); 
        if (el.val().length > max) {                
el.val(el.val().substring(0, max));             
if (settings.pulse && !p) {                 
pulse(container, true);             
};  
        };  
 
        if (settings.delay > 0) {   
            if (timeout) {  
                window.clearTimeout(timeout);   
            }   
 
            timeout = window.setTimeout(function () {   
                container.html(settings.format.replace(/%1/, (max - el.val().length))); 
            }, settings.delay); 
        } 
 
else {              container.html(settings.format.replace(/%1/, (max - el.val().length)));                     
        }   
    };  
 
            function pulse(el, again) { 
        if (p) {    
            window.clearTimeout(p);             p = null;           };  
        el.animate({ opacity: 0.1 }, 100, function () { 
            $(this).animate({ opacity: 1.0 }, 100);         }); 
 
        if (again) {                p = window.setTimeout(function () { 
pulse(el) }, 200);  
        };  
    };  
 
            return this.each(function () {  
        var container;  
        if (!settings.container.match(/^<.+>$/)) {  
 
            container = $(settings.container);          } else { 
$(this).next("." + settings.classname).remove();    
            container = $(settings.container)                               .insertAfter(this)                              .addClass(settings.classname);  
        }   
 
        $(this)             .unbind(".charCounter")             .bind("keydown.charCounter", function () { count(this, container); 
})  
 
            .bind("keypress.charCounter", function () { count(this, container); 
})  
 
            .bind("keyup.charCounter", function () { count(this, container); 
})  
 
            .bind("focus.charCounter", function () { count(this, container); 
})  
 
            .bind("mouseover.charCounter", function () { count(this, container); 
})  
 
            .bind("mouseout.charCounter", function () { count(this, container); 
})  
 
            .bind("paste.charCounter", function () {    
                var me = this;  
                setTimeout(function () { count(me, container); 
}, 10); 
 
            }); 
 
        if (this.addEventListener) {    
            this.addEventListener('input', function () { 
            count(this, container); }, false);          
        };  
        count(this, container); 
    }); 
};
}
)(jQuery);
</script>
   
</body>

</html>