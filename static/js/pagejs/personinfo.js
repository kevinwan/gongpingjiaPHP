$(document).ready(function () {
    $(".btn-list").on("click", ".btn-submit", function () {
        $("#srcform").submit();
    });
	$(".info-list").on("click", "#codeBtn", function () {
		var phone = $("#userPhone").val();
		if(/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/.test(phone)) {
			time($(this));
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
var wait = 120;
function time(_this) {
	if (wait == 0) {
		_this.removeAttr("disabled");
		_this.val("短信获取验证码");
		wait = 120;
	} else {
		_this.attr("disabled", true);
		_this.val("重新发送(" + wait + ")");
		wait--;
		setTimeout(function() {
			time(_this);
		},
		1000)
	}
}
