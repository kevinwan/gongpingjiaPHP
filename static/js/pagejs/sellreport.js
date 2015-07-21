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
});
function sellreport() {
	if(srcForm.check()) {
		//alert("1");
				var typeId = $("input[name='typeid']").val();
				var year = $("#year").text();
				var city = $("#city").attr("py");
				var mileage = $("input[name='mileage']").val();
				var serialId = $("input[name='serialId']").val();
				window.location.href="/sellreport/"+serialId+"/"+city+"/"+year+"/"+typeId+"/"+mileage+"/";
	}
}
