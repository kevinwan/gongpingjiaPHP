$(document).ready(function() {
var uploadopcity1 = new plupload.Uploader({
	browse_button : 'uploadopcity1',
	url : '/sell/index/uploadfile/attdes/lefttop45/attrtype/upload',
	flash_swf_url : '$static/js/demo/Moxie.swf',
	silverlight_xap_url : '$static/js/demo/Moxie.xap',
	multi_selection : false,
	filters: {
		max_file_size : '2mb',
		mime_types : [
			{ title : "图片文件", extensions : "jpg,gif,png" }
		],
		prevent_duplicates : true
	},
	unique_names : true,
});
uploadopcity1.init();
uploadopcity1.bind('FilesAdded',function(uploader,files){
	for(var i = 0, len = files.length; i<len; i++){
		!function(i){
			previewImage(files[i],function(imgsrc){
				$('#uploadopcity1').attr('src', imgsrc).removeClass("hide");
				$('#uploadopcity1').siblings(".shade").removeClass("hide");
			});
		}(i);
	}
	uploadopcity1.start();
});
uploadopcity1.bind('UploadProgress',function(uploader,file){
	$('#uploadopcity1').siblings(".shade").css("top", 152*(100-file.percent)/100);
});
uploadopcity1.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == "200") {
		$('#uploadopcity1').siblings(".shade").css("height", 152).addClass("close hide");
	}
});
uploadopcity1.bind('Error',function(uploader,errObject){
	if(errObject.code == "-600") {
		layer.msg('文件过大，请选择2M以内的文件。');
	}else if(errObject.code == "-601") {
		layer.msg('文件类型错误，只支持jpg,gif,png的文件。');
	}
});
$(document).on("click", ".content .upload-img .l-font .close", function() {
	$(this).css("top", 0).removeClass("close").addClass("hide");
	uploadopcity1.splice(0, 1);
	$('#uploadopcity1').attr("src", $('#uploadopcity1').attr("defsrc")).addClass("hide");
});
var uploadopcity2 = new plupload.Uploader({
	browse_button : 'uploadopcity2',
	url : '/sell/index/uploadfile/attdes/backtop45/attrtype/upload',
	flash_swf_url : '$static/js/demo/Moxie.swf',
	silverlight_xap_url : '$static/js/demo/Moxie.xap',
	multi_selection : false,
	filters: {
		max_file_size : '2mb',
		mime_types : [
			{ title : "图片文件", extensions : "jpg,gif,png" }
		],
		prevent_duplicates : true
	},
	unique_names : true,
});
uploadopcity2.init();
uploadopcity2.bind('FilesAdded',function(uploader,files){
	for(var i = 0, len = files.length; i<len; i++){
		!function(i){
			previewImage(files[i],function(imgsrc){
				$('#uploadopcity2').attr('src', imgsrc).removeClass("hide");
				$('#uploadopcity2').siblings(".shade").removeClass("hide");
			});
		}(i);
	}
	uploadopcity2.start();
});
uploadopcity2.bind('UploadProgress',function(uploader,file){
	$('#uploadopcity2').siblings(".shade").css("top", 152*(100-file.percent)/100);
});
uploadopcity2.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == "200") {
		$('#uploadopcity2').siblings(".shade").css("height", 152).addClass("close hide");
	}
});
uploadopcity2.bind('Error',function(uploader,errObject){
	if(errObject.code == "-600") {
		layer.msg('文件过大，请选择2M以内的文件。');
	}else if(errObject.code == "-601") {
		layer.msg('文件类型错误，只支持jpg,gif,png的文件。');
	}
});
$(document).on("click", ".content .upload-img .e-font .close", function() {
	$(this).css("top", 0).removeClass("close").addClass("hide");
	uploadopcity2.splice(0, 1);
	$('#uploadopcity2').attr("src", $('#uploadopcity2').attr("defsrc")).addClass("hide");
});
var uploadopcity3 = new plupload.Uploader({
	browse_button : 'uploadopcity3',
	url : '/sell/index/uploadfile/attdes/inner/attrtype/upload',
	flash_swf_url : '$static/js/demo/Moxie.swf',
	silverlight_xap_url : '$static/js/demo/Moxie.xap',
	multi_selection : false,
	filters: {
		max_file_size : '2mb',
		mime_types : [
			{ title : "图片文件", extensions : "jpg,gif,png" }
		],
		prevent_duplicates : true
	},
	unique_names : true,
});
uploadopcity3.init();
uploadopcity3.bind('FilesAdded',function(uploader,files){
	for(var i = 0, len = files.length; i<len; i++){
		!function(i){
			previewImage(files[i],function(imgsrc){
				$('#uploadopcity3').attr('src', imgsrc).removeClass("hide");
				$('#uploadopcity3').siblings(".shade").removeClass("hide");
			});
		}(i);
	}
	uploadopcity3.start();
});
uploadopcity3.bind('UploadProgress',function(uploader,file){
	$('#uploadopcity3').siblings(".shade").css("top", 152*(100-file.percent)/100);
});
uploadopcity3.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == "200") {
		$('#uploadopcity3').siblings(".shade").css("height", 152).addClass("close hide");
	}
});
uploadopcity3.bind('Error',function(uploader,errObject){
	if(errObject.code == "-600") {
		layer.msg('文件过大，请选择2M以内的文件。');
	}else if(errObject.code == "-601") {
		layer.msg('文件类型错误，只支持jpg,gif,png的文件。');
	}
});
$(document).on("click", ".content .upload-img .n-shi .close", function() {
	$(this).css("top", 0).removeClass("close").addClass("hide");
	uploadopcity3.splice(0, 1);
	$('#uploadopcity3').attr("src", $('#uploadopcity3').attr("defsrc")).addClass("hide");
});
var uploadopcity4 = new plupload.Uploader({
	browse_button : 'uploadopcity4',
	url : '/sell/index/uploadfile/attdes/side/attrtype/upload',
	flash_swf_url : '$static/js/demo/Moxie.swf',
	silverlight_xap_url : '$static/js/demo/Moxie.xap',
	multi_selection : false,
	filters: {
		max_file_size : '2mb',
		mime_types : [
			{ title : "图片文件", extensions : "jpg,gif,png" }
		],
		prevent_duplicates : true
	},
	unique_names : true,
});
uploadopcity4.init();
uploadopcity4.bind('FilesAdded',function(uploader,files){
	for(var i = 0, len = files.length; i<len; i++){
		!function(i){
			previewImage(files[i],function(imgsrc){
				$('#uploadopcity4').attr('src', imgsrc).removeClass("hide");
				$('#uploadopcity4').siblings(".shade").removeClass("hide");
			});
		}(i);
	}
	uploadopcity4.start();
});
uploadopcity4.bind('UploadProgress',function(uploader,file){
	$('#uploadopcity4').siblings(".shade").css("top", 152*(100-file.percent)/100);
});
uploadopcity4.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == "200") {
		$('#uploadopcity4').siblings(".shade").css("height", 152).addClass("close hide");
	}
});
uploadopcity4.bind('Error',function(uploader,errObject){
	if(errObject.code == "-600") {
		layer.msg('文件过大，请选择2M以内的文件。');
	}else if(errObject.code == "-601") {
		layer.msg('文件类型错误，只支持jpg,gif,png的文件。');
	}
});
$(document).on("click", ".content .upload-img .i-side .close", function() {
	$(this).css("top", 0).removeClass("close").addClass("hide");
	uploadopcity4.splice(0, 1);
	$('#uploadopcity4').attr("src", $('#uploadopcity4').attr("defsrc")).addClass("hide");
});
var uploadopcity5 = new plupload.Uploader({
	browse_button : 'uploadopcity5',
	url : '/sell/index/uploadfile/attdes/cabin/attrtype/upload',
	flash_swf_url : '$static/js/demo/Moxie.swf',
	silverlight_xap_url : '$static/js/demo/Moxie.xap',
	multi_selection : false,
	filters: {
		max_file_size : '2mb',
		mime_types : [
			{ title : "图片文件", extensions : "jpg,gif,png" }
		],
		prevent_duplicates : true
	},
	unique_names : true,
});
uploadopcity5.init();
uploadopcity5.bind('FilesAdded',function(uploader,files){
	for(var i = 0, len = files.length; i<len; i++){
		!function(i){
			previewImage(files[i],function(imgsrc){
				$('#uploadopcity5').attr('src', imgsrc).removeClass("hide");
				$('#uploadopcity5').siblings(".shade").removeClass("hide");
			});
		}(i);
	}
	uploadopcity5.start();
});
uploadopcity5.bind('UploadProgress',function(uploader,file){
	$('#uploadopcity5').siblings(".shade").css("top", 152*(100-file.percent)/100);
});
uploadopcity5.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == "200") {
		$('#uploadopcity5').siblings(".shade").css("height", 152).addClass("close hide");
	}
});
uploadopcity5.bind('Error',function(uploader,errObject){
	if(errObject.code == "-600") {
		layer.msg('文件过大，请选择2M以内的文件。');
	}else if(errObject.code == "-601") {
		layer.msg('文件类型错误，只支持jpg,gif,png的文件。');
	}
});
$(document).on("click", ".content .upload-img .i-motor .close", function() {
	$(this).css("top", 0).removeClass("close").addClass("hide");
	uploadopcity5.splice(0, 1);
	$('#uploadopcity5').attr("src", $('#uploadopcity5').attr("defsrc")).addClass("hide");
});

function previewImage(file,callback){
	if(!file || !/image\//.test(file.type)) return;
	if(file.type=='image/gif') {
		var fr = new mOxie.FileReader();
		fr.onload = function(){
			callback(fr.result);
			fr.destroy();
			fr = null;
		}
		fr.readAsDataURL(file.getSource());
	}else{
		var preloader = new mOxie.Image();
		preloader.onload = function() {
			preloader.downsize( 228, 152 );
			var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL();
			callback && callback(imgsrc);
			preloader.destroy();
			preloader = null;
		};
		preloader.load(file.getSource());
	}
}
});