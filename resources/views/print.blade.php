<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>日程調整依頼印刷画面</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
    <style>
    .container-fluid {
        padding: 0;
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

    h1.title {
        font-weight: 700;
        font-size: 25px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 0px;
        padding-right: 0px;
    }

    .container {
        width: 1200px;
        margin-top: 0;
        margin-bottom: 0;
        margin-right: auto;
        margin-left: auto;
    }

    .top-f-left {
        float: left;
        margin-top: 10px;
        margin-right: 15px;
        margin-bottom: 8px;
        margin-left: 0px;
    }

    .btn-primary {
        width: 100px;
    }

    /************************************/

    body {
        font-size: 14px;
    }

    #itq5 {
        display: inline-block;
        padding: 5px 0 5px 0;
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 0 !important;
        float: left;
        padding-left: 10px;
        padding-right: 10px;
    }

    #itq6 {
        padding: 5px 0 5px 0;
        width: 100px;
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 0 !important;
        display: block;
        float: left;
    }

    #itq7 {
        padding: 25px 0 0 10px;
        display: inline-block;
        float: left;
        text-align: left;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 0 !important;
        float: left;
    }

    #itq8 {
        padding: 10px 0 0 25px;
        width: 170px;
        text-align: center;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 0 !important;
        float: right;
    }

    label {
        margin-right: 2px;
        margin-left: 2px;
    }

    .col-12 {
        padding: 0 !important;
    }

    .row {
        padding: 0 !important;
        margin: 0 !important;
    }

    table {
        table-layout: fixed !important;
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    .table-bordered,
    .table-bordered th,
    .table-bordered td,
    .table-bordered tr {
        border-color: black;
    }

    .table-bordered th.grey-th {
        font-weight: normal !important;
        text-align: center;
        background-color: #e1e1e1;
        border-bottom: none;
    }

    .table-no-border td.bordered {
        border: 1px solid black;
    }





    /* The sticky class is added to the navbar with JS when it reaches its scroll position */
    .sticky {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: white;
    }

    label.text-control {
        border: none;
        padding: 0;
        margin: 0;
        width: 100%;
        background: transparent !important;
    }

    textarea.text-control {
        padding: 0;
        margin: 0;
        width: 100%;
        border: none;
        resize: none;
        background: transparent !important;
    }

    .nowrap {
        white-space: nowrap;
    }
    </style>
</head>

<body>
<div class="container-fluid">
        <!-- item 1-->
<?php $count =0; ?>
@foreach($data as $item)
<!--////////////////////////////////////////////////////////////////////////////////////////-->
  <div class="container-flui print-page">
    <div class="container">
        <div style="margin-bottom: 5px;" ></div>
      <h1 data-type="header" id="itq5"
        style= "@if($item['MOKUTEKI'] == '下見')background:#ffccff; @else background:#9cd1ff; @endif "><?=$item['MOKUTEKI']?>日程調整依頼</h1>
      <h2 data-type="header" id="itq7"></h2>
      <h2 data-type="header" id="itq8">@if($item['KINKYUTAIO_FLG'] == 1) 緊急対応 @endif</h2>
      <div style="clear:both;"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-12" style=" margin: 20px 0;">
            <table class="table-top">
              <tbody>
                <tr>
                  <td>
                    <span>ID</span>
                    <input type="text" class="text-control" name="IRAI_ID" readonly value="{{$item['IRAI_ID']}}" style="width: 119px;">
                    <input type="hidden" name="hansu" value="{{$item['HANSU']}}">
                  </td>
                  <td>
                    <span>注文者名</span>
                    <input type="text" id="maxlength0<?=$count?>" class="text-control" readonly value="{{$item['CYUMONSYA_NAME']}}" style="width: 225px;">
                  </td>
                  <td>
                    <span>設置者名</span>
                    <input type="text" id="maxlength1<?=$count?>" style=" width: 225px;" readonly value="{{$item['SETSAKI_NAME']}}" >
                    <input type="text" id="maxlength3<?=$count?>" style=" width: 135px;" readonly value="{{$item['SETSAKI_KNAME']}}" >
                  </td>
                  <td>
                    <span>協力店様名</span>
                    <input type="text" style="width: 150px;" readonly value="{{$item['KOJIGYOSYA_NAME']}}" >
                  </td>
                </tr>                
              </tbody>
            </table>
            <table class="table-top">
              <tbody>
                <tr>
                  <td>
                    <span>店舗名</span>
                    <input type="text" style=" width: 240px;" readonly value="{{$item['TENPO_NAME']}}" >
                  </td>
                  <td>
                    <span>〒</span>
                    <input type="text" style="width: 90px;" readonly value="{{$item['SETSAKI_POSTNO']}}">
                    <input type="text"  id="maxlength2<?=$count?>" style="width: 474px;" readonly value="{{$item['SETSAKI_ADDRESS']}}" >
                  </td>
                  <td style="margin-left: 49px;">
                    <span>TEL</span>
                    <input type="text" style="width: 150px;" readonly value="{{$item['SETSAKI_TELNO']}}">
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
          <table class="table-bordered">
            <thead>
              <tr>
                <th class="" style="width:25%">カテゴリ</th>
                <th class="" style="width:25%">メーカー</th>
                <th class="" style="width:40%">コード</th>
                <th class="" style="width:10%">個数</th>
              </tr>
            </thead>
            <tbody>
              <?php $iraimsai = \DB::table('T_IRAIMSAI')->where('IRAI_ID', $item['IRAI_ID'])->where('HANSU', $item['HANSU'])->get(); ?>
              @foreach($iraimsai as $row)
              <tr>
                <td><label class="text-control">{{$row->CTGORY}}</td>
                <td><label class="text-control">{{$row->MAKER}}</td>
                <td><label class="text-control">{{$row->SYOHIN}}</td>
                <td ><label class="text-control" style="text-align: right;">{{$row->SURYO}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12" style="padding-left:25px !important;">
          <table class="table-no-border">
            <tbody>
              <tr>
                <td>既設品番・日中の連絡先</td>
              </tr>
              <tr>
                <td class="bordered">
                  <textarea rows='2' class="text-control" disabled="true">{{ $item['KISETSU_TEL']}}</textarea>
                </td>
              </tr>
              <tr>
                <td class="bordered">
                    <textarea rows='7' class="text-control" disabled="true">{{$item['KOMOKU_SENTAKUSI']}}</textarea>
                </td>
              </tr>
              <tr>
                <td class="bordered">
                    <img data-type="image" style="margin:0; padding:0; width:100%;"  src="{{ URL::to('/img/'.$item['KIJIRAN_PATH']) }}">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12" style="padding-left:25px !important;">
          <table class="table-radio">
            <thead>
              <tr>
                <th style="width:150px; font-weight:normal;">希望日１</th>
                <th><br></th>
              </tr>
            </thead>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-1-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="01"
                    @if($item['ANSWER_CD'] == '01') checked="true" @endif
                    disabled="true">
                    <label class="radio__label" for="awesome-item-1-<?=$count?>" style="border: 1px solid #000; text-align: center;">{{$item['KIBO_YMD1']}}</label>    
                  </div>
                     </td>
            </tr>
            <tr>
              <td>希望日２</td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-2-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="02"
                    @if($item['ANSWER_CD'] == '02') checked="true" @endif
                    disabled="true" >
                    <label class="radio__label" for="awesome-item-2-<?=$count?>" style="border: 1px solid #000; text-align: center;">{{$item['KIBO_YMD2']}}</label>    
                  </div>
                   </td>
            </tr>
            <tr>
              <td>希望日３</td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-3-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="03"
                    @if($item['ANSWER_CD'] == '03') checked="true" @endif
                    disabled="true" >
                    <label class="radio__label" for="awesome-item-3-<?=$count?>" style="border: 1px solid #000; text-align: center;">{{$item['KIBO_YMD3']}}</label>    
                  </div>
              </td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-4-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="04"
                    @if($item['ANSWER_CD'] == '04') checked="true" @endif
                    disabled="true" >
                    <label class="radio__label" for="awesome-item-4-<?=$count?>">エリア外で対応不可</label>    
                  </div>
              </td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-5-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="05"
                    @if($item['ANSWER_CD'] == '05') checked="true" @endif
                    disabled="true" >
                    <label class="radio__label" for="awesome-item-5-<?=$count?>">対応不可アイテム</label>    
                  </div>
                </td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-6-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="06"
                    @if($item['ANSWER_CD'] == '06') checked="true" @endif
                    disabled="true">
                    <label class="radio__label" for="awesome-item-6-<?=$count?>">日程合わず</label>    
                  </div>
                </td>
                </td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-7-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="07"
                    @if($item['ANSWER_CD'] == '07') checked="true" @endif
                    disabled="true">
                    <label class="radio__label" for="awesome-item-7-<?=$count?>">お客様と調整済み</label>    
                  </div>
                </td>
            </tr>
            <tr>
              <td>
                  <div class="radio-inline">
                    <input class="radio" id="awesome-item-8-<?=$count?>" name="radiox[<?=$count?>]" type="radio" value="08"
                    @if($item['ANSWER_CD'] == '08') checked="true" @endif
                    disabled="true" >
                    <label class="radio__label" for="awesome-item-8-<?=$count?>">日程調整中</label>    
                  </div>
                </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
          <table class="table-no-border">
            <tbody>
              <tr>
                <td>ライフワンからのコメント</td>
              </tr>
              <tr>
                <td class="bordered">
                            <textarea rows='2' class="text-control" name="COMMENT1[]" 
                  disabled
                  >{!!$item['COMMENT1']!!}</textarea>
                </td>
              </tr>
              <tr>
                <td><br></td>
              </tr>
              <tr>
                <td>ライフワンへのコメント</td>
              </tr>
              <tr>
                <td class="bordered">
                  <textarea rows='2' id="comment2" name="COMMENT2[]" class="text-control" 
                  disabled >{!!$item['COMMENT2']!!}</textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"></div>
      </div>
    </div>
    <div style="margin-top: 50px;" ><br></div>  
    </div>
    </div>

<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

    <hr style="border: 2px solid black; margin: 0; padding: 0;">
    
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->   
<?php $count++; ?>
@endforeach
    </div>
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.quickfit.js') }}"></script>
    <script src="{{ URL::asset('js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script>
    $(document).ready(function() {
      history.pushState(null, null, location.href);
      window.onpopstate = function () {
          window.location.href = "/test/list";
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
      var count = <?=$count?>;
        $(function() {
          for (let i = 0; i < count; i++) {            
            var maxlength0 = $('#maxlength0'+i).val();//console.log(maxlength0);
            var maxlength1 = $("#maxlength1"+i).val();
            var maxlength2 = $("#maxlength2"+i).val();
            var maxlength3 = $("#maxlength3"+i).val();          
            if (maxlength0.length > 17) {
                $('#maxlength0' + i).css('font-size', convert_maxlength_to_px_css(maxlength0.length) + 'px');
            }
            if (maxlength1.length > 20) {
                $('#maxlength1' + i).css('font-size', convert_maxlength_to_px_css(maxlength1.length) + 'px');
            }
            if (maxlength2.length > 32  ) {
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
        }); 
      });
    </script>
</body>

</html>