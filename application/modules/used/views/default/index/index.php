<?php
    $brandId = $this->searchCon["brandId"];
    $minAge = $this->searchCon["minAge"];
    $maxAge = $this->searchCon["maxAge"];
    $minPrice = $this->searchCon["minPrice"];
    $maxPrice = $this->searchCon["maxPrice"];
    $minMile = $this->searchCon["minMile"];
    $maxMile = $this->searchCon["maxMile"];
    $classify = $this->searchCon["classify"];
    $control = $this->searchCon["control"];
    $minvolume = $this->searchCon["minVolume"];
    $maxvolume = $this->searchCon["maxVolume"];
    $order_key = $this->searchCon["order_key"];
?>
<div id="main" class="bscreen">
    <form action="" name="srcForm" id="srcForm" method="get" >
        <input type="hidden" name="brandId" id="brandId" value="<?php echo $brandId ?>" />
        <input type="hidden" name="minAge" id="minAge" value="<?php echo $minAge ?>" />
        <input type="hidden" name="maxAge" id="maxAge" value="<?php echo $maxAge ?>" />
        <input type="hidden" name="minMile" id="minMile" value="<?php echo $minMile ?>" />
        <input type="hidden" name="maxMile" id="maxMile" value="<?php echo $maxMile ?>" />
        <input type="hidden" name="classify" id="classify" value="<?php echo $classify ?>" />
        <input type="hidden" name="control" id="control" value="<?php echo $control ?>" />
        <input type="hidden" name="minvolume" id="minvolume" value="<?php echo $minvolume ?>" />
        <input type="hidden" name="maxvolume" id="maxvolume" value="<?php echo $maxvolume ?>" />
        <input type="hidden" name="order_key" id="order_key" value="<?php echo $order_key ?>" />
        <div id="header">
            <div class="content">
                <div id="top">
                    <div class="wrap">
                        <div id="logo"><a href="<?php echo "http://".$this->nowCity->pinyin.".".$this->domain; ?>"><img src="$static/img/index/logo.png" /></a></div>
                        <div class="selarea">
                            <div class="label-text">当前地区：</div>
                            <div class="area"><?php echo $this->nowCity->name; ?></div>
                        </div>
                    </div>
                </div>
                <div id="search-container">
                    <div class="input-search fl smr">
                        <input type="text" id="searchinput" name="brandName" readonly="readonly" value="<?php echo !XF_Functions::isEmpty($this->searchCon["brandName"]) ? $this->searchCon["brandName"] :"选择品牌名称，体验快速查找" ?>" />
                    </div>
                    <div class="budget sbtn fl">
                        <div class="sbtn-wrap">
                            <div class="gray-arrow">
                                <?php
                                    if(($maxPrice == "" || $maxPrice == "0") && ($minPrice == "" || $minPrice == "0")) {
                                        echo "不限预算";
                                    }else {
                                        if($maxPrice == "" || $maxPrice == "0") {
                                            echo $minPrice."万以上";
                                        }else if($minPrice == "" || $minPrice == "0") {
                                            echo $maxPrice."万以内";
                                        }else {
                                            echo $minPrice."-".$maxPrice."万";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="bud-cont">
                            <div class="price_l clearfix">
                                <ul>
                                    <li class="<?php if($minPrice."_".$maxPrice == "0_0") { echo "hover"; } ?>" rel="0_0">不限预算</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "0_3") { echo "hover"; } ?>" rel="0_3">3万以内</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "3_5") { echo "hover"; } ?>" rel="3_5">3-5万</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "5_8") { echo "hover"; } ?>" rel="5_8">5-8万</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "8_15") { echo "hover"; } ?>" rel="8_15">8-15万</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "15_25") { echo "hover"; } ?>" rel="15_25">15-25万</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "25_50") { echo "hover"; } ?>" rel="25_50">25-50万</li>
                                    <li class="<?php if($minPrice."_".$maxPrice == "50_10000") { echo "hover"; } ?>" rel="50_10000">50万以上</li>
                                </ul>
                            </div>
                            <div class="custom-price">
                                <span class="text-label">自定义价格</span>
                                <input type="text" id="minPrice" name="minPrice" value="<?php echo $this->searchCon["minPrice"] ?>" class="small-input">&nbsp;&nbsp;&minus;&nbsp;
                                <input type="text" name="maxPrice" id="maxPrice" value="<?php echo $this->searchCon["maxPrice"] ?>" class="small-input">
                                <input id="custom-price" type="button" value="确定" />
                            </div>
                        </div>
                    </div>
                    <div class="car-age sbtn fl">
                        <div class="sbtn-wrap">
                            <div class="gray-arrow">
                                <?php
                                if(($maxAge == "" || $maxAge == "0") && ($minAge == "" || $minAge == "0")) {
                                    echo "不限车龄";
                                }else {
                                    if($maxAge == "" || $maxAge == "0") {
                                        echo $minAge."年以上";
                                    }else if($minAge == "" || $minAge == "0") {
                                        echo $maxAge."年以内";
                                    }else {
                                        echo $minAge."-".$maxAge."年";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="car-age-cont">
                            <div class="price_l clearfix">
                                <ul>
                                    <li class="<?php if($minAge."_".$maxAge == "0_0") { echo "hover"; } ?>" rel="0_0">不限车龄</li>
                                    <li class="<?php if($minAge."_".$maxAge == "0_1") { echo "hover"; } ?>" rel="0_1">1年以内</li>
                                    <li class="<?php if($minAge."_".$maxAge == "1_3") { echo "hover"; } ?>" rel="1_3">1-3年</li>
                                    <li class="<?php if($minAge."_".$maxAge == "3_5") { echo "hover"; } ?>" rel="3_5">3-5年</li>
                                    <li class="<?php if($minAge."_".$maxAge == "5_8") { echo "hover"; } ?>" rel="5_8">5-8年</li>
                                    <li class="<?php if($minAge."_".$maxAge == "8_30") { echo "hover"; } ?>" rel="8_30">8年以上</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mileage sbtn fl">
                        <div class="sbtn-wrap">
                            <div class="gray-arrow">
                                <?php
                                if(($maxMile == "" || $maxMile == "0") && ($minMile == "" || $minMile == "0")) {
                                    echo "不限里程";
                                }else {
                                    if($maxMile == "" || $maxMile == "0") {
                                        echo $minMile."万公里以上";
                                    }else if($minMile == "" || $minMile == "0") {
                                        echo $maxMile."万公里以内";
                                    }else {
                                        echo $minMile."-".$maxMile."万公里";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mileage-cont">
                            <div class="price_l clearfix">
                                <ul>
                                    <li class="<?php if($minMile."_".$maxMile == "0_0") { echo "hover"; } ?>" rel="0_0">不限里程</li>
                                    <li class="<?php if($minMile."_".$maxMile == "0_1") { echo "hover"; } ?>" rel="0_1">1万公里以内</li>
                                    <li class="<?php if($minMile."_".$maxMile == "1_3") { echo "hover"; } ?>" rel="1_3">1-3万公里</li>
                                    <li class="<?php if($minMile."_".$maxMile == "3_6") { echo "hover"; } ?>" rel="3_6">3-6万公里</li>
                                    <li class="<?php if($minMile."_".$maxMile == "6_20") { echo "hover"; } ?>" rel="6_20">6万公里以上</li>
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
                <div class="advSearch" style="display: none;">
                    <div id="classifyBox" class="searchBox clearfix first-box">
                        <div class="searchLabel fl">车型</div>
                        <div class="searchItem fl">
                            <ul>
                                <li class="<?php if($classify == "") { echo "hover"; } ?>" rel="">不限</li>
                                <li class="<?php if($classify == "微型车") { echo "hover"; } ?>" rel="微型车">微型车</li>
                                <li class="<?php if($classify == "小型车") { echo "hover"; } ?>" rel="小型车">小型车</li>
                                <li class="<?php if($classify == "紧凑型车") { echo "hover"; } ?>" rel="紧凑型车">紧凑型车</li>
                                <li class="<?php if($classify == "中型车") { echo "hover"; } ?>" rel="中型车">中型车</li>
                                <li class="<?php if($classify == "中大型车") { echo "hover"; } ?>" rel="中大型车">中大型车</li>
                                <li class="<?php if($classify == "豪华型车") { echo "hover"; } ?>" rel="豪华型车">豪华型车</li>
                                <li class="<?php if($classify == "跑车") { echo "hover"; } ?>" rel="跑车">跑车</li>
                                <li class="<?php if($classify == "皮卡") { echo "hover"; } ?>" rel="皮卡">皮卡</li>
                                <li class="<?php if($classify == "微卡") { echo "hover"; } ?>" rel="微卡">微卡</li>
                                <li class="<?php if($classify == "微面") { echo "hover"; } ?>" rel="微面">微面</li>
                                <li class="<?php if($classify == "轻客") { echo "hover"; } ?>" rel="轻客">轻客</li>
                                <li class="<?php if($classify == "MPV") { echo "hover"; } ?>" rel="MPV">MPV</li>
                                <li class="dropdown" rel="0_0">
                                    <div class="<?php if($classify == "小型SUV" || $classify == "紧凑型SUV" || $classify == "中型SUV" || $classify == "中大型SUV" || $classify == "全尺寸SUV") { echo "hover"; } ?> suv">SUV<i class="arrow-down"></i></div>
                                    <div class="bottom-name-list">
                                        <ul>
                                            <li class="<?php if($classify == "小型SUV") { echo "hover"; } ?>">小型SUV</li>
                                            <li class="<?php if($classify == "紧凑型SUV") { echo "hover"; } ?>">紧凑型SUV</li>
                                            <li class="<?php if($classify == "中型SUV") { echo "hover"; } ?>">中型SUV</li>
                                            <li class="<?php if($classify == "中大型SUV") { echo "hover"; } ?>">中大型SUV</li>
                                            <li  class="last <?php if($classify == "全尺寸SUV") { echo "hover"; } ?>">全尺寸SUV</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="controlBox" class="searchBox clearfix">
                        <div class="searchLabel fl">变速箱</div>
                        <div class="searchItem fl">
                            <ul>
                                <li class="<?php if($control == "") { echo "hover"; } ?>" rel="">不限</li>
                                <li class="<?php if($control == "手动") { echo "hover"; } ?>" rel="手动">手动</li>
                                <li class="<?php if($control == "自动") { echo "hover"; } ?>" rel="自动">自动</li>
                            </ul>
                        </div>
                    </div>
                    <div id="volumeBox" class="searchBox clearfix last-box">
                        <div class="searchLabel fl">排量</div>
                        <div class="searchItem fl">
                            <ul>
                                <li class="<?php if($minvolume."_".$maxvolume == "_") { echo "hover"; } ?>" rel="_">不限</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "0_1.0") { echo "hover"; } ?>" rel="0_1.0">1.0升以内</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "1.1_1.6") { echo "hover"; } ?>" rel="1.1_1.6">1.1-1.6升</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "1.7_2.0") { echo "hover"; } ?>" rel="1.7_2.0">1.7-2.0升</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "2.1_2.5") { echo "hover"; } ?>" rel="2.1_2.5">2.1-2.5升</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "2.6_3.0") { echo "hover"; } ?>" rel="2.6_3.0">2.6-3.0升</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "3.1_4.0") { echo "hover"; } ?>" rel="3.1_4.0">3.1-4.0升</li>
                                <li class="<?php if($minvolume."_".$maxvolume == "4.0_99.0") { echo "hover"; } ?>" rel="4.0_99.0">4.0升以上</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="top-cont">
                    <div class="totalnum fl">共找到 <span class="font-orange"><?php echo $this->totalNum?$this->totalNum:0 ?></span> 辆车</div>
                    <div class="tags fl">
                        <ul>
                            <?php
                            if($this->searchCon["brandName"]!="选择品牌名称，体验快速查找" && !XF_Functions::isEmpty($this->searchCon["brandName"])) {
                            ?>
    						<li><?php echo $this->searchCon["brandName"] ?><i class="icon-close"></i></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="sort fr">
                        <div class="sort-res fl">排序：<span>
	                        <?php
	                        if($order_key == "price" || $order_key == "-price") {
		                        echo "价格";
	                        }else if($order_key == "mile" || $order_key == "-mile") {
		                        echo "里程";
	                        }else if($order_key == "year" || $order_key == "-year") {
		                        echo "车龄";
	                        }else {
		                        echo "默认";
	                        }
	                        ?>
                        </span></div>
                        <div class="sort-l fl">
                            <ul>
                                <li rel="price" class="<?php if($order_key == "price") { echo "icon-up"; }else { echo "icon-down"; }?>">价格<i class="icon"></i></li>
                                <li rel="mile" class="<?php if($order_key == "mile") { echo "icon-up"; }else { echo "icon-down"; }?>">里程<i class="icon"></i></li>
                                <li rel="year" class="<?php if($order_key == "year") { echo "icon-up"; }else { echo "icon-down"; }?>">车龄<i class="icon"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="used-list clearfix">
                    <?php
                    foreach ($this->usedList->cars as $used){
                    ?>
                    <div class="useditem" id="used_<?php echo $used->id ?>">
                        <div class="preview"><a href="http://www.<?php echo $this->domain; ?>/index/linkSite/?slink=<?php echo $used->url; ?>&sname=原网站"><img class="lazy" src="<?php echo $used->thumbnail ?>" /></a></div>
                        <div class="font-bold row title" title="<?php echo $used->title ?>"><a href="http://www.<?php echo $this->domain; ?>/index/linkSite/?slink=<?php echo $used->url; ?>&sname=原网站"><?php echo $used->title ?></a></div>
                        <div class="info row">
                            <div class="usedl fl">&yen;<?php echo $used->price ?> 万</div>
                            <div class="usedr fr">
                                <div class="carage"><?php echo $used->car_age."年" ?></div>
                                <div class="mileage"><?php echo $used->mile; ?>万公里</div>
                            </div>
                        </div>
                        <div class="price row"><?php echo $used->deal_price; ?></div>
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
                        <?php
                        if($totalPage != 1) {
                        ?>
                        <div class="prev fr"><a href="/used/index/index?page=<?php echo $activeNo-1; ?>">&lt;&nbsp;上一页</a></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="tipinfo" style="display: none;">
            <img src="$static/img/loading.gif" height="24px" width="24px" alt="正在加载..." />
        </div>
    </form>
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
            </div>
        </div>
    </div>
</div>