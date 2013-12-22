$(document).ready(function(){ 
    $(".navbar .nav>li>a, .nav-list>li>a").css({"opacity":"0.7"});
    $(".navbar .nav>li>a, .nav-list>li>a").hover(function(){
		$(this).stop().fadeTo("fast", 1);
	}, function() {
		$(this).stop().fadeTo("slow", 0.7);
	});
});