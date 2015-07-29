$(document).ready(function () {
    var layerStatue = true;
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
                        data: "page="+(parseInt(curPage) + 1)+"&brandId="+$("#brandId").val()+"&minAge="+$("#minAge").val()+"&maxAge="+$("#maxAge").val()+"&minMile="+$("#minMile").val()+"&maxMile="+$("#maxMile").val()+"&classify="+$("#classify").val()+"&control="+$("#control").val()+"&minvolume="+$("#minvolume").val()+"&maxvolume="+$("#maxvolume").val()+"&order_key="+$("#order_key").val()+"&brandName="+$("#searchinput").val(),
                        success: function (msg) {
                            isScroll = true;
                            $("#tipinfo").hide();
                            var res = jQuery.parseJSON(msg);
                            $.each(res.cars, function (i, n) {
                                $("#template .useditem").attr("id", "used_"+n.id);
                                $("#template .preview a").attr("href", n.url);
                                $("#template .preview img").attr("src", n.thumbnail);
                                $("#template .title").attr("title", n.title).html("<a href=\""+ n.url +"\">"+n.title+"</a>");
                                $("#template .info .usedl").html("&yen;" + n.price + "万");
                                $("#template .info .usedr .carage").text(n.car_age + "年");
                                $("#template .info .usedr .mileage").text(n.mile + "万公里");
                                $("#template .price").text("正在估值中...");
                                if (n.source_type != "") {
                                    $("#template .tags ").html("<span class=\"tag " + n.source_val["bg"] + " \">" + n.source_val["name"] + "</span>");
                                } else {
                                    $("#template .tags ").text("");
                                }
                                $("#template .useditem").clone(true).appendTo($(".content .used-list"));
                                $.ajax({
                                    type: "POST",
                                    url: "/used/index/getValuaModel",
                                    data: "dmodel_id=" + n.dmodel_id + "&year=" + n.year + "&mile=" + n.mile + "&used_id=" + n.id,
                                    success: function (res) {
                                        var msg = jQuery.parseJSON(res);
                                        if(msg.dealPrice != "") {
                                            $("#used_"+msg.usedId+" .price").text("公平价值"+msg.dealPrice+"万");
                                        }else {
                                            $("#used_"+msg.usedId+" .price").text("暂无数据");
                                        }
                                    }
                                });
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
    $(document).on("click", "#searchinput", function() {
        if(layerStatue) {
            layerStatue = false;
            $.ajax({
                url: api_url + "/api/cars/category/brands/gongpingjia-php/",
                data: "",
                dataType: 'jsonp',
                jsonp: 'callback',
                success: function (msg) {
                    var brandList = msg.brands;
                    $.each(brandList, function (i, n) {
                        if (n[0] != "P") {
                            var ibrandBox = $("<div class=\"ibrandBox clearfix\"></div>");
                            var ibrandBoxP = $("<p id=\"" + n[0] + "\">" + n[0] + "</p>");
                            var ibrandBoxUl = $("<ul></ul>");
                            $.each(n[1], function (y, m) {
                                var ibrandBoxLi = $("<li id=\"brand_" + m.id + "\"><a href=\"javascript:void(0);\" ref=\"" + m.name + "\">" + n[0] + "&nbsp;" + m.name + "</a></li>");
                                ibrandBoxLi.appendTo(ibrandBoxUl);
                            });
                            ibrandBoxP.appendTo(ibrandBox);
                            ibrandBoxUl.appendTo(ibrandBox);
                            ibrandBox.appendTo($("#cdsSearchBox .cdsSbrand .cdsBtabBox"));
                        }
                    });
                    layer.open({
                        type: 1,
                        shade: [0.8, '#393D49'],
                        shadeClose: true,
                        maxWidth: 260,
                        title: false,
                        content: $('#cdsSearchBox'),
                        success: function (layero, index) {
                            layerStatue = true;
                            var arrscroll = [];
                            for (var i = 0; i < $("#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox").length; i++) {
								var userAgent = window.navigator.userAgent.toLowerCase();
								if($.browser.msie && /msie 8\.0/i.test(userAgent)) {
									arrscroll.push($(".ibrandBox").eq(i).position().top);
								}else {
									arrscroll.push($(".ibrandBox").eq(i).position().top * 2);
								}
                            }
                            $("#cdsSearchBox .cdsSbrand .csbNav a").click(function () {
                                $(this).addClass('active').siblings('a').removeClass('active');
                                var index = $(this).index();
                                $("#cdsSearchBox .cdsSbrand .cdsBtabBox").animate({
                                    scrollTop: arrscroll[index] + 'px'
                                }, 500);
                            });
                        },
                        close: function() {
                            layerStatue = true;
                        }
                    });
                }
            });
        }
    });
    $(document).on("click", "#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li", function() {
        var objAry = $(this).attr("id").split("_");
        var brandId = objAry[1];
        var itemA = $(this).find("a");
        var brandName = $(itemA).attr("ref");
        $("#brandId").val(brandId);
        $("#searchinput").val(brandName);
        $("#srcForm").submit();
    });
    $(document).on("click", "#search-container .bud-cont ul li", function() {
        var thisObj = $(this).attr("rel");
        var thisAry = thisObj.split("_");
        $("#minPrice").val(thisAry[0]);
        $("#maxPrice").val(thisAry[1]);
        $("#srcForm").submit();
    });
    $(document).on("click", "#search-container .car-age-cont ul li", function() {
        var thisObj = $(this).attr("rel");
        var thisAry = thisObj.split("_");
        $("#minAge").val(thisAry[0]);
        $("#maxAge").val(thisAry[1]);
        $("#srcForm").submit();
    });
    $(document).on("click", "#search-container .mileage ul li", function() {
        var thisObj = $(this).attr("rel");
        var thisAry = thisObj.split("_");
        $("#minMile").val(thisAry[0]);
        $("#maxMile").val(thisAry[1]);
        $("#srcForm").submit();
    });
    $(document).on("click", "#classifyBox ul li", function() {
        var thisObj = $(this).attr("rel");
        $("#classify").val(thisObj);
        $("#srcForm").submit();
    });
    $(document).on("click", "#controlBox ul li", function() {
        var thisObj = $(this).attr("rel");
        $("#control").val(thisObj);
        $("#srcForm").submit();
    });
    $(document).on("click", "#volumeBox ul li", function() {
		var thisObj = $(this).attr("rel");
		var thisAry = thisObj.split("_");
		$("#minvolume").val(thisAry[0]);
		$("#maxvolume").val(thisAry[1]);
		$("#srcForm").submit();
    });
    $(document).on("click", ".top-cont .tags .icon-close", function() {
        $(this).parent().remove();
        $("#brandId").val("");
        $("#searchinput").val("");
        $("#srcForm").submit();
    });
    $("#classifyBox .dropdown").hover(
        function () {
            $(this).addClass("show");
        },
        function () {
            $(this).removeClass("show");
        }
    );
    $(document).on("click", ".advanced", function() {
        $(".content .advSearch").fadeToggle();
    });
	$(document).on("click", ".sort-l .icon-up", function() {
		var sortVal = $(this).attr("rel");
		$("#order_key").val("-"+sortVal);
		$("#srcForm").submit();
	});
	$(document).on("click", ".sort-l .icon-down", function() {
		var sortVal = $(this).attr("rel");
		$("#order_key").val(sortVal);
		$("#srcForm").submit();
	});
});