var conf = {
	colwidth: 290,//列宽
	cols: 0,//列数
	rule: 0,//列间距
	lr: 25,//左右预留空白
	mb: 25,//上下间距
}

//计算列数
conf.cols = parseInt($("#contentarea .right").width()/conf.colwidth);
//计算列间距
conf.rule = parseInt(($("#contentarea .right").width()%conf.colwidth-conf.lr*2)/(conf.cols-1));

// 用来存放每列高度的数组
var harr = [0,0,0];

// 用来请求数据的函数
function getdata(p){
    $.ajax({
        url:"/?m=studentlog&action=controller/entry/show&id=11&page="+p,//数据发送地址
        type: 'post',
        dataType:'json',
        success:function(data){
            for (var i = 0; i < data.data.length; i++) {
                var d = data.data[i];
                if (harr[0]<=harr[1] && harr[0]<=harr[2]) {
                    var high = 0;
                }
                if (harr[1]<=harr[0] && harr[1]<=harr[2]) {
                    var high = 1;
                }
                if (harr[2]<=harr[1] && harr[2]<=harr[0]) {
                    var high = 2;
                }
                var newli = "<li><img src='"+d.member.icon+"'/><p>"+d.member.nickname+"</p><p>"+d.content+"</p></li>";
                $('.weekly').append(newli);
                $(".weekly li").last().css({top:harr[high],left:conf.colwidth*(high)+conf.rule*(high)+conf.lr,width:conf.colwidth});
                harr[high] = harr[high]+$(".weekly li").last().outerHeight()+conf.mb;
                $(".weekly").height(Math.max(harr[0],harr[1],harr[2]));
            }
        }
    })
}


// 页面打开后请求一次数据
getdata(1);


var st;
var page = 1;
//滚动条
$(window).scroll(function(){
	clearTimeout(st);
	st = setTimeout(function(){
        var t = $(document).scrollTop();
        var dheight = $(document).height();
        if (dheight - t - $(window).height()<600) {
        	page++;
            getdata(page);
        }
	},100)
})