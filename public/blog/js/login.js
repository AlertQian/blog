$(function(){
	if(navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){
        $('.login').addClass('mid');
    }
	$('button[type=submit]').click(function(){
		
		var name=$("#name").val().trim(),
		    pwd=$("#pwd").val().trim(),
            check=$('input[type=checkbox]:checked').val();
        if (name.length == 0) {
        	$.tip('请填写您的大名！');
        	return false;
        } 
        if (pwd.length==0) {
        	$.tip('密码不能为空！');
        	return false;
        }   
        $.ajax({
        	url:"/myadmin/login/loginsave",
        	type:"post",
        	data:{name:name,pwd:pwd,check:check},
        	success:function(msg){
        		/*if(data.code==1){
        			$.tip(data.msg);
        			//console.log(data.url);
        			location.href="/myadmin/index/index";
        		}else{
        			$.tip(data.msg);
        			location.href=data.url;
        		}*/
        		switch(msg){
        			case "ok":
        			    setTimeout(function(){
        			    	$.tip("ok");
        			    	location.href="http://www.baidu.com";
        			    },1500);
        			    break;
        			case "error": 
        			    setTimeout(function(){
        			    	$.tip("error");
        			    	location.href="http://www.gz91.com";
        			    },1500);  
        			    break; 
        			default:
        			    $.tip("有误");
        			    break; 
        		}
        	},
        	error:function(){
        		$.tip('网络繁忙');
        	}
        });
        	
	})
})