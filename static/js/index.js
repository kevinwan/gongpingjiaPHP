$(document).ready(function() {
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
	search_item_num = x_num-2;
	if(itemwidth*x_num > w_width) {
		axis = -Math.ceil((itemwidth*x_num-w_width)/2);
	}

	$.ajax({
		url: "/",
		data: "num="+x_num*y_num,
		success: function(msg){
			eval("msgObj="+JSON.stringify(msg));
			$.each(msgObj, function(i,n) {
				var item_img = $("<img class=\"shade\" title=\""+n.title+"\" src=\""+n.imgGrayUrl+"\" sourcesrc=\""+n.imgUrl+"\" height=\""+itemheight+"\" width=\""+itemwidth+"\" />")
				if(i%x_num == 0) {
					img_left = axis;
					img_top = img_top + itemheight;
				}else {
					img_left = img_left + itemwidth;
				}
				item_img.css("top", img_top).css("left", img_left).appendTo($("#wrapper"));
			});
		}
	});

	$("#top").css("left", axis+itemwidth);
	$("#search").css("top", (Math.ceil(y_num/2)-1)*itemheight);
	$("#search").css("left", Math.ceil((x_num-search_item_num)/2)*itemwidth+axis);
	$("#carMore").css("top", (y_num-2)*itemheight);
	$("#carMore").css("right", Math.ceil((x_num-search_item_num)/2)*itemwidth+axis);
	$("#search").css("width", search_item_num*itemwidth);
	$("#search .label-value").css("width", search_item_num*itemwidth-249);

	$("#wrapper .shade").hover(
		function(){
			exchangeImg($(this));
		},
		function(){
			exchangeImg($(this));
		}
	);

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

	$(document).on("click", "#search .salebox", function() {
		layer.open({
			type: 1,
			shade: [0.8, '#393D49'],
			shadeClose: true,
			maxWidth: 990,
			title: false,
			content: $('#cdsSearchBox'),
			cancel: function(index) {
			}
		});
	});
});

function exchangeImg(imgObj) {
	var yuansrc = imgObj.attr("src");
	var sourcesrc = imgObj.attr("sourcesrc");
	imgObj.attr("src", sourcesrc);
	imgObj.attr("sourcesrc", yuansrc);
}
