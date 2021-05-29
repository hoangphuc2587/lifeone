<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>個別設定画面</title>

	  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<style>
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
  width:900px;
  margin-top:100px;
  margin-right:auto;
  margin-bottom:0px;
  margin-left:auto;
}
.c3508{
  min-height:250px;
  height:auto;
}
.form-block.c3508{
  margin-top:0px;
  margin-right:0px;
  margin-bottom:16px;
  margin-left:0px;
  padding-left: 10px;
  padding-right: 10px;
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
.c19969{
  font-size:30px;
  text-align:center;
  margin-top:50px;
  margin-right:0px;
  margin-bottom:40px;
  margin-left:0px;
}
.btn.btn-primary.mb-2{
  margin:20px 0 8px 0;
  width:100px;
  padding:10px 12px 10px 12px;
}

.table th, .table td, .table tr{
	padding-left: 2px;
	padding-right: 2px;
	padding-top: 0px;
	padding-bottom: 0px;
	line-height: 25px;
}

.table-bordered, .table-bordered th, .table-bordered td, .table-bordered tr{
	border-color: black !important;
}

.no-wrap td{
	white-space: nowrap !important;
	overflow: hidden !important;
	text-overflow: clip !important;
}

.table-bordered th.grey-th{
	font-weight: normal !important;
	text-align: center;
	background-color: #e1e1e1;
	border-bottom: none;
}

.table-no-border, .table-no-border th, .table-no-border td, .table-no-border tr{
	border: none !important;
}

.table-no-border td.bordered{
	border: 1px solid black !important;
}
.message-box{
	font-weight: bold;
	color: red;
}
</style>
  </head>
  <body>
<div class="container-fluid">
<div class="container">
  <div class="header-box">
	<h1 data-type="header" id="izra-2" class="c19969">パスワード変更
	</h1>
  </div>
  <form class="form-block c3508" method="post" id="formChangePassword">
	  <div class="row">
		  <table class="table table-no-border"
				 @if (count($errors) > 0)
					 style="margin-left: 20px; margin-right: 20px;"
				 @else
					 style="width: auto; margin: auto;"
				 @endif
		  >
			  <thead>
			  <tr>
				  <th width="210px"></th>
				  <th width="270px"></th>
				  <th width="auto"></th>
			  </tr>
			  </thead>
			  <tbody>
			  <tr>
				  <td>現在のパスワード</td>
				  <td><input type="password" class="form-control" name="password" required="" /></td>
				  <td>
					  @if($errors->has('errOldPass'))
						  <p class="message-box">
							  {{$errors->first('errOldPass')}}
						  </p>
					  @endif
				  </td>
			  </tr>
			  <tr>
				  <td>新しいパスワード</td>
				  <td><input type="password" class="form-control" name="newpassword" required=""/></td>
				  <td><br></td>
			  </tr>
			  <tr>
				  <td>新しいパスワード(確認用)</td>
				  <td><input type="password" class="form-control" name="repassword" required="" /></td>
				  <td>
					  @if($errors->has('errRePass'))
						  <p class="message-box">
							  {{$errors->first('errRePass')}}
						  </p>
					  @endif
				  </td>
			  </tr>
			  <tr>
				  <td><br></td>
				  <td>
					  {!! csrf_field() !!}
					  <button type="submit" class="btn btn-primary mb-2">変更</button>
				  </td>
				  <td><br></td>
			  </tr>
			  </tbody>
		  </table>
	  </div>
  </form>
  <form class="form-block c3508" method="post" id="formChangePasswordMobile" style="display:none;">
	  <div class="row">
		  <table class="table table-no-border">
			  	<thead>
			  	<tr>
				  	<th width="300px"></th>
				  	<th></th>
				  	<th width="auto"></th>
			  	</tr>
			  	</thead>
			  	<tbody>
			  	<tr>
				  	<td>現在のパスワード</td>
				  	<td><input type="password" class="form-control" name="password" required="" /></td>
				  	<td></td>
				  </tr>
				<tr>
					<td></td>
					<td colspan="2"> 
						@if($errors->has('errOldPass'))
							<p class="message-box">
								{{$errors->first('errOldPass')}}
							</p>
						@endif
					</td>
				</tr>
			  	<tr>
				  	<td>新しいパスワード</td>
				  	<td><input type="password" class="form-control" name="newpassword" required=""/></td>
				  	<td><br></td>
			  	</tr>
			  	<tr>
				  	<td>新しいパスワード(確認用)</td>
				  	<td><input type="password" class="form-control" name="repassword" required="" /></td>
				  	<td></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						@if($errors->has('errRePass'))
						  	<p class="message-box">
								<span id="hgjuec">{{$errors->first('errRePass')}}</span>
						  	</p>
						@endif
					</td>
					<td></td>
				</tr>
			  	<tr>
				  	<td><br></td>
				  	<td>
					  	{!! csrf_field() !!}
					  	<button type="submit" class="btn btn-primary mb-2">変更</button>
				  	</td>
				  	<td><br></td>
			  	</tr>
			  	</tbody>
		  	</table>
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