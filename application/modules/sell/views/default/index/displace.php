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
	<!-- 4s店置换 [[ -->
	<div class="saler_main">
		<!-- 搜索 [[ -->
		<h1 class="saler_mes">您想购买的新车是？</h1>
		<div class="search_part">
			<input type="text" readonly="readonly" class="search_Txt" value="请选择品牌/车系及车型">
			<input type="button" value="搜索" class="search_Btn">
		</div>
		<!-- 搜索 ]] -->
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
				<p>面向本地全部<?php echo count($this->fourshop); ?>家<?php echo $this->detailBrand; ?>（品牌）4S店及经销商</p>
			</div>
		</div>
		<!-- 服务 ]] -->
	</div>
	<!-- 4s店置换 ]] -->
</div>
<div id="cdsSearchBox" style="display: none;">
	<div class="cdsSearchMain clearfix">
		<div class="cdsbrandbg"></div>
		<div class="cds_searTabBox clearfix">
			<div class="cds_searTab clearfix cds_searShow">
				<div class="cdsSbrand clearfix">
					<div class="csbNav">
						<a class="active" href="javascript:;">A</a><a href="javascript:;">B</a><a href="javascript:;">C</a><a href="javascript:;">D</a><a href="javascript:;">F</a><a href="javascript:;">G</a><a href="javascript:;">H</a><a href="javascript:;">J</a><a href="javascript:;">K</a><a href="javascript:;">L</a><a href="javascript:;">M</a><a href="javascript:;">N</a><a href="javascript:;">O</a><a href="javascript:;">Q</a><a href="javascript:;">R</a><a href="javascript:;">S</a><a href="javascript:;">T</a><a href="javascript:;">W</a><a href="javascript:;">X</a><a href="javascript:;">Y</a><a href="javascript:;">Z</a>
					</div>
					<div class="cdsbTitle">请选择品牌</div>
					<div class="cdsBtabBox">
					</div>
				</div>
				<!--车系-->
				<div id="carSeries" class="cdsStabBox cdsStabbg">
					<div class="cdsbTitle">请选择车系</div>
					<div class="cdsStab" style="overflow-y: scroll; display: block;">
					</div>
				</div>
				<div id="carModel" class="cdsStabBox cdsStabbg">
					<div class="cdsbTitle">请选择车型</div>
					<div class="cdsStab" style="overflow-y: scroll; display: block;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>