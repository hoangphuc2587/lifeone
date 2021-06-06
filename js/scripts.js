const windowWidth = parseInt(window.innerWidth);
let takeTotalRowOnPage = JSON.parse(sessionStorage.getItem('takeTotalRowOnPage'));
if((windowWidth <= 768) && !takeTotalRowOnPage && window.location.pathname == '/list'){
    $.ajax({
        url : 'take-total-row-on-one-page/' + 10,
        success:function(data){
            sessionStorage.setItem('takeTotalRowOnPage',JSON.stringify('true'));
            window.location.reload();
        }
    })   
}
$(function(){
    
    $.ajaxSetup({cache:false}); 
    
    if(window.location.pathname === '/search-print' ||  window.location.pathname === '/login'){
        var data = [];
        sessionStorage.setItem('data_list_checkbox',JSON.stringify(data));
        sessionStorage.setItem('load_page',JSON.stringify(true));
    }
    var load_page = JSON.parse(sessionStorage.getItem('load_page'))
    if(load_page && load_page == true && window.location.pathname == '/list'){
        window.location.reload();
        sessionStorage.setItem('load_page',JSON.stringify(false));
    }
    $(document).on('click','.single_choose',function(){
        var data = [];
        sessionStorage.setItem('data_list_checkbox',JSON.stringify(data));
        sessionStorage.setItem('load_page',JSON.stringify(true));
    })
    console.log(window.location.pathname);
    $('body').on('change','#icb8hk',function(){
        var total_row_on_one_page = $(this).val();
        console.log(total_row_on_one_page);
        $.ajax({
            url : 'take-total-row-on-one-page/' + total_row_on_one_page,
            success:function(data){
                window.location.reload();
            }
        })
    });
    
    $('body').on('change','#illur5',function(){
        var field_sort = $(this).val();
        $.get('/field-sort/'+field_sort,function(data){
            window.location = '/list';
        })
    });
    $('body').on('change','#imrevo',function(){
        var query_sort = $(this).val();
        console.log(query_sort)
        $.get('/query-sort/'+query_sort,function(){
            window.location = '/list';
        })
    })
    $(document).on('click','#check_all',function(){
        var current_list_check = document.getElementsByName('check_box_list[]');
        var flag_checkbox_all =  false;
        for(let i = 0 ; i < current_list_check.length ; i++){
            if(current_list_check[i].checked === true)
                flag_checkbox_all = true;
        }
        var list_check_box_all = document.getElementsByName('check_box_list[]');
        if(flag_checkbox_all === false){
            for(let i=0 ; i < list_check_box_all.length ; i++){
                list_check_box_all[i].checked = true;
                flag_checkbox_all = true;
            }
        }
        else{
            for(let i=0 ; i < list_check_box_all.length ; i++){
                list_check_box_all[i].checked = false;
                flag_checkbox_all = false;
            }
        }
        var list_check_box = document.getElementsByName('check_box_list[]');
        var list_checkbox_sessionLocalStorage = JSON.parse(sessionStorage.getItem('data_list_checkbox'));
        var data_list_checkbox = [];
        if(list_checkbox_sessionLocalStorage && list_checkbox_sessionLocalStorage.length != 0)
            data_list_checkbox = list_checkbox_sessionLocalStorage;
        var flag = false;
        for(let i=0 ; i < list_check_box.length ; i++){
            if( (list_check_box[i].checked === true  ) && ( data_list_checkbox.indexOf(list_check_box[i].value) === -1) ){
                data_list_checkbox.push(list_check_box[i].value);
                flag =true;
            }
            if( (list_check_box[i].checked === false ) && ( data_list_checkbox.indexOf(list_check_box[i].value) !== -1)){
                var index = data_list_checkbox.indexOf(list_check_box[i].value);
                data_list_checkbox.splice(index,1);
                flag = true;
            }
        }
        if(flag){
            data_list_checkbox.sort();
            sessionStorage.setItem('data_list_checkbox',JSON.stringify(data_list_checkbox));
        }  
        $.ajax({
            url  : '/get-list-checkbox',
            type : 'POST',
            cache : false,
            data : {data_list_checkbox:data_list_checkbox} ,
            success:function(data){
            }
        }) 
    })

    $(document).on('click','#btn-back',function(){
        window.location = '/list';
    })

    $(document).on('click','.search_reply',function(){
        var search_reply = $(this)[0];
        $.get('/search-reply/'+search_reply.checked,function(data){
            window.location = '/list';
        })
    })
    $(document).on('click','.search_no_reply',function(){
        var search_reply = $(this)[0];
        $.get('/search-no-reply/'+search_reply.checked,function(data){
            window.location = '/list';
        })   
    })
    $(document).on('click','.search_by_item',function(){
        var data = [];
        sessionStorage.setItem('data_list_checkbox',JSON.stringify(data));
        var input_id    = $('#search-id').val();
        var name  = $('#search-name').val();
        var request  = $('#search-request').val();
        var irai_day_from  = $('#search-irai-day-from').val();
        var irai_day_to  = $('#search-irai-day-to').val();
        var status  = $('#search-status').val();
        var maker  = $('#search-maker').val();
        var address  = $('#search-address').val();
        var nohin_day_from  = $('#search-nohin-day-from').val();
        var nohin_day_to  = $('#search-nohin-day-to').val();
        var hinban  = $('#search-hinban').val();

        var id = '';
        if(input_id.indexOf(',') != -1){
            for(let i=0 ; i < input_id.length ; i++){
                if(input_id[i] == ' '){
                    continue
                }
                id += input_id[i];
            }
        }
        else{
            id = input_id;
        }        
        $.ajax({
            url     : '/search-list-by-item',
            type    : 'POST',
            data    : 
            {
                name:name,
                request_id: request,
                irai_day_from: irai_day_from,
                irai_day_to: irai_day_to,
                id:id,
                status_id: status,
                maker: maker,
                address: address,
                nohin_day_from: nohin_day_from,
                nohin_day_to: nohin_day_to, 
                hinban: hinban
            },
            cache   : false,
            success : function(data){
                console.log(data)
                window.location = '/list';
            }
        });
        return;
    })
    $(document).on('click','#home',function(){
        window.location = '/home';
    })
    function browserName(){
        var Browser = navigator.userAgent;
        if (Browser.indexOf('MSIE') >= 0){
         Browser = 'MSIE';
        }
        else if (Browser.indexOf('Firefox') >= 0){
         Browser = 'Firefox';
        }
        else if (Browser.indexOf('Chrome') >= 0){
         Browser = 'Chrome';
        }
        else if (Browser.indexOf('Safari') >= 0){
         Browser = 'Safari';
        }
        else if (Browser.indexOf('Opera') >= 0){
           Browser = 'Opera';
        }
        else{
         Browser = 'UNKNOWN';
        }
        return Browser;
     }
    $('#search-id').bind('paste',function(e){
        const Browser = browserName();
        var data = '';
        var flag_space = false;
        if(Browser === 'Chrome' ){
            var str = e.originalEvent.clipboardData.getData('text');
        }
        else if(Browser === 'Firefox'){
            var str = e.originalEvent.clipboardData.getData('text');
            var result = '';
            // var array = str.split(/\s/g);
            var array = str.split(/\n/);
            if(array.length === 1){
                array[0] = array[0].trim();
                if(array[0].indexOf(' ') !== -1){
                    array[0] = array[0].split(' ');
                        let arr = array[0];
                        let data = [];
                        for(let i = 0 ; i <  arr.length ; i++){
                            if(arr[i] !== ''){
                                data.push(arr[i])
                            }
                        }
                        array[0] = data.join(',');
                }
                result = array[0];
            }
            else{
                for(let i=0 ; i< array.length ; i++){
                    array[i] = array[i].trim();
                    if(array[i].indexOf(' ') !== -1){
                        array[i] = array[i].split(' ');
                        let arr = array[i];
                        let data = [];
                        for(let i = 0 ; i <  arr.length ; i++){
                            if(arr[i] !== ''){
                                data.push(arr[i])
                            }
                        }
                        array[i] = data.join(',');
                    }
                    if((i === ( array.length - 1)) && (array[i] !== '')){
                        result += array[i];
                        break;
                    }
                    if(array[i] !== '')
                        result += array[i] + ",";
                }
            }
            setTimeout(function () { 
                $('#search-id').val(result); 
            }, 230);
            return;
        }
        else{
            var str = window.clipboardData.getData('Text');
        }
        str = str.trim();
        for(let i=0 ; i< str.length ; i++){
            if(   (str.charCodeAt(i) == 13)  || (str.charCodeAt(i + 1) == 10)){
                i++;
                data += ',';
                continue;
            }
            else{
                if((str.charCodeAt(i) == 32)){
                    if(flag_space == false){
                        data += ",";
                        flag_space = true;
                        continue;
                    }
                }else{
                    data += str[i];
                    flag_space = false; 
                } 
            }
        }
        setTimeout(function () { 
            $('#search-id').val(data); 
        }, 100);
    })
    $(document).on('click','.logout',function(){
        var data = [];
        sessionStorage.setItem('data_list_checkbox',JSON.stringify(data));
    })
    $(document).on('click','.error',function(e){
        var data = JSON.parse(sessionStorage.getItem('data_list_checkbox'));
        if( data === null || data.length == 0 ){
            e.preventDefault();
            $('#jumplist1').trigger('click');
            // swal({title : 'メッセージ',text :'明細が選択されていません !'})
            // .then((value) => {
            // })
        }
    })
    $(document).on('keypress',"#search-id",function(e){
        if(e.which === 44 || e.which == 32) // nếu kí tự nhập vào là dấu phẩy hoặc khoảng cách thì xử lý
            return true;
        if(e.which < 48 || e.which > 57) // nếu kí tự nhập vào không phải là số : 0 -> 9 thì xử lý
            return false;
        return true;
    })
    $(document).on("keypress", ".form_list", function(event) { 
        return event.keyCode != 13;
    });
    $(document).on('click','.save_list_checkbox',function(){
        var list_checkbox_sessionLocalStorage = JSON.parse(sessionStorage.getItem('data_list_checkbox'));
        var data_list_checkbox = [];
        if(list_checkbox_sessionLocalStorage && list_checkbox_sessionLocalStorage.length != 0){
            data_list_checkbox = list_checkbox_sessionLocalStorage;
        }
        if($(this)[0].checked === true){
            data_list_checkbox.push($(this)[0].value);
            data_list_checkbox.sort();
            sessionStorage.setItem('data_list_checkbox',JSON.stringify(data_list_checkbox));
        }
        else{
            data_list_checkbox.splice(data_list_checkbox.indexOf($(this)[0].value),1);
            data_list_checkbox.sort();
            sessionStorage.setItem('data_list_checkbox',JSON.stringify(data_list_checkbox));
        } 
        $.ajax({
            cache : false,
            url  : '/get-list-checkbox',
            type : 'POST',
            data : {data_list_checkbox:data_list_checkbox} ,
            success:function(data){
            }
        })    
    })
    var data_list_checkbox_sessionLocalStorage = JSON.parse(sessionStorage.getItem('data_list_checkbox'));
    if(data_list_checkbox_sessionLocalStorage && data_list_checkbox_sessionLocalStorage.length != 0){
        
        var list_check_box = document.getElementsByName('check_box_list[]');
        data_list_checkbox = data_list_checkbox_sessionLocalStorage;
        for(let i = 0 ; i < list_check_box.length ; i++){
            if(data_list_checkbox.indexOf(list_check_box[i].value) !== -1){
                list_check_box[i].checked = true;
            }
        }
    }
    $(document).on('click','#adfkgj85',function(){
        $('#submit_detail_mobile').click();
    })

    $(document).on('click','#adfkgj85',function(){
        $('#submit_detail_mobile').click();
    })

    $(document).on('click','#a2s1',function(){
        if($(this)[0].checked === true){
            var listCheckBox = document.getElementsByName('check_box_list[]');
            for(let i=0 ; i < listCheckBox.length ; i++){
                listCheckBox[i].checked = true ;
            }
            sessionStorage.setItem('inputCheckAll',JSON.stringify(1));
        }
        else{
            var listCheckBox = document.getElementsByName('check_box_list[]');
            for(let i=0 ; i < listCheckBox.length ; i++){
                listCheckBox[i].checked = false ;
            }
            sessionStorage.removeItem('inputCheckAll',JSON.stringify(0));
        }
        var list_check_box = document.getElementsByName('check_box_list[]');
        var list_checkbox_sessionLocalStorage = JSON.parse(sessionStorage.getItem('data_list_checkbox'));
        var data_list_checkbox = [];
        if(list_checkbox_sessionLocalStorage && list_checkbox_sessionLocalStorage.length != 0)
            data_list_checkbox = list_checkbox_sessionLocalStorage;
        var flag = false;
        for(let i=0 ; i < list_check_box.length ; i++){
            if( (list_check_box[i].checked === true  ) && ( data_list_checkbox.indexOf(list_check_box[i].value) === -1) ){
                data_list_checkbox.push(list_check_box[i].value);
                flag =true;
            }
            if( (list_check_box[i].checked === false ) && ( data_list_checkbox.indexOf(list_check_box[i].value) !== -1)){
                var index = data_list_checkbox.indexOf(list_check_box[i].value);
                data_list_checkbox.splice(index,1);
                flag = true;
            }
        }
        if(flag){
            data_list_checkbox.sort();
            sessionStorage.setItem('data_list_checkbox',JSON.stringify(data_list_checkbox));
        }  
        $.ajax({
            url  : '/get-list-checkbox',
            type : 'POST',
            cache : false,
            data : {data_list_checkbox:data_list_checkbox} ,
            success:function(data){
            }
        }) 
    })
    var inputCheckAll = JSON.parse(sessionStorage.getItem('inputCheckAll'));
    var flagListCheckBox = true;
    var listCheckBox = document.getElementsByName('check_box_list[]');
    for(let i=0 ; i < listCheckBox.length ; i++){
        if(listCheckBox[i].checked == false){
            flagListCheckBox = false;
        }
    }
    if(inputCheckAll && flagListCheckBox){
        $('#a2s1')[0].checked =  true;
    }
    $(document).on('click','.dropDown',function(){
        $('#cvnwefj43').slideToggle();
    })

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
    //$('.datepicker').datepicker("setDate", new Date());
    
    
})