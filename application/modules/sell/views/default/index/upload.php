<div id="container">
	<div id="top">
		<div class="wrap">
			<div id="logo"><img src="$static/img/index/logo.png" /></div>
			<div class="selarea">
				<div class="label-text">当前地区：</div>
				<div class="area"><?php echo $this->nowCity->name; ?></div>
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
		<h2 class="info-title"><span>上传图片</span></h2>
		<p class="info-msg">图片强调了信息的真实性，增强了车商的收购信心</p>
		<div class="upload-img">
			<a class="l-font" href="javascript:;">
				<label>左前45度</label>
				<img id="uploadopcity1" class="upload-opcity hide" defsrc="$static/img/sell/opcity.png" src="$static/img/sell/opcity.png" />
				<div class="shade hide"></div>
			</a>
			<a class="e-font" href="javascript:;">
				<label>后前45度</label>
				<img id="uploadopcity2" class="upload-opcity hide" defsrc="$static/img/sell/opcity.png" src="$static/img/sell/opcity.png" />
				<div class="shade hide"></div>
			</a>
			<a class="n-shi" href="javascript:;">
				<label>内饰</label>
				<img id="uploadopcity3" class="upload-opcity hide" defsrc="$static/img/sell/opcity.png" src="$static/img/sell/opcity.png" />
				<div class="shade hide"></div>
			</a>
			<a class="i-side" href="javascript:;">
				<label>侧面</label>
				<img id="uploadopcity4" class="upload-opcity hide" defsrc="$static/img/sell/opcity.png" src="$static/img/sell/opcity.png" />
				<div class="shade hide"></div>
			</a>
			<a class="i-motor" href="javascript:;">
				<label>发动机仓</label>
				<img id="uploadopcity5" class="upload-opcity hide" defsrc="$static/img/sell/opcity.png" src="$static/img/sell/opcity.png" />
				<div class="shade hide"></div>
			</a>
		</div>
		<div class="btn-list">
			<a href="/sellreport/<?php echo serialId."/".$this->nowCity->pinyin."/".detailYear."/".modelId."/".detailMile."/" ?>" class="btn-link btn-submit">完成</a>
		</div>
	</div>
</div>