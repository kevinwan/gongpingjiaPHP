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
	<!-- 选商家 [[ -->
	<div class="saler_main">
		<!-- 优质商家 [[ -->
		<h1 class="saler_mes">选择一个个人在线交易平台</h1>
		<div class="saler_choose">
            <?php
            foreach ($this->selfperson->data as $key => $dealer) {
            ?>
			<div id="saler_<?php echo $dealer->id ?>" class="saler_choose_part">
				<div class="saler_choose_con">
                    <div class="preview"><?php echo $dealer->company_name; ?></div>
                    <p class="des"><?php echo $dealer->address; ?></p>
                    <div class="phone">
                        <a href="javascript:void();"><?php echo $dealer->phone; ?></a>
                    </div>
				</div>
			</div>
            <?php
            }
            ?>
		</div>
		<!-- 服务 [[ -->
		<div class="serve_main">
			<div class="serve_part">
				<div><img src="$static/img/displace/serve_Img1.png"></div>
				<h4>免费服务</h4>
				<p>没有任何隐性收费，完全免费</p>
			</div>
			<div class="serve_part">
				<div><img src="$static/img/displace/serve_Img4.png"></div>
				<h4>覆盖更全</h4>
				<p>面向本地全部xxx家xx（品牌）<br/>4S店及经销商</p>
			</div>
		</div>
		<!-- 服务 ]] -->
	</div>
</div>
