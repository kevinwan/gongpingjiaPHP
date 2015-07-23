var api_url = "http://www.gongpingjia.com";
$(document).ready(function() {
	$(document).on("click", "#top .selarea .area", function() {
		layer.open({
			type: 1,
			shade: [0.8, '#393D49'],
			shadeClose: true,
			maxWidth: 560,
			title: false,
			content: $('#selarea'),
			success: function(layero, index){
				
			}
		});
	});
});