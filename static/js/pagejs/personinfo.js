$(document).ready(function () {
    $(".btn-list").on("click", ".btn-submit", function () {
        $("#srcform").submit();
    });
	$(".info-list").on("click", "#codeBtn", function () {
		var phone = $("#userPhone").val();
		if(/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/.test(phone)) {
			$.ajax({
				type: "post",
				url: "http://webapi.souchela.com/common/sendSmsCode/",
				data: "mobile=" + $("#userPhone").val(),
				dataType: 'jsonp',
				jsonp: 'jsonp',
				success: function (msg) {
					console.log(msg);
				}
			});
		}else {
			layer.msg("请填写正确的手机号码");
		}
	});
});
