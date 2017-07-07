$(function(){
	//JQ a标签点击改变样式
	$(".group-list a").bind('click',function(){
		$('.group-list a:not(this)').removeClass('active');
		$(this).addClass('active');
	})
    //修改管理员信息
    $("#upadmin").on('click',function(e){
    	e.preventDefault();
    	var newname=$("#newname").val().trim(),
			oldpwd=$("#oldpwd").val().trim(),
    	    newpwd=$("#newpwd").val().trim(),
    	    againpwd=$("#againpwd").val().trim();
    	if(newname.length == 0){
    		$.tip("请输入新用户名");
    		return false;
    	}  
    	if(oldpwd.length == 0){
    		$.tip("请输入原始密码");
    		return false;
    	}  
    	if(newpwd.length == 0){
    		$.tip("请输入新密码");
    		return false;
    	}
    	if(againpwd.length == 0){
    		$.tip("请重复密码");
    		return false;
    	}

		if(newpwd !== againpwd){
    		$.tip("两次密码不一致");
    		return false;
    	}
    	$.ajax({
    		url:'upadmin',
    		type:"post",
    		data:{newname:newname,oldpwd:oldpwd,newpwd:newpwd},
    		beforeSend:function(){
    			$(".fakeloader").fakeLoader({
                    timeToHide:1200,
                    bgColor:"#D6D7D9",
                    spinner:"spinner2"
                });
    		},
    		success:function(msg){
    			switch(msg){
    				case "name_toolong":
    					$.tip('用户名不能超过10个字符');
    					break;
    			    case "pwd_wrong":
    					$.tip('密码不能小于六位数');
    					break;
    			    case "ok":
    					$.tip('更新成功');
    					break;
    			    case "error":
    					$.tip('更新失败');
    					break;
    				case "pwd_error":
    					$.tip('原密码错误');
    					break;
    			    default:
    			        $.tip('系统繁忙，稍后再试');
    			        break;								
    			}
    		},
    		error:function(){
    			$.tip('网络繁忙');
    		}
    	})
    	
    })
    //更新系统信息
    $("#upinfo").on('click',function(e){
    	e.preventDefault();
    	var title=$("#title").val().trim(),
			signature=$("#signature").val().trim(),
    	    webinfo=$("#webinfo").val().trim();
    	if(title.length == 0){
    		$.tip("请输入站点标题");
    		return false;
    	}   
    	if(webinfo.length == 0){
    		$.tip("请输入站点信息");
    		return false;
    	}
    	$.ajax({
    		url:'upinfo',
    		type:"post",
    		data:{title:title,signature:signature,webinfo:webinfo},
    		beforeSend:function(){
    			$(".fakeloader").fakeLoader({
                    timeToHide:1200,
                    bgColor:"#D6D7D9",
                    spinner:"spinner3"
                });
    		},
    		success:function(data){
    			if(data.code==1){
    				$.tip(data.msg);
        		}else{
        			$.tip(data.msg);
        		}				
    			
    		},
    		error:function(){
    			$.tip('网络繁忙');
    		}
    	})
    	
    })

})