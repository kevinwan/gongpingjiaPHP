$(document).ready(function() {
	$(document).on("click", ".search_part .search_Txt", function() {
		layer.open({
			type: 1,
			shade: [0.8, '#393D49'],
			shadeClose: true,
			maxWidth: 990,
			title: false,
			content: $('#cdsSearchBox'),
			success: function(layero, index){
			}
		});
	});
});
