$(document).ready(function() {
	var w_width = $(document).width();
	if(w_width < 1367) {
		$("#main").removeClass("bscreen").addClass("sscreen");
	}
	$(document).on("click", ".r-choose .car-series", function() {
		$("#selectcar").toggle();
	});
	$(document).on("click", "#selectcar ul li", function() {
		var carmodel = $(this).find(".carmodel");
        var typeid = $(carmodel).attr("typeid");
		$(".r-choose .car-series").text($(carmodel).text());
        $("input[name='typeid']").val(typeid);
		$("#selectcar").hide();
	});
	$(document).on("click", "#main .r-sells .sealer", function() {
		window.location.href='/sell/index/merchant';
	});
	$(document).on("click", "#main .r-sells .sFour", function() {
		window.location.href='/sell/index/fourshop';
	});
	$(document).on("click", "#main .r-sells .self", function() {
		window.location.href='/sell/index/selfperson';
	});
	$(document).on("click", "#vote .right", function() {
        $.ajax({
            type: "POST",
            url: "/report/index/voteReport",
            data: "voteType=right&typeId="+$("#typeid").val(),
            success: function(msg){
                var res = $.parseJSON(msg);
                if(res.code == "200") {
                    var rightNum = $("#vote .vote .scale-num .font-blue").text();
                    var totalNum = $("#vote .vote .user-num .total-vote").text();
                    $("#vote .vote .scale-num .font-blue").text(parseInt(rightNum)+1);
                    $("#vote .vote .user-num .total-vote").text(parseInt(totalNum)+1);
                    genVote(parseInt(totalNum)+1, parseInt(rightNum)+1);
                }else if(res.code == "101") {
                    layer.msg('您好，您已经对这款车型投过票了，谢谢参与。');
                }
            }
        });
	});
	$(document).on("click", "#vote .no-right", function() {
        $.ajax({
            type: "POST",
            url: "/report/index/voteReport",
            data: "voteType=noright&typeId="+$("#typeid").val(),
            success: function(msg){
                var res = $.parseJSON(msg);
                if(res.code == "200") {
                    var rightNum = $("#vote .vote .scale-num .font-blue").text();
                    var noRightNum = $("#vote .vote .scale-num .font-gray").text();
                    var totalNum = $("#vote .vote .user-num .total-vote").text();
                    $("#vote .vote .user-num .total-vote").text(parseInt(totalNum)+1);
                    $("#vote .vote .scale-num .font-gray").text(parseInt(noRightNum)+1)
                    genVote(parseInt(totalNum)+1, parseInt(rightNum));
                }else if(res.code == "101") {
                    layer.msg('您好，您已经对这款车型投过票了，谢谢参与。');
                }
            }
        });
	});
});
function sellreport() {
	if(srcForm.check()) {
        var typeId = $("input[name='typeid']").val();
        var year = $("#year").text();
        var city = $("#city").attr("py");
        var mileage = $("input[name='mileage']").val();
        var serialId = $("input[name='serialId']").val();
        window.location.href="/sellreport/"+serialId+"/"+city+"/"+year+"/"+typeId+"/"+mileage+"/";
	}
}
function genVote(totalVote, goodVote) {
    if(goodVote != "0") {
        var point = (goodVote/totalVote).toFixed(2)*100;
        $("#vote .vote .scale .blue").animate({
            width: point+"%"
        }, 1000);
    }
}
