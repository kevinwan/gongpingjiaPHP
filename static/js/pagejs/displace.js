$(document).ready(function() {
    var layerStatue = true;
    var seriesStatue = true;
    var modelStatue = true;

    $(document).on("click", "#carModel .carModel li", function() {
        var objAry = $(this).attr("id").split("_");
        var brandId = objAry[1];
        window.location.href='/sell/index/fourshop/changeId/'+brandId;
    });

    $(document).on("click", "#carSeries li", function() {
        if(modelStatue) {
            modelStatue = false;
            $("#carSeries li.active").removeClass('active');
            $(this).addClass("active");
            var objAry = $(this).attr("id").split("_");
            var brandId = objAry[1];
            $.ajax({
                url: api_url + "/api/cars/category/detailmodels/gongpingjia-php/",
                data: "model=" + brandId,
                dataType: 'jsonp',
                jsonp: 'callback',
                success: function (msg) {
                    $("#carModel .cdsStab").empty();
                    var modelList = msg.d_models;
                    $.each(modelList, function (i, n) {
                        var cdsStabD = $("<div class=\"ibrandBox carModel clearfix\">");
                        var isTabP = $("<p>"+n[0]+"</p>");
                        var cdsStabUl = $("<ul>");
                        $.each(n[1], function (y, m) {
                            var cdsStabA = $("<li id=\"model_"+ m.id +"\"><a href=\"javascript:void(0);\" class=\"fl\">"+ m.detail_model +"</a><a href=\"javascript:void(0);\" class=\"fr\">"+ m.price_bn +"万</a></li>");
                            cdsStabA.appendTo(cdsStabUl);
                        });
                        isTabP.appendTo(cdsStabD);
                        cdsStabUl.appendTo(cdsStabD);
                        cdsStabD.appendTo($("#carModel .cdsStab"));
                    });
                    modelStatue = true;
                }
            });
        }
    });

    $(document).on("click", "#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li", function() {
        if(seriesStatue) {
            seriesStatue = false;
            var ibrandBoxA = $(this).find("a");
            $("#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li a.active").removeClass('active');
            $(ibrandBoxA).addClass("active");
            var objAry = $(this).attr("id").split("_");
            var brandId = objAry[1];
            $.ajax({
                url: api_url + "/api/cars/category/models/gongpingjia-php/",
                data: "brand=" + brandId,
                dataType: 'jsonp',
                jsonp: 'callback',
                success: function (msg) {
					console.log(msg);
                    $("#cdsSearchBox .cdsStabBox .cdsStab").empty();
                    var modelList = msg.models;
                    $.each(modelList, function (i, n) {
                        var cdsStabP = $("<p>" + n[0] + "</p>");
                        var isTabD = $("<ul>");
                        $.each(n[1], function (y, m) {
                            var cdsStabA = $("<li id=\"series_"+ m.id +"\"><a href=\"javascript:void(0);\">" + m.name + "</a></li>");
                            cdsStabA.appendTo(isTabD);
                        });
                        cdsStabP.appendTo($("#carSeries .cdsStab"));
                        isTabD.appendTo($("#carSeries .cdsStab"));
                    });
                    seriesStatue = true;
                }
            });
        }
    });

    $(document).on("click", ".search_part .search_Txt", function() {
        if(layerStatue) {
            layerStatue = false;
            $.ajax({
                url: api_url + "/api/cars/category/brands/gongpingjia-php/",
                data: "",
                dataType: 'jsonp',
                jsonp: 'callback',
                success: function (msg) {
                    $("#cdsSearchBox .cdsSbrand .cdsBtabBox").empty();
                    $("#cdsSearchBox .cdsStabBox .cdsStab").empty();
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
                    $("#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li:first").trigger("click");
                    $("#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li:first a").addClass("active");
                    layer.open({
                        type: 1,
                        shade: [0.8, '#393D49'],
                        shadeClose: true,
                        maxWidth: 990,
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
                            seriesStatue = true;
                            modelStatue = true;
                        }
                    });
                }
            });
        }
    });
});
