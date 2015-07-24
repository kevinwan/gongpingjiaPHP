<div id="main" class="bscreen">
	<div id="header">
		<div class="content">
			<div id="top">
				<div class="wrap">
					<div id="logo">
						<img src="$static/img/index/logo.png" />
					</div>
					<div class="selarea">
						<div class="label-text">当前地区：</div>
						<div class="area">北京</div>
					</div>
				</div>
			</div>
			<div id="search-container">
				<div class="input-search fl smr">
					<input type="text" name="searchinput" value="输入品牌名称，体验快速查找" />
				</div>
				<div class="budget sbtn fl">
					<div class="sbtn-wrap">
						<div class="gray-arrow">不限预算</div>
					</div>
					<div class="bud-cont">
						<div class="price_l clearfix">
							<ul>
								<li>不限预算</li>
								<li>3万以内</li>
								<li>3-5万</li>
								<li>5-8万</li>
								<li>8-15万</li>
								<li>15-25万</li>
								<li>25-50万</li>
								<li>50万以上</li>
							</ul>
						</div>
						<div class="custom-price">
							<span class="text-label">自定义价格</span>
							<input type="text" name="min-price" class="small-input">&nbsp;&nbsp;&minus;&nbsp;
							<input type="text" name="max-price" class="small-input">
							<input id="custom-price" type="button" value="确定" />
						</div>
					</div>
				</div>
				<div class="car-age sbtn fl">
					<div class="sbtn-wrap">
						<div class="gray-arrow">不限车龄</div>
					</div>
					<div class="car-age-cont">
						<div class="price_l clearfix">
							<ul>
								<li>不限车龄</li>
								<li>1年以内</li>
								<li>1-3年</li>
								<li>3-5年</li>
								<li>5-8年</li>
								<li>8年以上</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="mileage sbtn fl">
					<div class="sbtn-wrap">
						<div class="gray-arrow">不限里程</div>
					</div>
					<div class="mileage-cont">
						<div class="price_l clearfix">
							<ul>
								<li>不限里程</li>
								<li>1年以内</li>
								<li>1-3年</li>
								<li>3-5年</li>
								<li>5-8年</li>
								<li>8年以上</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="advanced nosbtn fl smr">高级查询</div>
			</div>
		</div>
	</div>
	<div class="condition">
		<div class="content">
			<div class="top-cont">
				<div class="totalnum fl">共找到 <span class="font-orange"><?php echo $this->totalNum ?></span> 辆车</div>
				<div class="tags fl">
					<ul>
<!--						<li>宝马<i class="icon-close"></i></li>-->
					</ul>
				</div>
				<div class="sort fr">
					<div class="sort-res fl">排序：<span>默认</span></div>
					<div class="sort-l fl">
						<ul>
							<li class="icon-up">价格<i class="icon"></i></li>
							<li class="icon-down">里程<i class="icon"></i></li>
							<li class="icon-down">车龄<i class="icon"></i></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="used-list clearfix">
                <?php
                foreach ($this->usedList->cars as $used){
                ?>
				<div class="useditem">
					<div class="preview"><a href="<?php echo $used->url ?>"><img class="lazy" src="<?php echo $used->thumbnail ?>" /></a></div>
					<div class="font-bold row title" title="<?php echo $used->title ?>"><a href="<?php echo $used->url ?>"><?php echo $used->title ?></a></div>
					<div class="info row">
						<div class="usedl fl">&yen;<?php echo $used->price ?> 万</div>
						<div class="usedr fr">
							<div class="carage"><?php echo $used->car_age."年" ?></div>
							<div class="mileage"><?php echo $used->mile; ?>万公里</div>
						</div>
					</div>
					<div class="price row">公平价值<?php echo $used->deal_price; ?>万</div>
					<div class="tags row">
                        <?php
                        if(!XF_Functions::isEmpty($used->source_type)) {
                        ?>
						<span class="tag <?php echo $used->source_val["bg"] ?>"><?php echo $used->source_val["name"] ?></span>
                        <?php } ?>
					</div>
				</div>
                <?php } ?>
			</div>
            <div id="pager" class="clearfix" style="display: none;">
                <div class="pager">
                    <ul>
                        <?php
                        $pageNo = $this->pageNo;
                        $activeNo = $pageNo;
                        $totalPage = $this->totalPage;
                        $firstPage = 1;
                        $isLast = true;
                        $isFirst = false;
                        if($pageNo > 3) {
                            $isFirst = true;
                            if($totalPage-4 >= $pageNo ) {
                                $firstPage = $pageNo;
                                $activeNo = $pageNo + 2;
                            }else {
                                if($pageNo+2 > $totalPage) {
                                    $activeNo = $totalPage;
                                }else {
                                    $activeNo = $pageNo + 2;
                                }
                                $isLast = false;
                                $firstPage = $totalPage - 4;
                            }
                        }else {
                            if($pageNo+2 > $totalPage) {
                                $activeNo = $totalPage;
                            }else {
                                $activeNo = $pageNo + 2;
                            }
                        }
                        if($totalPage < $firstPage+4) {
                            $num = $totalPage;
                        }else {
                            $num = $firstPage+4;
                        }
                        if($isFirst) {
                            ?>
                            <li><a href="/used/index/index?page=1">1...</a></li>
                        <?php
                        }
                        for ($i = $firstPage;$i <= $num;  $i++) {
                            if($i == $activeNo) {
                                ?>
                                <li class="active"><a href="/used/index/index?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
                            <?php }else { ?>
                                <li><a href="/used/index/index?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
                            <?php } ?>
                        <?php
                        }
                        if($isLast) {
                            ?>
                            <li><a href="/used/index/index?page=<?php echo $totalPage; ?>">...<?php echo $totalPage ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="last"><input id="pageGo" maxlength="5" type="text" name="" /></li>
                    </ul>
                </div>
                <div class="prev-next">
                    <?php
                    if($activeNo < $totalPage) {
                        ?>
                        <div class="next fr"><a href="/used/index/index?page=<?php echo $activeNo+1; ?>">下一页&nbsp;&gt;</a></div>
                    <?php
                    }
                    ?>
                    <div class="prev fr"><a href="/used/index/index?page=<?php echo $activeNo-1; ?>">&lt;&nbsp;上一页</a></div>
                </div>
            </div>
		</div>
	</div>
	<div id="tipinfo" style="display: none;">
		<img src="$static/img/loading.gif" height="24px" width="24px" alt="正在加载..." />
	</div>
</div>
<script type="text/javascript">
    curPage = pageNo = "<?php echo $pageNo ?>";
    isScroll = true;
    pageTotal = "<?php echo $totalPage ?>";
</script>
<div id="footer">
	<div class="copyright">Copyright &copy; gongpingjia.com All Rights Reserved</div>
</div>
<div id="template" style="display: none;">
    <div class="useditem">
        <div class="preview"><a href=""><img class="lazy" src="" /></a></div>
        <div class="font-bold row title" title=""></div>
        <div class="info row">
            <div class="usedl fl"></div>
            <div class="usedr fr">
                <div class="carage"></div>
                <div class="mileage"></div>
            </div>
        </div>
        <div class="price row"></div>
        <div class="tags row">
        </div>
    </div>
</div>