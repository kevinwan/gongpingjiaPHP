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
        <?php if(!XF_Functions::isEmpty($this->changeModel)) { ?>
		<div class="selcar">已选择新车 “<?php echo $this->changeModel ?>”</div>
        <?php } ?>
		<div class="boxtitle">请选择 4S店</div>
		<div class="fourshops clearfix">
            <?php
            $isClose = false;
            foreach ($this->fourshop->data as $key => $dealer) {
                if ($key == "4") {
                    $isClose = true;
                    echo "<div class='otherDealers' style='display: none;'>";
                }
                ?>
                <div id="shop_<?php echo $dealer->id ?>" class="fourshop">
                    <div class="info fl">
                        <div class="shopname"><?php echo $dealer->company_name ?></div>
                        <div class="shopadr">公司地址：<?php echo $dealer->address ?></div>
                    </div>
                    <div class="shoptel fr">
                        <div class="tel"><?php echo $dealer->phone ?></div>
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
        <?php if(count($this->fourshop->data) > 4) {?>
        <a class="saler_other" href="javascript:;">查看本地区其余<span><?php echo count($this->fourshop->data)-4; ?></span>家优质商户</a>
        <?php } ?>
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
    </div>
</div>
