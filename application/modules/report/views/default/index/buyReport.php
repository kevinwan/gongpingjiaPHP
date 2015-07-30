<div id="main" class="bscreen">
	<div class="report">
		<div id="top">
			<div class="wrap">
				<div id="logo"><a href="<?php echo "http://".$this->nowCity->pinyin.".".$this->domain; ?>"><img src="$static/img/index/logo.png" /></a></div>
				<div class="selarea">
					<div class="label-text">当前地区：</div>
					<div class="area"><?php echo $this->nowCity->name; ?></div>
				</div>
			</div>
		</div>
		<div class="r-choose">
				<div class="r-logo"></div>
				<ul class="r-form">
                <input type="hidden" name="year" id="year" value="<?php echo $this->year ?>" />
                <input type="hidden" name="city" id="city" value="<?php echo $this->cityId ?>" />
					<input type="hidden" name="serialId" id="serialId" value="<?php echo $this->serialId ?>" />
                <input type="hidden" name="typeid" id="typeid" value="<?php echo $this->type->id ?>" />
                <input type="hidden" name="citypy" id="citypy" value="<?php echo $this->cityPinYin ?>" />
                <li title="<?php echo $this->type->global_slug__name." ".$this->type->detail_model ?>" class="car-series icon-arrow"><?php echo $this->type->global_slug__name." ".$this->type->detail_model ?></li>
                <li class="r-form-even report-year icon-arrow">
                <label>上牌时间</label><a class="form-text" id="yearBox" href="javascript:;"><?php echo $this->year; ?></a>年
                </li>
                <li class="report-city icon-arrow">
                    <label>上牌城市</label><a class="form-text" id="cityBox" py="<?php echo $this->cityPinYin; ?>" href="javascript:;"><?php echo $this->cityName; ?></a>
                </li>
                <li class="r-form-even">
                    <label>行驶里程</label><input name="mileage" id="mileage" maxlength="10" class="form-text form-input" value="<?php echo $this->mileage; ?>" type="text" />
                    <span>万公里</span>
                </li>
				</ul>
				<a class="more-car" href="javascript:;" onclick="sellreport();">更新爱车信息</a>
				<div id="selectcar" class="selectcar popup" style="display: none;">
					<?php if(is_array($this->types)){ ?>
					<?php foreach ($this->types as $type){ ?>
					<div class="selectItem">
						<p><?php echo $type[0] ?></p>
						<ul>
							<?php foreach ($type[1] as $item){ ?>
							<li>
								<div class="carmodel" typeid="<?php echo $item->id ?>"><?php echo $item->detail_model ?></div>
								<div class="carprice">新车指导价￥<?php echo $item->price_bn ?></div>
							</li>
							<?php } ?>
						</ul>
					</div>
					<?php }} ?>
				</div>
            <div id="report-year" class="popup" style="display: none;">
                <ul></ul>
            </div>
            <div id="report-city" class="popup" style="display: none;">
                <ul>
                    <?php
                    foreach($this->cities as $key => $value) {
                        echo "<li id='city_".$value->id."'>".$value->name."</li>";
                    }
                    ?>
                </ul>
            </div>
			<script type="text/javascript">
				var startYear = "<?php echo $this->type->listed_year; ?>";
				var endYear = "<?php echo $this->type->delisted_year?$this->type->delisted_year:date("Y"); ?>";
				for (var i = startYear; i <= endYear; i++) {
					$("#report-year ul").append("<li class=\"itemyear\">"+i+"</li>");
				}
			</script>
		</div>
		<div class="r-cost">
			<div class="r-math">
				<h4>您爱车的公平价值为</h4>
				<p class="g-cost"><span><?php echo $this->V->deal_price; ?></span>万元</p>
                <div id="vote" class="margin-top">
                    <div class="right icon"></div>
                    <div class="vote">
                        <div class="user-num">已有<span class="total-vote"><?php echo $this->totalNum; ?></span>用户参与</div>
                        <div class="scale"><span class="blue"></span></div>
                        <div class="scale-num"><span class="font-blue"><?php echo $this->goodNum; ?></span>：<span class="font-gray"><?php echo $this->noGoodNum; ?></span></div>
                    </div>
                    <div class="no-right icon"></div>
                </div>
				<div class="count">
					<div class="fl count-group">
						<h5>分析数量总数</h5>
						<p><?php echo $this->V->analysis_car_count; ?></p>
					</div>
					<div class="fr count-group">
						<h5>估值准确率</h5>
						<p><?php echo $this->V->accuracy*100 ?>%</p>
					</div>
                    <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a></div>
					<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
				</div>
			</div>
			<div class="r-list">
                <?php
                foreach ($this->serialCars as $key => $used) {
                    if($key < 5) {
                        ?>
                        <div class="item">
                            <div class="wrap">
                                <img src="<?php echo $used->thumbnail ?>"/>
                                <a target="_blank" href="http://www.<?php echo $this->domain; ?>/index/linkSite/?slink=<?php echo $used->url; ?>&sname=原网站">
                                    <div class="carinfo">
                                        <div class="font-bold"><?php echo $used->title; ?></div>
                                        <div class="info">
                                            <div class="usedl fl">&yen;<?php echo $used->price; ?> 万</div>
                                            <div class="usedr fr">
                                                <div class="carage"><?php echo $used->car_age; ?>年</div>
                                                <div class="mileage"><?php echo $used->mile; ?>万公里</div>
                                            </div>
                                        </div>
                                        <div class="tags">
                                            <?php
                                            if (!XF_Functions::isEmpty($used->source_type)) {
                                                ?>
                                                <span
                                                    class="tag <?php echo $used->source_val["bg"] ?>"><?php echo $used->source_val["name"] ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="item last">
                    <div class="wrap">
                        <img src="$static/img/report/bg.jpg"/>
                        <a href="/used/index/index" id="carMore">随便看看...</a>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    genVote("<?php echo $this->totalNum; ?>", "<?php echo $this->goodNum; ?>", "<?php echo $this->noGoodNum; ?>");
</script>
