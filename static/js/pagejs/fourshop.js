$(document).ready(function() {
    $(document).on("click", ".content .fourshops .fourshop", function() {
        var theobj = $(this).attr("id");
        var thiary = theobj.split("_");
        window.location.href='/sell/index/personinfo?infoId='+thiary["1"]+"&comName="+$(this).attr("title");
    });
    $(document).on("click", ".content .saler_other", function() {
        $(".fourshops .otherDealers").slideDown();
        $(this).hide();
    });
});
