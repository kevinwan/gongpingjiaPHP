<div id="container">
	<div id="top">
		<div class="wrap">
			<div id="logo"><img src="$static/img/index/logo.png" /></div>
			<div class="selarea">
				<div class="label-text">当前地区：</div>
				<div class="area">北京</div>
			</div>
		</div>
	</div>
	<div class="banner">
		<div class="banner-box">
			<div class="info-car">
				<h3>宝马5系  2014款 520i 典雅型</h3>
				<p><span>2015年上牌</span>|<span>行驶里程：6.0万公里</span>|<span>上牌城市：北京</span></p>
				<p>新车指导价：43.58万</p>
			</div>
		</div>

	</div>
	<div class="content">
		<form action="" method="post">
			<input type="hidden" name="dataFrom" value="<?php echo $this->dataFrom; ?>" />
			<input type="hidden" name="infoId" value="<?php echo $this->infoId; ?>" />
			<h2 class="info-title"><span>个人信息</span></h2>
			<p class="info-msg">留下可以联系到您的资料，才能促使交易完成</p>
			<ul class="info-list">
				<li><label>姓名</label><input type="text" /></li>
				<li><label>手机</label><input type="text" /></li>
				<li><label>验证码</label><input class="info-code" type="text" /><a class="btn-code" href="javascript:;">短信获取验证码</a></li>
			</ul>
			<div class="btn-list">
				<a href="javascript:;" class="btn-link btn-submit">提交</a>
			</div>
		</form>
	</div>
</div>
<!--提交成功弹窗 [[-->
<div class="dialog-box">
	<div class="sub-dialogShade">
	</div>
	<div class="sub-dialog">
		<i></i>
		<p>您的售车信息已发送成功！<br>请等待车商与您联系!</p>
		<img src="$static/img/sell/dialog_msg.png" />
		<a href="javascript:;">补充信息</a>
	</div>
</div>

<!--提交成功弹窗 ]]-->
<script>
	$(function(){
		$(".btn-list").on("click",".btn-submit",function(){
			$(".dialog-box").fadeIn();
		});
		$(".sub-dialogShade").on("click",function(){
			$(".dialog-box").hide();
		});
	})
</script>
