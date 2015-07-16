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
		$(".r-choose .car-series").text($(carmodel).text());
		$("#selectcar").hide();
	});
});
function sellreport() {
	if(srcForm.check()) {
		alert("1");
	}
}