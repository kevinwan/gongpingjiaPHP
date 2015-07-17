$(document).ready(function() {
	var w_width = $(document).width();
	if(w_width < 1367) {
		$("#main").removeClass("bscreen").addClass("sscreen");
	}
	$(document).on("click", "#search-container .sbtn .sbtn-wrap", function() {
		var sbtn = $(this).parent(".sbtn");
		if($(sbtn).hasClass("active")) {
			$(sbtn).removeClass("active");
		}else {
			$(sbtn).siblings(".active").removeClass("active").addClass("smr");
			$(sbtn).addClass("active").removeClass("smr");
		}
	});
});