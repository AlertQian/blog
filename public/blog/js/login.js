$(function(){
	if(navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){
        $('.login').addClass('mid');
    }
	$('button[type=submit]').click(function(e){
		e.preventDefault();
		var name=$("#name").val().trim(),
		    pwd=$("#pwd").val().trim(),
            check=$('input[type=checkbox]:checked').val(),
            $this=$(this);
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
        	data:{'name':name,'pwd':pwd,'check':check},
            beforeSend:function(){$this.text('登录中...')},
        	success:function(data){
        		if(data.code==1){
        			setTimeout(function(){
                        $this.text('登录成功');
        				location.href="/myadmin/index/index";
        			},1500)
        			
        		}else{
        			$.tip(data.msg);
                    $this.text('登录');
        		}
        	},
        	error:function(){
        		$.tip('网络繁忙');
        	}
        });
        	
	})
})