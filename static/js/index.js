$(document).ready(function() {
	var axis = 0;
	var w_width = $(document).width();
	var w_height = $(document).height();
	var itemwidth = 198;
	var itemheight = 120;
	var img_left = 0;
	var img_top = -itemheight;
	var x_num = Math.ceil(w_width/itemwidth);
	var y_num = Math.ceil(w_height/itemheight);
	var msgObj;
	search_item_num = x_num-2;

	if(itemwidth*x_num > w_width) {
		axis = -Math.ceil((itemwidth*x_num-w_width)/2);
	}

//	$.ajax({
//	   url: "http://www.gongpingjia.com/api/cars/car/indexcar/gongpingjia-php/",
//	   data: "city=35&num="+x_num*y_num,
//	   dataType: "jsonp",
//	   jsonp: "callback",
//	   success: function(msg){
//
//		   eval("msgObj="+JSON.stringify(msg));
//		   console.log(msgObj);
//	   }
//	});

	var msgObj = {"status":"success","cars":[{"dmodel":"2009\u6b3e 1.6L \u8fd0\u52a8\u578b AT","url":"http://www.xin.com/c/10533261.html","thumbnail":"http://static.souchela.com/cacheimg/19812/img/1c27447fe8bd8754056bd83ce0069a64cc2ee163.png","model_detail_slug":"m8050_ba","year":"2010","id":"1317078"},{"dmodel":"2012\u6b3e 2.4L \u8c6a\u534e\u7248","url":"http://www.xin.com/c/10532697.html","thumbnail":"http://static.souchela.com/qiniudn/img/9d0145c260d9d4c3ced054cf3355b0113e72783c?19812x","model_detail_slug":"12508_ah","year":"2013","id":"1317117"},{"dmodel":"2011\u6b3e 2.0 \u624b\u52a8 \u8c6a\u534e\u578b","url":"http://www.51auto.com/buycar/2675440.html","thumbnail":"http://static.souchela.com/qiniudn/img/7d8c1c190c4bfb5c419ced7e15e067dc6fe80a45?19812x","model_detail_slug":"m17122_pa","year":"2011","id":"1315858"},{"dmodel":"2006\u6b3e 1.6L/2V \u624b\u52a8\u65f6\u5c1a\u578b","url":"http://bj.haoche51.com/details/36807.html","thumbnail":"http://static.souchela.com/qiniudn/img/993fe02f72d52419aaadb42985614aa5f0230fca?19812x","model_detail_slug":"m2713_ba","year":"2007","id":"1315304"},{"dmodel":"2013\u6b3e 1.5L \u81ea\u52a8\u5c0a\u8d35\u578b","url":"http://www.souche.com/pages/choosecarpage/choose-car-detail.html?carId=5be91f0f-ce3f-403a-b034-d768db1de8b3","thumbnail":"http://static.souchela.com/qiniudn/img/7a156707154e417ffb1526c4d11c51397ce82119?19812x","model_detail_slug":"13580_ah","year":"2013","id":"1310595"},{"dmodel":"2001\u6b3e \u6377\u8fbe 1.6 \u624b\u52a8 CIX \u90fd\u5e02\u6625\u5929","url":"http://www.51auto.com/buycar/2675197.html","thumbnail":"http://static.souchela.com/qiniudn/img/cd13bf62695fd00b8bc0074ecc594ffbfe8ec622?19812x","model_detail_slug":"8850_autotis","year":"2004","id":"1310432"},{"dmodel":"2008\u6b3e S 300 L 3.0 \u624b\u81ea\u4e00\u4f53 \u5546\u52a1\u578b","url":"http://www.souche.com/pages/choosecarpage/choose-car-detail.html?carId=409177e7-5a77-4738-b84a-ad9038772341","thumbnail":"http://static.souchela.com/qiniudn/img/0694d11d72e7dea0185667157381c95bc57a4491?19812x","model_detail_slug":"58658_autotis","year":"2009","id":"1310574"},{"dmodel":"2009\u6b3e\u9177\u5a01 2.7L","url":"http://bj.haoche51.com/details/36791.html","thumbnail":"http://static.souchela.com/qiniudn/img/654b950cd3ae248c2ce6bd31c1b1a2a0e47bef6e?19812x","model_detail_slug":"m5485_xc","year":"2010","id":"1308287"},{"dmodel":"2013\u6b3e\u522b\u514bGL8\u5546\u52a1 2.4L CT\u8212\u9002\u7248","url":"http://www.youche.com/detail/12147.shtml","thumbnail":"http://static.souchela.com/qiniudn/img/7195876ff3f59283d72045c6799f03b5ffe813fd?19812x","model_detail_slug":"m17790_xc","year":"2014","id":"1308161"},{"dmodel":"2009\u6b3e\u9177\u5a01 2.7L","url":"http://bj.haoche51.com/details/36782.html","thumbnail":"http://static.souchela.com/qiniudn/img/4c498c126d7edc2b4d6aa3b2db3e70329602445e?19812x","model_detail_slug":"m5485_xc","year":"2010","id":"1307581"},{"dmodel":"2013\u6b3e\u5e15\u8428\u7279 3.0L V6 DSG\u65d7\u8230\u7248","url":"http://www.youche.com/detail/12113.shtml","thumbnail":"http://static.souchela.com/qiniudn/img/1c27447fe8bd8754056bd83ce0069a64cc2ee163?19812x","model_detail_slug":"m16752_xc","year":"2013","id":"1306770"},{"dmodel":"2013\u6b3e\u5965\u62d3 1.0L \u81ea\u52a8\u70ab\u9177\u7248","url":"http://www.souche.com/pages/choosecarpage/choose-car-detail.html?carId=549283a8-3c24-48e0-9d02-aa791623a53f","thumbnail":"http://static.souchela.com/qiniudn/img/e29de2bca89494acf102144bf41e954096134a8a?19812x","model_detail_slug":"m12825_xc","year":"2013","id":"1306518"},{"dmodel":"2013\u6b3e A1 1.4TFSI \u53cc\u79bb\u5408 30TFSI \u4e2d\u56fd\u9650\u91cf\u7248 Ego","url":"http://www.souche.com/pages/choosecarpage/choose-car-detail.html?carId=c3774e73-d6d8-4844-936e-88ef64eb110c","thumbnail":"http://static.souchela.com/qiniudn/img/65850c011b941e1e4fbfe5e41700330cbb819062?19812x","model_detail_slug":"61018_autotis","year":"2013","id":"1306511"},{"dmodel":"2008\u6b3e 550D 1.8T \u81ea\u52a8\u54c1\u81fb\u7248","url":"http://www.souche.com/pages/choosecarpage/choose-car-detail.html?carId=fd807c54-a5ab-4e59-a032-63ba246ee34b","thumbnail":"http://static.souchela.com/qiniudn/img/3adf649c7e0f7f424cd1d9aa5dbacfe9bfa80f2e?19812x","model_detail_slug":"4077_ah","year":"2009","id":"1306275"},{"dmodel":"","url":"http://www.51auto.com/buycar/2661440.html","thumbnail":"http://static.souchela.com/qiniudn/img/4e8eeab4ecde8460c63918e96d7ba87e27da0a15?19812x","model_detail_slug":"m26379_pa","year":"2015","id":"1304952"},{"dmodel":"2013\u6b3e 1.5L GTDi180\u65f6\u5c1a\u578b","url":"http://www.51auto.com/buycar/2661430.html","thumbnail":"http://static.souchela.com/qiniudn/img/ac53dbd54e5ec7242215c62c4ac52ececce8ac01?19812x","model_detail_slug":"15504_ah","year":"2015","id":"1304949"},{"dmodel":"2010\u6b3e 1.4 MT \u98ce\u5ea6\u7248","url":"http://www.51auto.com/buycar/2674652.html","thumbnail":"http://static.souchela.com/qiniudn/img/7f40089487b1581d9c41217519378c3e74870b64?19812x","model_detail_slug":"m13878_pa","year":"2010","id":"1304850"},{"dmodel":"","url":"http://www.51auto.com/buycar/2674496.html","thumbnail":"http://static.souchela.com/qiniudn/img/f6cb9e66ff224bdb0e770765429725d0425d5667?19812x","model_detail_slug":"m26382_pa","year":"2014","id":"1304761"},{"dmodel":"2005\u6b3e 1.3L \u624b\u52a8\u8d85\u8c6a\u534e\u578b","url":"http://www.51auto.com/buycar/2674491.html","thumbnail":"http://static.souchela.com/qiniudn/img/4bdf26a7e60979f37568c87f6d352c1b4fb15b76?19812x","model_detail_slug":"1621_ah","year":"2009","id":"1304739"},{"dmodel":"2006\u6b3e 350 \u8c6a\u534e\u7248","url":"http://www.souche.com/pages/choosecarpage/choose-car-detail.html?carId=de6a2079-1722-457b-970d-c3760c969519","thumbnail":"http://static.souchela.com/qiniudn/img/955d065e7bffe7fdbcd00cca6deed79948bbde53?19812x","model_detail_slug":"2382_ah","year":"2006","id":"1306528"},{"dmodel":"2014\u6b3e 2.4L SIDI\u8c6a\u534e\u65f6\u5c1a\u578b","url":"http://www.51auto.com/buycar/2660293.html","thumbnail":"http://static.souchela.com/qiniudn/img/764558a18d4f100b3efb39c19ca812b34bfa0101?19812x","model_detail_slug":"17031_ah","year":"2014","id":"1304625"},{"dmodel":"1985\u6b3e 1.8 LX MT\u666e\u901a\u578b(4\u6863\u4f4e\u4e8e\u56fd1)","url":"http://www.51auto.com/buycar/2674140.html","thumbnail":"http://static.souchela.com/qiniudn/img/f7cc59220ff39530da5288809e90f6e03c78ac45?19812x","model_detail_slug":"m107158_ba","year":"2009","id":"1304418"},{"dmodel":"2012\u6b3e 1.6XL CVT\u8c6a\u534e\u7248","url":"http://www.51auto.com/buycar/2673862.html","thumbnail":"http://static.souchela.com/qiniudn/img/8d1265cdf87a8971a69c3d2b514de986630ed721?19812x","model_detail_slug":"m21590_pa","year":"2013","id":"1304116"},{"dmodel":"2013\u6b3e 1.0L AMT \u60a6\u9177\u578b","url":"http://www.51auto.com/buycar/2673894.html","thumbnail":"http://static.souchela.com/qiniudn/img/1950a77c0e681b3785d82cc46e94f0e18ad8eea9?19812x","model_detail_slug":"16496_ah","year":"2010","id":"1304179"},{"dmodel":"2010\u6b3e\u541b\u8d8a 3.0L \u65d7\u8230\u7248","url":"http://www.51auto.com/buycar/2537427.html","thumbnail":"http://static.souchela.com/qiniudn/img/c890c28d2f70e8142cc0f098d6ff90c4c36d1342?19812x","model_detail_slug":"m6948_xc","year":"2010","id":"1303910"},{"dmodel":"2011\u6b3e 1.6L \u624b\u52a8 \u8212\u9002\u578b","url":"http://www.51auto.com/buycar/2595493.html","thumbnail":"http://static.souchela.com/qiniudn/img/dcc4f3e8ffd2e44c858e32ac6705c14ffdbf46f6?19812x","model_detail_slug":"m12538_ba","year":"2012","id":"1304085"},{"dmodel":"2010\u6b3e \u4e09\u53a2 1.4L \u624b\u52a8\u7406\u60f3\u7248","url":"http://www.51auto.com/buycar/2595486.html","thumbnail":"http://static.souchela.com/qiniudn/img/f0701d038cda0db0d1ad0080dc4524e5a2980914?19812x","model_detail_slug":"6397_ah","year":"2011","id":"1304061"},{"dmodel":"2004\u6b3e 1.6L\u81ea\u52a8\u8212\u9002\u578b","url":"http://www.51auto.com/buycar/2604232.html","thumbnail":"http://static.souchela.com/qiniudn/img/43f12d60b2ce5dec93d635587dc706c26689b111?19812x","model_detail_slug":"m288_ba","year":"2004","id":"1304204"},{"dmodel":"2006\u6b3e \u51ef\u8d8aHRV 1.6 \u624b\u52a8 LE \u8c6a\u534e\u7248","url":"http://www.51auto.com/buycar/2604204.html","thumbnail":"http://static.souchela.com/qiniudn/img/5e3518ad0d6d4c2a5afac883a2041f37e29f476a?19812x","model_detail_slug":"10817_autotis","year":"2008","id":"1304009"},{"dmodel":"2014\u6b3e 2.4L \u8c6a\u534e\u7248","url":"http://www.xin.com/c/10526093.html","thumbnail":"http://static.souchela.com/qiniudn/img/ea082835971fdded3b9a3293124082cbd8484356?19812x","model_detail_slug":"17809_ah","year":"2014","id":"1305866"},{"dmodel":"2010\u6b3e \u667a\u80fd\u9886\u822a\u578b","url":"http://www.xin.com/c/10527327.html","thumbnail":"http://static.souchela.com/qiniudn/img/ac9bcddfc46e4a18ed49b8b9385ffb73af588ce5?19812x","model_detail_slug":"m10687_ba","year":"2011","id":"1307292"},{"dmodel":"2010\u6b3e\u660e\u9510 1.6L \u81ea\u52a8\u9038\u81f4\u7248","url":"http://www.xin.com/c/10528109.html","thumbnail":"http://static.souchela.com/qiniudn/img/f94ab7903f3b2685e75fb59ca34ff58e27b8394d?19812x","model_detail_slug":"m6977_xc","year":"2010","id":"1307898"},{"dmodel":"2008\u6b3e 2.0L \u624b\u81ea\u4e00\u4f53\u65f6\u5c1a\u578b","url":"http://www.xin.com/c/10530727.html","thumbnail":"http://static.souchela.com/qiniudn/img/dcee491671e42f88db92719ae9d4af8df2ec80a9?19812x","model_detail_slug":"m5801_ba","year":"2009","id":"1310895"},{"dmodel":"2009\u6b3e 0.8L \u624b\u52a8\u542f\u822a\u7248","url":"http://www.51auto.com/buycar/2635873.html","thumbnail":"http://static.souchela.com/qiniudn/img/73dbb68d26e1b798b417d7bbaa799d585a5d05bb?19812x","model_detail_slug":"4804_ah","year":"2009","id":"1303586"},{"dmodel":"2010\u6b3e X1 sDrive18i 2.0 \u624b\u81ea\u4e00\u4f53 \u8c6a\u534e\u578b","url":"http://bj.haoche51.com/details/36606.html","thumbnail":"http://static.souchela.com/qiniudn/img/016f8164d0c8654c5a49e9cd86269777e1653e75?19812x","model_detail_slug":"62464_autotis","year":"2012","id":"1303441"}],"message":"response ok!"};

	//提交后台获取图片数组
	$.each(msgObj.cars, function(i,n) {
		$("#temp_div img").attr("src", n.thumbnail);
        if(i%x_num == 0) {
        	img_left = axis;
        	img_top = img_top + itemheight;
        }else {
        	img_left = img_left + itemwidth;
        }
        $("#temp_div .shade").css("top", img_top);
        $("#temp_div .shade").css("left", img_left);
       	$("#temp_div .shade").clone(true).appendTo($("#wrapper")).show();
	});

	if($("#wrapper .shade").size() > 0) {
		grayscale($("#wrapper .shade"));
	}
	$("#wrapper .shade").hover(
		function(){
			grayscale.reset($(this));
		},
		function(){
			grayscale($(this));
		}
	);
	$("#top").css("left", axis+itemwidth);
	$("#search").css("top", (Math.ceil(y_num/2)-1)*itemheight);
	$("#search").css("left", Math.ceil((x_num-search_item_num)/2)*itemwidth+axis);
	$("#carMore").css("top", (y_num-2)*itemheight);
	$("#carMore").css("right", Math.ceil((x_num-search_item_num)/2)*itemwidth+axis);
	$("#search").css("width", search_item_num*itemwidth);
	$("#search .label-value").css("width", search_item_num*itemwidth-249);

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
		    cancel: function(index){
		    }
		});
	});

	$(document).bind("keydown",function(e){
		e=window.event||e;
		if(e.keyCode==116){
			e.keyCode = 0;
			//window.location.href="http://192.168.1.32/pahaoche/demo/front.html";
			//return false;
		}
	});
});
