<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoyalCustomer;//user model can kiem tra
use App\MTantWeb;//user model can kiem tra
use Auth; //use thư viện auth
use DB; //use thư viện auth
use Illuminate\Support\MessageBag;
use Session;
use Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function getLogin(Request $request)
    {
        if(Auth::guard('m_tant_web')->check()){
            return redirect()->route('home');
        }
        else{
            return view('login');//return ra trang login để đăng nhập
        }
    }

    public function postLogin(Request $request)
    {
        Cookie::queue('tant_cd',$request->tant_cd,30);
        if (Auth::guard('m_tant_web')->attempt(['tant_cd' => $request->tant_cd, 'password' => $request->password] ))
        {
            $data = Auth::guard('m_tant_web')->user();

            if($data->DEL_FLG == 1)
            {
                Auth::logout();
                $errors = new MessageBag(['errorlogin' => 'ユーザーIDが無効です']);
                return redirect()->back()->withInput()->withErrors($errors);
                die;
            }

            $request->session()->put('page_click',1);
            $request->session()->put('page_center',5);
            $request->session()->put('total_row_on_one_page',50);
            $request->session()->put('field_sort','T_HACYU.STS_CD');
            $request->session()->put('query_sort','asc');
            if($request->session()->has('search_by_kojigyoya_name'))
                $request->session()->forget('search_by_kojigyoya_name');
            if($request->session()->has('search_list_by_id'))
                $request->session()->forget('search_list_by_id');
            return redirect()->route('list');
        } 
        else
        {
            $errors = new MessageBag(['errorlogin' => 'ユーザーID または パスワードが間違っています']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
