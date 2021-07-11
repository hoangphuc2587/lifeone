<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; //use thư viện auths
use Session;
use Illuminate\Support\MessageBag;
use Hash;
use App\MTantWeb;

class ChangepassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('changepass');//return ra trang login để đăng nhập
    }

    public function postChange(Request $request)
    {
        $data = Auth::guard('m_tant_web')->user();

        $user = MTantWeb::findOrFail($data->TANT_CD);

        if (Hash::check($request->password, $user->PASSWORD)) {

            if($request->newpassword != $request->repassword){
                $errors = new MessageBag(['errRePass' => '※パスワードが一致しません']);
                return redirect()->back()->withInput()->withErrors($errors);
            }

            $data->PASSWORD = $request->newpassword;
            $data->UPD_TANTCD = $user->TANT_CD;
            $data->PW_UPD_YMD = now();
            $data->save();

            return redirect()->route('logout');

        } else {
            $errors = new MessageBag(['errOldPass' => '※現在のパスワードが間違っています。']);

            if($request->newpassword != $request->repassword){
                $errors->add('errRePass', '※パスワードが一致しません');
            }

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
