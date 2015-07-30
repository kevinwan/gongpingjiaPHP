<div id="container">
	<div id="top">
		<div class="wrap">
            <div id="logo"><a href="<?php echo "http://".$this->nowCity->pinyin.".".$this->domain; ?>"><img src="$static/img/index/logo.png" /></a></div>
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
		<h1 class="saler_mes">选择一个靠谱商家，您爱车售出的速度可能更快些</h1>
		<div class="saler_choose">
            <?php
            $isClose = false;
            foreach ($this->dealers as $key => $dealer) {
                if($key == "5") {
                    $isClose = true;
                    echo "<div class='otherDealers' style='display: none;'>";
                }
            ?>
            <div id="saler_<?php echo $dealer->id ?>" title="<?php echo $dealer->company_name; ?>" class="saler_choose_part">
                <h5>优质商家</h5>
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
            <?php
            if($isClose) {
            $isClose = false;
            ?>
            </div>
            <?php } ?>
		</div>
        <?php if(count($this->dealers) > 5) {?>
            <a class="saler_other" href="javascript:;">查看本地区其余<span><?php echo count($this->dealers)-5; ?></span>家优质商户</a>
        <?php } ?>
		<!-- 优质商家 ]] -->
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
				<p>面向本地全部<?php echo count($this->dealers); ?>家<?php echo $this->detailBrand; ?>（品牌）4S店及经销商</p>
			</div>
		</div>
		<!-- 服务 ]] -->
	</div>
	<!-- 选商家 ]] -->
</div>
