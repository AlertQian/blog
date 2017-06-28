$(function(){
	$('button[type=submit]').click(function(e){
		e.preventDefault();
		var name=$("#name").val(),
		    pwd=$("#pwd").val(),
            check=$('input[type=checkbox]:checked').val();
            $this=$(this);
        $.ajax({
        	url:"/index/login",
        	type:"post",
        	data:{name:name,pwd:pwd,check:check},
        	success:function(){

        	},
        	error:function(){
        		$.tip('网络繁忙');
        	}
        });
        	
	})
})