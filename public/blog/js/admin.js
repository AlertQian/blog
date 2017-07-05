$(function(){
	//JQ a标签点击改变样式
	$(".group-list a").bind('click',function(){
		$('.group-list a:not(this)').removeClass('active');
		$(this).addClass('active');
	})

})