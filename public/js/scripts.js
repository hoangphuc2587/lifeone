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
    $(document).on('click','.search_id_and_name',function(){
        var data = [];
        sessionStorage.setItem('data_list_checkbox',JSON.stringify(data));
        var input_id    = $('#i0tgl7-2-2').val();
        var name  = $('#if8qmi').val();
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
        if(id !== '' && name !== ''){
            $.ajax({
                url     : '/search-list-by-id-and-name',
                type    : 'POST',
                data    : {id:id,name:name},
                cache   : false,
                success : function(data){
                    console.log(data)
                    window.location = '/list';
                }
            });
            return;
        }
        if(id !== ''){
            $.ajax({
                url     : '/search-list-by-id',
                type    : 'POST',
                data    : {id:id},
                cache   : false,
                success : function(data){
                    console.log(data)
                    window.location = '/list';
                }
            });
            return;
        }
        if(name !== ''){
            $.ajax({
                url     : '/search-list-by-kojigyoya_name',
                type    : 'POST',
                data    : {name : name},
                cache   : false,
                success : function(data){
                    window.location = '/list';
                }
            });
        }
        if(id === '' && name === ''){
            $.ajax({
                url     : '/search-list-all',
                type    : 'POST',
                data    : {name:name},
                cache   : false,
                success : function(data){
                    window.location = '/list';
                }
            });
        } 
    })
    $(document).on('click','#home',function(){
        window.location = '/home';
    })
    $('#i0tgl7-2-2').bind('paste',function(e){
        var str = e.originalEvent.clipboardData.getData('text');
        var data = '';
        for(let i=0 ; i< str.length ; i++){
            if(   (str.charCodeAt(i) == 13)  || (str.charCodeAt(i + 1) == 10)){
                i++;
                data += ',';
                continue;
            }
            else{
                data += str[i]; 
            }
        }
        setTimeout(function () { 
            $('#i0tgl7-2-2').val(data); 
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
    $(document).on("keypress", ".form_list", function(event) { 
        return event.keyCode != 13;
    });
    $(document).on('click','.save_list_checkbox',function(){
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
        $('.error').trigger('click');
    })
    $(document).on('click','#a2s1',function(){
        $('#check_all').trigger('click');
        var flag = false;
        var list_check_box = document.getElementsByName('check_box_list[]');
        for(let i=0 ; i < list_check_box.length ; i++){
            if(list_check_box[i].checked == true){
                flag = true;
            }
        }
        if(flag){
            sessionStorage.setItem('inputCheckAll',JSON.stringify(1));
        }
        else{
            sessionStorage.removeItem('inputCheckAll',JSON.stringify(0));
        }
        
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
    $(document).on('click','.fas',function(){
        $('#cvnwefj43').slideToggle();
    })
})