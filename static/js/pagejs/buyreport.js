$(document).ready(function() {
	var w_width = $(document).width();
	if(w_width < 1367) {
		$("#main").removeClass("bscreen").addClass("sscreen");
	}
    $(document).on("click", ".r-choose .car-series", function() {
        $("#selectcar").siblings(".popup").hide();
    	$("#selectcar").toggle();
    });
    $(document).on("click", ".r-choose .report-year", function() {
        $("#report-year").siblings(".popup").hide();
        $("#report-year").toggle();
    });
    $(document).on("click", ".r-choose .report-city", function() {
        $("#report-city").siblings(".popup").hide();
        $("#report-city").toggle();
    });
    $(document).on("click", "#report-year .itemyear", function() {
        $("#yearBox").text($(this).text());
        $("#report-year").hide();
        $("#year").val($(this).text());
    });
	$(document).on("click", "#selectcar ul li", function() {
		var carmodel = $(this).find(".carmodel");
		var typeid = $(carmodel).attr("typeid");
		$(".r-choose .car-series").text($(carmodel).text());
		$("input[name='typeid']").val(typeid);
		$("#selectcar").hide();
		sellreport2();
	});
    $(document).on("click", "#report-city ul li", function() {
        $("#cityBox").text($(this).text());
        $("#report-city").hide();
        $("#city").val($(this).text());
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
	$("#vote .no-right").hover(
		function() {
			$(this).addClass("shake animated");
		},
		function() {
			$(this).removeClass("shake animated");
		}
	);
	$("#vote .right").hover(
		function() {
			$(this).addClass("shakeTwo animated");
		},
		function() {
			$(this).removeClass("shakeTwo animated");
		}
	);
});
function sellreport() {
    var typeId = $("input[name='typeid']").val();
    var year = $("#year").val();
    var city = $("#citypy").val();
    var mileage = $("input[name='mileage']").val();
    var serialId = $("input[name='serialId']").val();
    if(parseFloat(mileage) > 0) {
        window.location.href="/buyreport/"+serialId+"/"+city+"/"+year+"/"+typeId+"/"+parseFloat(mileage)+"/";
    }else {
        layer.msg("请输入正确的里程数。");
    }
}
function sellreport2() {
    var typeId = $("input[name='typeid']").val();
    var city = $("#citypy").val();
    var serialId = $("input[name='serialId']").val();
	window.location.href="/buyreport/"+serialId+"/"+city+"/0/"+typeId+"/0/";
}
function genVote(totalVote, goodVote) {
    if(goodVote != "0") {
        var point = (goodVote/totalVote).toFixed(2)*100;
        $("#vote .vote .scale .blue").animate({
            width: point+"%"
        }, 1000);
    }
}