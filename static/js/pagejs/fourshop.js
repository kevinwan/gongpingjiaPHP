$(document).ready(function() {
    $(document).on("click", ".content .fourshops .fourshop", function() {
        var theobj = $(this).attr("id");
        var thiary = theobj.split("_");
        window.location.href='/sell/index/personinfo?infoId='+thiary["1"];
    });
});
