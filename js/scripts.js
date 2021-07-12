const windowWidth = parseInt(window.innerWidth);
let takeTotalRowOnPage = JSON.parse(sessionStorage.getItem('takeTotalRowOnPage'));
if((windowWidth <= 768) && !takeTotalRowOnPage && window.location.pathname == '/list'){
    $.ajax({
        url : $("#link-home-url").val() + '/take-total-row-on-one-page/' + 10,
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
    $('body').on('change','#icb8hk',function(){
        var total_row_on_one_page = $(this).val();
        $.ajax({
            url : $("#link-home-url").val() +'/take-total-row-on-one-page/' + total_row_on_one_page,
            success:function(data){
                window.location.reload();
            }
        })
    });
    
    $('body').on('change','#illur5',function(){
        var field_sort = $(this).val();
        $.get($("#link-home-url").val() + '/field-sort/'+field_sort,function(data){
            window.location = $("#link-home-url").val() + '/list';
        })
    });
    $('body').on('change','#imrevo',function(){
        var query_sort = $(this).val();
        console.log(query_sort)
        $.get($("#link-home-url").val() +'/query-sort/'+query_sort,function(){
           window.location = $("#link-home-url").val() + '/list';
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
            url  : $("#link-home-url").val() + '/get-list-checkbox',
            type : 'POST',
            cache : false,
            data : {data_list_checkbox:data_list_checkbox} ,
            success:function(data){
            }
        }) 
    })

    $(document).on('keypress','.form_list input, .form_list select',function(e){
        var p = e.which;
        if(p==13){           
           $('.search_by_item').trigger('click');
        }
    })

    $(document).on('click','#btnBackList',function(){
        if ($(".hdHasSTS01").val() == '1' && $('#hdUserLifeOne').val() ==  0)
        {
           $("#modalOrder").modal('show');
        }else{
           window.location = $("#link-home-url").val() + '/list';            
        }

    })    

    $(document).on('click','#btn-back',function(){
        if($("#form_detail").data("changed")){
            $("#static1").modal('show');
        }else{
            $('#btnBackList').trigger('click'); 
        }
        
    })

    $(document).on('click','.search_reply',function(){
        var search_reply = $(this)[0];
        $.get($("#link-home-url").val() + '/search-reply/'+search_reply.checked,function(data){
            window.location = $("#link-home-url").val() + '/list';
        })
    })
    $(document).on('click','.search_no_reply',function(){
        var search_reply = $(this)[0];
        $.get($("#link-home-url").val() + '/search-no-reply/'+search_reply.checked,function(data){
            window.location = $("#link-home-url").val() + '/list';
        })   
    })

    $(document).on('click','.search_by_reset',function(){        
        $.get($("#link-home-url").val() + '/search-by-reset',function(data){
            var data = [];
            sessionStorage.setItem('data_list_checkbox',JSON.stringify(data));
            sessionStorage.setItem('load_page',JSON.stringify(true));
            window.location = $("#link-home-url").val() + '/list';
        })   
    })
        


    $(document).on('click','.search_by_item',function(){
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
            url     : $("#link-home-url").val() + '/search-list-by-item',
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
                window.location = $("#link-home-url").val() + '/list';
            }
        });
        return;
    })
    $(document).on('click','#home',function(){
        window.location = $("#link-home-url").val() + '/home';
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
        }else{
            var urls = [];
            var v  = $(this).val();
            var idOrder = '0';
            for(let i = 0 ; i < data.length ; i++){
                if (data[i] != idOrder){
                    if (v == 'submit_print_pdf'){
                        urls.push($("#chk"+data[i]).data('pdf'));
                    }else if (v == 'submit_print_excel'){
                        urls.push($("#chk"+data[i]).data('excel'));
                    }                    
                }
                idOrder = data[i];
            }        
            if (urls.length > 0){
                download(urls); 
            }
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
            url  : $("#link-home-url").val() + '/get-list-checkbox',
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
    if($('.save_list_checkbox').length) {
        if ($("#hdUserLifeOne").val() == '0'){
            var list_checkbox_sessionLocalStorage = JSON.parse(sessionStorage.getItem('data_list_checkbox'));
            var data_list_checkbox = [];
            if(list_checkbox_sessionLocalStorage && list_checkbox_sessionLocalStorage.length != 0){
                data_list_checkbox = list_checkbox_sessionLocalStorage;
            }
            $( ".save_list_checkbox").each(function( index ) {
                if ($(this).is(':checked')){ 
                    data_list_checkbox.push($(this)[0].value);
                    data_list_checkbox.sort();
                    sessionStorage.setItem('data_list_checkbox',JSON.stringify(data_list_checkbox));
                }
            });        
            if (data_list_checkbox.length > 0){
                $.ajax({
                    cache : false,
                    url  : $("#link-home-url").val() + '/get-list-checkbox',
                    type : 'POST',
                    data : {data_list_checkbox:data_list_checkbox} ,
                    success:function(data){
                        isFirst = false;
                    }
                })
            }
        }
    }
 

    $(document).on('click','#adfkgj85',function(){
        $('#submit_detail_mobile').click();
    })

    $(document).on('click','#adfkgj85',function(){
        $('#submit_detail_mobile').click();
    })

    $(document).on('change','.txt-free',function(){
        console.log();
        $.ajax({
            cache : false,
            url  : $("#link-home-url").val() + '/update-text-free',
            type : 'POST',
            data : {id:$(this).data('id'), value: $(this).val()} ,
            success:function(data){
                isFirst = false;
            }
        })
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
            url  : $("#link-home-url").val() + '/get-list-checkbox',
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

    $(document).on('click','#btn-save-data',function(){
        $("#static").modal('show');
    })


    $(document).on('click','.btn-update-data-1',function(){       
       var isComment = false;
       var idError = '';
       var comment = $('#hdUserLifeOne').val() == '1' ? '1' : '2';
       $( ".hdSTSCD").each(function( index ) {
            var hasCorrect = false;
            var hasError = false;
            var id = $(this).data('id');
            $('.error-'+id).fadeOut();
            $('.error-comment'+comment+'-'+id).fadeOut();
            var irai = $('.data-irai-cd-'+id).val();
            var sybet = $('.data-haiso-sybet-cd-'+id).val(); 
            var multi = $('.data-haiso-multi-flg-'+id).val(); 
            if ($('#hdUserLifeOne').val() == '0' && $(this).val() == '06' && sybet == '04' && irai == '03'){

                var val1 = $.trim($( ".item-hacyu-"+id+'-1').val());
                var val2 = $.trim($( ".item-hacyu-"+id+'-2').val());
                var val3 = $.trim($( ".item-hacyu-"+id+'-3').val());
                var val4 = $.trim($( ".item-hacyu-"+id+'-4').val());
                var val5 = $.trim($( ".item-hacyu-"+id+'-5').val());
                var val6 = $.trim($( ".item-hacyu-"+id+'-6').val());
                var val7 = $.trim($( ".item-hacyu-"+id+'-7').val());

                if (val1 == '' && val2 == ''){
                    hasError = false;
                }else if(val1 != '' && val2 != ''){
                    hasError = false;
                    hasCorrect = true;
                }else{
                    hasError = true;
                }                
               
                if(!hasCorrect){
                    if (val3 == '' && val4 == '' && val5 == '' && !hasError){
                        hasError = false;
                    }else if(val3 != '' && val4 != '' && val5 != ''){
                        hasError = false;
                        hasCorrect = true;
                    }else{
                        hasError = true;
                    }
                }

                if(!hasCorrect){
                    if (val6 == '' && val7 == '' && !hasError){
                        hasError = false;
                    }else if(val6 != '' && val7 != ''){
                        hasError = false;
                        hasCorrect = true;
                    }else{
                        hasError = true;
                    }
                }

                if (multi == '1' && !hasCorrect){
                    var val11 = $.trim($( ".item-hacyu-2-"+id+'-1').val());
                    var val22 = $.trim($( ".item-hacyu-2-"+id+'-2').val());
                    var val32 = $.trim($( ".item-hacyu-2-"+id+'-3').val());
                    var val42 = $.trim($( ".item-hacyu-2-"+id+'-4').val());
                    if (val11 == '' && val22 == '' && val32 == '' && val42 == '' && !hasError){
                        hasError = false;
                    }else if(val11 != '' && val22 != '' && val32 != '' && val42 != ''){
                        hasError = false;
                        hasCorrect = true;
                    }
                    else{
                        hasError = true;
                    }
                }

                if(!hasCorrect){
                    if (!$('.item-hacyu-chk-'+id).is(':checked') && !hasError){
                       hasError = false;                       
                    }else if ($('.item-hacyu-chk-'+id).is(':checked')){
                       hasCorrect = true;
                    }else{
                       hasError = true;   
                    }
                }
                if (!hasCorrect && hasError){
                    $('.error-'+id).fadeIn();
                    hasError = true;
                    if (idError == ''){
                      idError = id;
                    }
                }

            }

            var text_c = $('#comment'+comment+'-'+id).val();
            if (text_c.length > 1000){
                $('.error-comment'+comment+'-'+id).fadeIn();              
                if (idError == ''){
                      idError = id;
                }
                isComment = true;
            }
            
        });

       if(idError == ''){
          $('.btn-submit-data-1').trigger('click');
       }
       else{
          $("#static").modal('hide');
          $("#modalError").modal('show');
          if (isComment == true){
              $('html, body').animate({
                scrollTop: $('.error-comment'+comment+'-'+idError).offset().top -  400
              }, 2000);
          }else{
              $('html, body').animate({
                scrollTop: $('.error-'+idError).offset().top - 120
              }, 2000);
          }

       }
    })


    $(document).on('click','.btn-update-data-2',function(){
       var isComment = false;
       var idError = '';
       var comment = $('#hdUserLifeOne').val() == '1' ? '1' : '2';
       $( ".hdSTSCD").each(function( index ) {
            var hasCorrect = false;
            var hasError = false;
            var id = $(this).data('id');
            $('.error-'+id).fadeOut();
            $('.error-comment'+comment+'-'+id).fadeOut();
            var irai = $('.data-irai-cd-'+id).val();
            var sybet = $('.data-haiso-sybet-cd-'+id).val(); 
            var multi = $('.data-haiso-multi-flg-'+id).val(); 
            if ($('#hdUserLifeOne').val() == '0' && $(this).val() == '06' && sybet == '04' && irai == '03'){

                var val1 = $.trim($( ".item-hacyu-"+id+'-1').val());
                var val2 = $.trim($( ".item-hacyu-"+id+'-2').val());
                var val3 = $.trim($( ".item-hacyu-"+id+'-3').val());
                var val4 = $.trim($( ".item-hacyu-"+id+'-4').val());
                var val5 = $.trim($( ".item-hacyu-"+id+'-5').val());
                var val6 = $.trim($( ".item-hacyu-"+id+'-6').val());
                var val7 = $.trim($( ".item-hacyu-"+id+'-7').val());

                if (val1 == '' && val2 == ''){
                    hasError = false;
                }else if(val1 != '' && val2 != ''){
                    hasError = false;
                    hasCorrect = true;
                }else{
                    hasError = true;
                }                
               
                if(!hasCorrect){
                    if (val3 == '' && val4 == '' && val5 == '' && !hasError){
                        hasError = false;
                    }else if(val3 != '' && val4 != '' && val5 != ''){
                        hasError = false;
                        hasCorrect = true;
                    }else{
                        hasError = true;
                    }
                }

                if(!hasCorrect){
                    if (val6 == '' && val7 == '' && !hasError){
                        hasError = false;
                    }else if(val6 != '' && val7 != ''){
                        hasError = false;
                        hasCorrect = true;
                    }else{
                        hasError = true;
                    }
                }

                if (multi == '1' && !hasCorrect){
                    var val11 = $.trim($( ".item-hacyu-2-"+id+'-1').val());
                    var val22 = $.trim($( ".item-hacyu-2-"+id+'-2').val());
                    var val32 = $.trim($( ".item-hacyu-2-"+id+'-3').val());
                    var val42 = $.trim($( ".item-hacyu-2-"+id+'-4').val());
                    if (val11 == '' && val22 == '' && val32 == '' && val42 == '' && !hasError){
                        hasError = false;
                    }else if(val11 != '' && val22 != '' && val32 != '' && val42 != ''){
                        hasError = false;
                        hasCorrect = true;
                    }
                    else{
                        hasError = true;
                    }
                }

                if(!hasCorrect){
                    if (!$('.item-hacyu-chk-'+id).is(':checked') && !hasError){
                       hasError = false;                       
                    }else if ($('.item-hacyu-chk-'+id).is(':checked')){
                       hasCorrect = true;
                    }else{
                       hasError = true;   
                    }
                }
                if (!hasCorrect && hasError){
                    $('.error-'+id).fadeIn();
                    hasError = true;
                    if (idError == ''){
                      idError = id;
                    }
                }

            }

            var text_c = $('#comment'+comment+'-'+id).val();
            if (text_c.length > 1000){
                $('.error-comment'+comment+'-'+id).fadeIn();              
                if (idError == ''){
                      idError = id;
                }
                isComment = true;
            }
            
        });

       if(idError == ''){
        $('.btn-submit-data-2').trigger('click');
       }
       else{
          $("#static1").modal('hide');
          $("#modalError").modal('show');
          if (isComment == true){
              $('html, body').animate({
                scrollTop: $('.error-comment'+comment+'-'+idError).offset().top -  400
              }, 2000);
          }else{
              $('html, body').animate({
                scrollTop: $('.error-'+idError).offset().top - 120
              }, 2000);
          }
       }
    })


    $(document).on('click','.col-order',function(){ 
        var field_sort = $(this).data('col');
        $.get($("#link-home-url").val() + '/field-sort/'+field_sort,function(data){
            window.location = $("#link-home-url").val() + '/list';
        })
    });


    $(document).on('click','.btn-add-file',function(){       
        var id = $(this).data('id');
        var index = $("#hdIndex").val();        
        var item = '.btn-' + id + '-' + index;
        var input =  '<input type="file" onchange="uploadFile(\''+ id +'\', '+ index +')" class="btn-file-upload btn-'+id+'-'+index+'" name="data['+id+'][FILE][]">';

        var html =  '<tr style="display:none" class="line-'+ id + '-' + index+'">';
            html += '<td>'+$("#hdSourceName").val()+'</td>'
            html += '<td>'+input+'</td>';
            html += '<td><input data-link="" data-tfile="" data-id="'+id + '-' + index+'" class="chk-'+id+' tb_list_checkbox" type="checkbox" value=""></td>';
            html += '</tr>';
        $( html ).appendTo( '.tbody-upload-'+id );
        index = parseInt(index)  + 1;
        $("#hdIndex").val(index);
        $(item).click();
    })

    $(document).on('click','.btn-delete-file',function(){ 
        var id = $(this).data('id');
        var arrID = new Array();
        var hasData = false;
        $( ".chk-" + id ).each(function( index ) {
            if ($(this).is(':checked')){
                hasData = true
            }
        });
        if (hasData){
            $( ".chk-" + id ).each(function( index ) {
                var line = $(this).data('id');
                var id_db = $(this).data('tfile');
                if ($(this).is(':checked')){
                    if (id_db != ''){
                      arrID.push(id_db);    
                    }
                }
            });
            $(".hdFileDelete"+id).val(arrID.join());
            $("#modalDelFile").modal('show');
        }else{
            $("#canceler1").modal('show');
        }
    })

    $(document).on('click','.btn-download-file',function(){ 
        var id = $(this).data('id');
        var hasData = false;
        $( ".chk-" + id ).each(function( index ) {
            if ($(this).is(':checked')){
                hasData = true;
            }
        });
        if (hasData){
            var urls = [];
            $( ".chk-" + id ).each(function( index ) {
                if ($(this).is(':checked')){
                    urls.push($(this).data('link'));
                }
            });
            if (urls.length > 0){
                download(urls); 
            } 
        }else{
            $("#canceler1").modal('show');
        }       
    }) 

    $(document).on('click','#btnDowloadPDF',function(){        
        var urls = [];
        $( ".link-download-pdf" ).each(function( index ) {
            urls.push($(this).val());
        });
        if (urls.length > 0){
            download(urls); 
        } 
    })

    $(document).on('click','#btnDowloadExcel',function(){ 
        var urls = [];
        $( ".link-download-excel" ).each(function( index ) {
            urls.push($(this).val());
        });
        if (urls.length > 0){
            download(urls); 
        } 
    })    
    

    $(document).on('click','.chkTaiOCd1',function(){  
       if ($(this).is(':checked')){ 
           $('.chkTaiOCd2').prop('checked', false); 
       }
    }) 

    $(document).on('click','.chkTaiOCd2',function(){  
       if ($(this).is(':checked')){ 
           $('.chkTaiOCd1').prop('checked', false); 
       }    
    })

    $("#form_detail :input").change(function() {
       $("#form_detail").data("changed",true);
    });  

    $(".txt-suryo").on("keypress keyup blur",function (event) {    
       $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(document).on('change','.txt-suryo',function(){
      var strId = $(this).data('id');
      var arr = strId.split("-");
      var id = arr[0];
      var iddetail = arr[1];
      var n_value = parseInt($(this).val());
      var d_value = parseInt($(this).data('value'));      
      if (n_value > d_value || n_value == '' || n_value == 0){
        $("#modalCaclTotal").modal('show');
        $(this).val(d_value);       
      }
      else{        
        $(this).attr('data-value', n_value);
        var zeinuki = parseInt($(this).data('zeinuki'));
        var nebiki = parseInt($(this).data('nebiki'));
        var tr = $(this).parent().parent();

        tr.find('input').each(function(){ 
            if ($(this).hasClass('KINGAK')){
                this.value = numberWithCommas(zeinuki * n_value);
            }else if ($(this).hasClass('NEBIKI_GAK')){
                this.value = numberWithCommas(nebiki * n_value);
            }            
        });

        var ob = $(tr).clone();
        var newNo = parseInt($(".hdSPLITNO-"+id).val()) + 1;
        ob.find('input').each(function(){ 
            var nameStr = this.name;
            var oldNo = $(this).data('no');
            var newVal = d_value - n_value;
            if (nameStr.indexOf("SURYO") > 0){
                this.value = newVal;
                $(this).attr('data-value', newVal);
                
            }else if ($(this).hasClass('KINGAK')){
                this.value = numberWithCommas(zeinuki * newVal);
            }else if ($(this).hasClass('NEBIKI_GAK')){
                this.value = numberWithCommas(nebiki * n_value);
            } else{
                this.value = '';
               
                $(this).datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    language: 'ja'
                });

                $(this).datepicker()
                .on('changeDate', function(e) {
                    var new_val =  this.value;
                    var $this = this;         
                    var d_value = $(this).data('value');
                    if (d_value == ''){              
                       $(this).val(new_val);
                    }
                });              
            }             
            this.name =  nameStr.replace(iddetail+"-"+oldNo, iddetail+"-"+newNo);
            $(this).attr('data-no', newNo);
        });   
        tr.after(ob);
        $(".hdSPLITNO-"+id).val(newNo);
      }
    })

    if($('.datepicker-input').length) {
        $('.datepicker-input').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'ja'
        });

        $('.datepicker-input').datepicker()
        .on('changeDate', function(e) {            
            var new_val =  this.value;
            var $this = this;         
            var d_value = $(this).data('value');
            var id =  $(this).data('hacyuid');
            var sybet = $('.data-haiso-sybet-cd-'+id).val(); 
            if (d_value == '' || CompareDate(new_val, d_value) == false){  
               var d_check = new_val.replace(/\//g,"-") 
               if (sybet == '01' && holidays.includes(d_check)){
                    $("#modalHolidays").modal('show'); 
                    setTimeout(function(){ $this.value = d_value; }, 1000);
               }else{
                    $(this).val(new_val);
               }                
            }
            else{
               $("#modalCallLifeOne").modal('show'); 
               setTimeout(function(){ $this.value = d_value; }, 1000);
            }
        });
    }

    if($('.datepicker-change').length) {
        $('.datepicker-change').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'ja'
        });

        $('.datepicker-change').datepicker()
        .on('changeDate', function(e) {
            var id = $(this).data('id');
            var $this = this;
            var new_val =  this.value;
            var sybet = $('.data-haiso-sybet-cd-'+id).val(); 
            var d_check = new_val.replace(/\//g,"-") 
            if (sybet == '01' && holidays.includes(d_check)){
                 $("#modalHolidays").modal('show');
                 $this.value = ''; 
            }else{
                $( ".date-" + id ).each(function( index ) {
                    var d_value = $(this).data('value');
                    if (d_value == '' || CompareDate(new_val, d_value) == false){
                       $(this).val(new_val);
                    }
                    else{
                       $("#modalCallLifeOne").modal('show');
                       $this.value = '';
                       $(this).val(d_value);
                    }
                });
            }    
        });
    }

    if($('#hdHasSTS01Load').length) {
        if ($('#hdHasSTS01Load').val() ==  1 && $('#hdUserLifeOne').val() ==  0 ){
            $("#modalOrder").modal('show');
        }
    }

    if($('.autocomplete').length) {
        $('.autocomplete').autocomplete({
            source: driverList,
            minLength: 0
        }).focus(function(){            
            $(this).data("uiAutocomplete").search($(this).val());
        });
    }    
})

function download(files) {
    $.each(files, function(key, value) {
        $('<iframe></iframe>')
            .hide()
            .attr('src', value)
            .appendTo($('body'))
            .load(function() {
                var that = this;
                setTimeout(function() {
                    $(that).remove();
                }, 100);
            });
    });
}

 function CompareDate(date1 , date2) {
    if (date1 != ''  & typeof(date2) != 'undefined' && date2 != ''){
        var a = parseInt(date1.replace(/\//g,""),10);
        var b = parseInt(date2.replace(/\//g,""),10);
        if(a > b){
           return true;
        }else{
           return false; 
        }       
    }
    return false;
} 

function uploadFile(id, index){   
   $('.btn-submit-data-1').trigger('click');
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}