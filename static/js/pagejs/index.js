$(document).ready(function() {
	var api_url = "http://www.gongpingjia.com";
	var axis = 0;
	var max_width = 1920;
	var max_height = 1200;
	var w_width = $(document).width();
	var w_height = $(document).height();
	if(w_width > max_width) {
		w_width = max_width;
		$("#wrapper").css("width", max_width).css("margin", "0 auto");
	}
	if(w_height > max_height) { w_height = max_height; }
	var itemwidth = 198;
	var itemheight = 120;
	var img_left = 0;
	var img_top = -itemheight;
	var x_num = Math.ceil(w_width/itemwidth);
	var y_num = Math.ceil(w_height/itemheight);
	var input_width = 0;
	search_item_num = x_num-2;
	if(itemwidth*x_num > w_width) {
		axis = -Math.ceil((itemwidth*x_num-w_width)/2);
	}
	
	$("body").css("background-position", "-10px 0");

	$.ajax({
		url: "/",
		data: "num="+x_num*y_num,
		success: function(msg){
			msgObj=jQuery.parseJSON(msg);
			$.each(msgObj.result, function(i,n) {
				var item_img = $("<img class=\"shade\" title=\""+n.title+"\" src=\""+n.imgGrayUrl+"\" sourcesrc=\""+n.imgUrl+"\" height=\""+itemheight+"\" width=\""+itemwidth+"\" />")
				if(i%x_num == 0) {
					img_left = axis;
					img_top = img_top + itemheight;
				}else {
					img_left = img_left + itemwidth;
				}
				item_img.css("top", img_top).css("left", img_left).appendTo($("#wrapper"));
				item_img.hover(
					function(){
						exchangeImg(item_img);
					},
					function(){
						exchangeImg(item_img);
					}
				);
				item_img.click(function(){
					$("#switch").val("buy");
					$("#search .label-value .buybox").show();
					$("#search .label-value .buybox input").val(item_img.attr("title"));
					$("#search .label-value .salebox").hide();
					$("#search .lable-text").removeClass("salebtn").addClass("buybtn");
				});
			});
		}
	});

	$("#top").css("left", axis+itemwidth);
	$("#search").css("top", (Math.ceil(y_num/2)-1)*itemheight);
	if(x_num == "10") {
		$("#search").css("left", itemwidth*2+axis);
		$("#search").css("width", itemwidth*6);
		input_width = 6*itemwidth-249;
		$("#search .label-value").css("width", input_width);
	}else {
		$("#search").css("left", Math.ceil((x_num-search_item_num)/2)*itemwidth+axis);
		$("#search").css("width", search_item_num*itemwidth);
		input_width = search_item_num*itemwidth-249;
		$("#search .label-value").css("width", input_width);
	}
	$("#carMore").css("top", (y_num-2)*itemheight);
	$("#carMore").css("right", Math.ceil((x_num-search_item_num)/2)*itemwidth+axis);

	$(document).on("click", "#search .lable-text", function() {
		var switch_val = $("#switch").val();
		if(switch_val == "sale") {
			$("#switch").val("buy");
			$("#search .label-value .buybox").show();
			$("#search .label-value .salebox").hide();
			$("#search .lable-text").removeClass("salebtn").addClass("buybtn");
		}else if(switch_val == "buy") {
			$("#search .label-value .salebox").show();
			$("#search .label-value .buybox").hide();
			$("#switch").val("sale");
			$("#search .lable-text").removeClass("buybtn").addClass("salebtn");
		}
	});
	
	$(document).on("click", "#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li", function() {
		var ibrandBoxA = $(this).find("a");
		$("#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox li a.active").removeClass('active');
		$(ibrandBoxA).addClass("active");
		var objAry = $(this).attr("id").split("_");
		var brandId = objAry[1];
		$.ajax({
			url: api_url + "/api/cars/category/models/gongpingjia-php/",
			data: "brand="+brandId,
			dataType: 'jsonp',
			jsonp: 'callback',
			success: function(msg){
				$("#cdsSearchBox .cdsStabBox").empty();
				var modelList = msg.models;
				$.each(modelList, function(i,n) {
					var cdsStab = $("<div class=\"cdsStab\"></div>");
					var cdsStabP = $("<p>"+n[0]+"</p>");
					var isTabD = $("<div class=\"isTab clearfix\">");
					$.each(n[1], function(y,m) {
						var cdsStabA = $("<a target=\"_blank\" href=\"javascript:void(0);\"><img src=\"http://gongpingjia.qiniudn.com/img/logo/"+m.logo_img+"\" /><div><span>"+m.name+"</span></div></a>");
						cdsStabA.appendTo(isTabD);
					});
					cdsStabP.appendTo(cdsStab);
					isTabD.appendTo(cdsStab);
					cdsStab.appendTo($("#cdsSearchBox .cdsStabBox"));
				});
			}
		});
	});
	
	$(document).on("click", "#search .salebox", function() {
		$.ajax({
			url: api_url + "/api/cars/category/brands/gongpingjia-php/",
			data: "",
			dataType: 'jsonp',
			jsonp: 'callback',
			success: function(msg){
				$("#cdsSearchBox .cdsSbrand .cdsBtabBox").empty();
				$("#cdsSearchBox .cdsStabBox").empty();
				var brandList = msg.brands;
				$.each(brandList, function(i,n) {
					if(n[0] != "P") {
						var ibrandBox = $("<div class=\"ibrandBox clearfix\"></div>");
						var ibrandBoxP = $("<p id=\""+n[0]+"\">"+n[0]+"</p>");
						var ibrandBoxUl = $("<ul></ul>");
						$.each(n[1], function(y,m) {
							var ibrandBoxLi = $("<li id=\"brand_"+m.id+"\"><img class=\"preview\" src=\"http://gongpingjia.qiniudn.com/img/logo/"+m.logo_img+"\" /><a href=\"javascript:void(0);\" ref=\"+m.name+\">"+m.name+"</a></li>");
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
					success: function(layero, index){
						var arrscroll = [];
						for(var i=0;i< $("#cdsSearchBox .cdsSbrand .cdsBtabBox .ibrandBox").length; i++) {
							arrscroll.push($(".ibrandBox").eq(i).position().top*2);
						}
						$("#cdsSearchBox .cdsSbrand .csbNav a").click(function() {
							$(this).addClass('active').siblings('a').removeClass('active');
							var index = $(this).index();
							$("#cdsSearchBox .cdsSbrand .cdsBtabBox").animate({
								scrollTop: arrscroll[index] + 'px'
							},500);
						});
					}
				});
			}
		});
	});
	
	$.ajax({
		url: "http://webapi.souchela.com/auto/brandKeywords/",
		dataType: "jsonp",
		jsonp: "jsonp",
		success: function (data) {
			initAutoComplete(data.result);
		}
	});

	function initAutoComplete(data) {
		$('#typeahead-input').autocomplete(data, {
			max: 35,
			minChars: 1,
			width: input_width,
			scrollHeight: 220,
			matchContains: true,
			autoFill: false,
			formatItem: function(row, i, max) {
				var brand = "";
				if (row.brand_name) {
					brand = row.brand_name + " ";
				}
				return "<div class='item'>" + brand + row.name + "</div>";
			},
			formatMatch: function(row, i, max) {
				return row.keywords;
			},
			formatResult: function(row) {
				return row.name;
			}
		}).result(function(event, data, formatted) {
//			$("#typeahead_brand_slug").val(data.parent);
//			$("#typeahead_model_slug").val(data.slug);
//			carselected = true;
//			$(".search_by_make").hide();
//			$("#typeahead_go_btn").hide();
//			showYearChoice(data.parent, data.slug);
		});
	}
});

function exchangeImg(imgObj) {
	var yuansrc = imgObj.attr("src");
	var sourcesrc = imgObj.attr("sourcesrc");
	imgObj.attr("src", sourcesrc);
	imgObj.attr("sourcesrc", yuansrc);
}