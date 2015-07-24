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
                <h3><?php echo $this->detailModel; ?></h3>
                <p><span><?php echo $this->detailYear; ?>年上牌</span>|<span>行驶里程：<?php echo $this->detailMile; ?>万公里</span>|<span>上牌城市：<?php echo $this->nowCity->name; ?></span></p>
                <p>新车指导价：<?php echo $this->detailPrice; ?>万</p>
            </div>
		</div>

	</div>
	<div class="content">
		<form id="srcform" action="" method="post">
            <input type="hidden" name="statue" value="<?php echo $this->statue; ?>" />
			<input type="hidden" name="dataFrom" value="<?php echo $this->dataFrom; ?>" />
			<input type="hidden" name="infoId" value="<?php echo $this->infoId; ?>" />
			<h2 class="info-title"><span>个人信息</span></h2>
			<p class="info-msg">留下可以联系到您的资料，才能促使交易完成</p>
			<ul class="info-list">
				<li><label>姓名</label><input type="text" name="username" /></li>
				<li><label>手机</label><input type="text" name="phone" /></li>
				<li><label>验证码</label><input class="info-code" name="validate_code" type="text" /><a class="btn-code" href="javascript:;">短信获取验证码</a></li>
			</ul>
			<div class="btn-list">
				<a href="javascript:;" class="btn-link btn-submit">提交</a>
			</div>
		</form>
	</div>
</div>
<?php if($this->statue == "ok") { ?>
<!--提交成功弹窗 [[-->
<div id="dialog-box" class="dialog-box" style="display: none;">
	<div class="sub-dialog">
		<i></i>
		<p>您的售车信息已发送成功！<br>请等待车商与您联系!</p>
		<img src="$static/img/sell/dialog_msg.png" />
		<a href="/sell/index/goodinfo">补充信息</a>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        layer.open({
            type: 1,
            shade: [0.8, '#393D49'],
            shadeClose: false,
            title: false,
            maxWidth: 550,
            closeBtn: false,
            content: $('#dialog-box'),
            success: function(layero, index){
            }
        });
    });
</script>
<?php } ?>