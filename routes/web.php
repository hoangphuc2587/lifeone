<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    route::get('/login', 'LoginController@getLogin')->name('login');
    route::post('/login', 'LoginController@postLogin');
    
    route::get('/change-pass', 'ChangepassController@show')->name('changepass');
    route::post('/change-pass', 'ChangepassController@postChange');

    route::get('/list', 'ListController@show')->name('list');

    route::get('/detail', 'DetailController@show')->name('detail');

    route::get('/print', 'PrintController@show')->name('print');

    Route::get('/', function () {
        return redirect()->route('list');
    })->name('home');;

    route::get('/logout', function () {
        \Auth::logout();
        \Session::flush();
        return redirect('/login');
    })->name('logout');

    route::get('/home','ListController@home')->name('home');

    route::get('page-click/{page_click}','ListController@page_click')->name('page_click');
    route::post('/get-list-checkbox','ListController@get_list_check_box');
    route::get('esc-page-current','ListController@asc_page_current')->name('asc_page_current');
    route::get('desc-page-current','ListController@desc_page_current')->name('desc_page_current');
    route::get('take-total-row-on-one-page/{total}','ListController@take_total_row_on_one_page');
    Route::get('/export', 'ExportController@export')->name('export');
    route::get('/export-csv-list','ListController@export_csv_list')->name('export_csv_list');
    route::get('/field-sort/{field_sort}','ListController@field_sort');
    route::get('/query-sort/{query_sort}','ListController@query_sort');

    route::post('/search-list-by-item','ListController@search_list_by_item');
    route::post('/search-list-by-id','ListController@search_list_by_id');
    route::post('/search-list-by-kojigyoya_name','ListController@search_list_by_kojigyoya_name');
    route::post('/search-list-all','ListController@search_list_all');

    route::get('/print-list','PrintController@print_list');
    route::Get('/detail-list','DetailController@detail_list');

    route::get('/search-detail/{id}','DetailController@search_detail')->name('search_detail');
    route::get('/search-print/{id}','PrintController@search_print')->name('search_print');

    route::post('/search-print','PrintController@post_search_print')->name('post_search_print');
    route::get('/search-print','PrintController@get_search_print')->name('get_search_print');

    route::get('/search-reply/{key_seacrch_reply}','ListController@search_reply');
    route::get('/search-no-reply/{key_seacrch_reply}','ListController@search_no_reply');
    //update post
    route::post('/post-update', 'PrintController@postUpdate')->name('postUpdate');

    Route::get('/uploads/{user}/{filename}', 'PageController@download_file')->name('downloadFile');
    

