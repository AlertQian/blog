var out={
    box_auto:function(id){
        var winW = $(window).width()
            ,winH = $(window).height()
            ,$boxa=$("#"+id)
            ,boxW = $boxa.width()
            ,boxH = $boxa.height()
            ,$ie6=!$.support.opacity && !$.support.style && window.XMLHttpRequest==undefined;
        if(winW>boxW) $boxa.css("left",(winW-boxW)/2)
        
        if(navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){
           $boxa.css("top",(winH-boxH)/2.3)
        }else{
           if(winH>boxH) $boxa.css("top",(winH-boxH)/3)
        }
        if($ie6 && $(window).scrollTop()>0) $boxa.css("top",(winH-boxH)/2+$(window).scrollTop())
    }
    ,etip:function(msg,t){
        var id="errorDialogBtn",
            str=''
                +'<div id="errorDialogBtn" class="mobileSina_err btn_err">'
                +'	<div id="errorDialogBtnMsg" class="err_info">'+msg+'</div>'
                +'	<div id="errorBtn" class="err_btn"></div>'
                +'</div>'
        $("#errorDialogBtn").remove();
        $("body").append(str)
        out.box_auto(id)
        $("#"+id).show()
        if(t===false)return
        setTimeout(function(){$("#"+id).remove()},t||2500)
    }
};
$.tip=out.etip;