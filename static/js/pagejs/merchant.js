$(document).ready(function() {
	$(document).on("click", ".saler_main .saler_choose .saler_choose_part", function() {
		var theobj = $(this).attr("id");
		var thiary = theobj.split("_");
		window.location.href='/sell/index/personinfo?infoId='+thiary["1"];
	});
    $(document).on("click", ".saler_main .saler_other", function() {
        $(".saler_main .saler_choose .otherDealers").slideDown();
        $(this).hide();
    });
});
