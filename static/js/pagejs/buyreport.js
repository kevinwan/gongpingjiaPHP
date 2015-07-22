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
	$.each($(".r-list .item .carinfo"), function(i, n) {
		var title = $(n).find(".font-bold");
		var h = $(n).parents(".wrap").height();
		var title_h = h - $(title).height();
		$(n).css("top", title_h-20);
		$(n).hover(function() {
			$(this).animate({top: h-$(n).height()-20}, "fast");
		}, function() {
			$(this).animate({top: title_h-20}, "fast");
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