$(document).ready(function () {
    var w_width = $(document).width();
    if (w_width < 1367) {
        $("#main").removeClass("bscreen").addClass("sscreen");
    }
    $(document).on("click", "#search-container .sbtn .sbtn-wrap", function () {
        var sbtn = $(this).parent(".sbtn");
        if ($(sbtn).hasClass("active")) {
            $(sbtn).removeClass("active");
        } else {
            $(sbtn).siblings(".active").removeClass("active").addClass("smr");
            $(sbtn).addClass("active").removeClass("smr");
        }
    });
    $(document).scroll(function () {
        totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
        if ($(document).height()-5 <= totalheight) {
            if (isScroll && parseInt(pageTotal) != 0) {
                isScroll = false;
                if (parseInt(pageTotal) >= parseInt(curPage) + 1 && parseInt(pageNo) + 2 > parseInt(curPage)) {
                    $("#tipinfo").show();
                    $.ajax({
                        type: "POST",
                        url: "/used/index/getUsedList",
                        data: "pageNo=" + (parseInt(curPage) + 1),
                        success: function (msg) {
                            isScroll = true;
                            $("#tipinfo").hide();
                            var res = jQuery.parseJSON(msg);
                            $.each(res.cars, function (i, n) {
                                $("#template .preview a").attr("href", n.url);
                                $("#template .preview img").attr("src", n.thumbnail);
                                $("#template .title").attr("title", n.title).html("<a href=\""+ n.url +"\">"+n.title+"</a>");
                                $("#template .info .usedl").html("&yen;" + n.price + "万");
                                $("#template .info .usedr .carage").text(n.car_age + "年");
                                $("#template .info .usedr .mileage").text(n.mile + "万公里");
                                if (n.source_type != "") {
                                    $("#template .tags ").html("<span class=\"tag " + n.source_val["bg"] + " \">" + n.source_val["name"] + "</span>");
                                } else {
                                    $("#template .tags ").text("");
                                }
                                $("#template .useditem").clone(true).appendTo($(".content .used-list"));
                            });
                            curPage = parseInt(curPage) + 1;
                        }
                    });
                } else {
                    $("#pager").show();
                }
            }

        }
    });
});