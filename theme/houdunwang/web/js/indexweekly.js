$(function(){

    setInterval(function(){
        $(".weekly").first().animate({height:0},1000,function(){
            $(".weekly").parent().append($(".weekly").first().height(160))
        });

    }, 3000);


})