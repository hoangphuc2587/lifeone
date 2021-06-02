<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ログイン画面</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <style>
        #ik2cg-2{
            margin-right:0px;
            margin-bottom:0px;
            margin-left:0px;
        }
        #i6eq3-2{
            margin-right:0px;
            margin-bottom:0px;
            margin-left:0px;
        }
        #login-mess-2{
            margin-top:0px;
            margin-right:0px;
            margin-bottom:10px;
            margin-left:0px;
            color:red;
            font-weight:bold;
        }
        #ik2cg{
            margin-top:10px;
            margin-right:0px;
            margin-bottom:10px;
            margin-left:0px;
            text-align:right;
        }
        #i6eq3{
            margin-top:10px;
            margin-right:0px;
            margin-bottom:10px;
            margin-left:0px;
            text-align:right;
        }
        #izra{
            margin-top:21px;
            margin-right:0px;
            margin-bottom:8px;
            margin-left:0px;
            font-size:30px;
        }
        .c2152{
            max-width:540px;
        }
        .c2858{
            color:black;
            margin-top:20px;
            margin-right:0px;
            margin-bottom:0px;
            margin-left:0px;
            top:0px;
        }
        .container{
            border-top-width:1px;
            border-right-width:1px;
            border-bottom-width:1px;
            border-left-width:1px;
            border-top-style:solid;
            border-right-style:solid;
            border-bottom-style:solid;
            border-left-style:solid;
            border-top-color:rgb(33, 37, 41);
            border-right-color:rgb(33, 37, 41);
            border-bottom-color:rgb(33, 37, 41);
            border-left-color:rgb(33, 37, 41);
            border-image-source:initial;
            border-image-slice:initial;
            border-image-width:initial;
            border-image-outset:initial;
            border-image-repeat:initial;
            width:800px;
            margin-top:100px;
            margin-right:auto;
            margin-bottom:0px;
            margin-left:auto;
        }
        .c3508{
            min-height:300px;
            height:auto;
        }
        .form-block.c3508{
            margin-top:0px;
            margin-right:0px;
            margin-bottom:16px;
            margin-left:0px;
        }
        .inner-form{
            margin-top:50px;
        }
        .header-box{
            border-bottom-width:1px;
            border-bottom-style:solid;
            border-bottom-color:black;
            width:500px;
        }
        .form-control{
            padding-top:2px;
            padding-right:12px;
            padding-bottom:2px;
            padding-left:12px;
            margin-top:0px;
            margin-right:0px;
            margin-bottom:10px;
            margin-left:0px;
        }
        .submit-box{
            border-top-width:1px;
            border-top-style:solid;
            border-top-color:black;
            margin-bottom:50px;
        }
        .c12944{
            margin-bottom:50px;
        }
        .btn.btn-primary.mb-2{
            width:150px;
            margin-top:30px;
            margin-right:80px;
            margin-bottom:8px;
            margin-left:0px;
            float:right;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="container">
        <img data-type="image" src="{{ asset('img/lifeone_logo.jpg') }}" class="c2858"/>
        <div class="header-box">
            <h1 data-type="header" id="izra">ライフワンWEB発注システム
            </h1>
        </div>
        <form class="form-block c3508" method="post" novalidate>
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                    <div class="inner-form innerForm">
                        @if($errors->has('errorlogin'))
                            <p data-type="paragraph" id="login-mess-2">
                                {{$errors->first('errorlogin')}}
                            </p>
                        @endif
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" id="nameId">
                                <p data-type="paragraph" id="ik2cg-2">ユーザーID
                                </p>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12" id="inputNameId">
                                <input type="text" value="<?php if(Cookie::has('tant_cd')){ echo Cookie::get('tant_cd');}?>" class="form-control" name="tant_cd" required=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" id="password">
                                <p data-type="paragraph" id="i6eq3-2">パスワード
                                </p>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12"  id="inputPassword">
                                <input type="password" class="form-control" name="password" required="" autocomplete="new-password" />
                            </div>
                        </div>
                        <div class="c12944">
                        </div>
                    </div>
                    
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="submit-box">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary mb-2">ログイン</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/tether.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/scripts.js') }}"></script>

</body>
</html>
