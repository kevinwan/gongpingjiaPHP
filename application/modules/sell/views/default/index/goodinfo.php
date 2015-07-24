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
    <!-- 补充信息 [[ -->
    <div class="content">
        <form id="srcform" action="" method="post">
            <input type="hidden" name="statue" value="<?php echo $this->statue; ?>" />
            <h2 class="info-title"><span>补充信息</span></h2>
            <p class="info-msg">补充更多信息，让买家对您的爱车有更多了解</p>
            <ul class="info-list">
                <li class="info-match">
                    <label>是否匹配</label>
                    <div>
                        <a class="" href="javascript:;">
                            <input type="checkbox" name="car_parts[]" value="gps"/>
                            GPS导航
                        </a>
                        <a class="info-match-margin" href="javascript:;">
                            <input type="checkbox" name="car_parts[]" value="radar"/>
                            倒车雷达
                        </a>
                        <a href="javascript:;">
                            <input type="checkbox" name="car_parts[]" value="recorder"/>
                            行车记录仪
                        </a>
                    </div>
                </li>
                <li>
                    <label>车辆颜色</label>
                    <div class="info-choose-out">
                        <input name="car_color" readonly="readonly" type="text" value="" class="info-choose-txt">
                        <a class="info-choose-tri" href="javascript:;"><img src="$static/img/sell/info-choose-tri.png"></a>
                        <!-- 车辆颜色的选择部分 [[ -->
                        <div class="info-choose-in info-choose-color">
                            <div class="info-choose-in-one">
                                <a><span class="info-color-black"></span><span>黑色</span></a>
                                <a><span class="info-color-white"></span><span>白色</span></a>
                                <a><span class="info-color-silvery"></span><span>银色</span></a>
                                <a><span class="info-color-gray"></span><span>灰色</span></a>
                                <a><span class="info-color-red"></span><span>红色</span></a>
                                <a><span class="info-color-brown"></span><span>棕色</span></a>
                                <a><span class="info-color-hbrown"></span><span>褐色</span></a>
                                <a><span class="info-color-blue"></span><span>蓝色</span></a>
                                <a><span class="info-color-chestnut"></span><span>栗色</span></a>
                                <a><span class="info-color-golden"></span><span>金色</span></a>
                                <a><span class="info-color-orange"></span><span>橙色</span></a>
                                <a><span class="info-color-cream"></span><span>米色</span></a>
                                <a><span class="info-color-yellow"></span><span>黄色</span></a>
                                <a><span class="info-color-purple"></span><span>紫色</span></a>
                                <a><span class="info-color-indigo"></span><span>青色</span></a>
                                <a><span class="info-color-green"></span><span>绿色</span></a>
                            </div>
                        </div>
                        <!-- 车辆颜色的选择部分 ]] -->
                    </div>
                </li>
                <li>
                    <label>保险有效期</label>
                    <div class="info-choose-out">
                        <input name="period_insurance" type="text" readonly="readonly" class="info-choose-txt">
                        <a class="info-choose-tri" href="javascript:;"><img src="$static/img/sell/info-choose-tri.png"></a>
                        <!-- 车辆保险有效期的选择部分 [[ -->
                        <div class="info-choose-in  info-choose-insure">
                            <div class="info-choose-in-one">
                                <!-- 这里的info-choose-active是选中状态 -->
                                <a>2015</a>
                                <a>2016</a>
                                <a>2017</a>
                            </div>
                            <div class="info-choose-in-two" data-value="">
                                <a>1</a>
                                <a>2</a>
                                <a>3</a>
                                <a>4</a>
                                <a>5</a>
                                <a>6</a>
                                <a>7</a>
                                <a>8</a>
                                <a>9</a>
                                <a>10</a>
                                <a>11</a>
                                <a>12</a>
                            </div>
                        </div>
                        <!-- 车辆保险有效期的选择部分 ]] -->
                    </div>
                </li>
                <li>
                    <label>保养情况</label>
                    <div class="info-choose-out">
                        <input name="car_maintain" readonly="readonly" type="text" class="info-choose-txt">
                        <a class="info-choose-tri" href="javascript:;"><img src="$static/img/sell/info-choose-tri.png"></a>
                        <!-- 车辆保养情况的选择部分 [[ -->
                        <div class="info-choose-in info-choose-maintain">
                            <div class="info-choose-in-one">
                                <a>全程4S店保养</a>
                                <a>部分4S店保养</a>
                                <a>无4S点保养</a>
                            </div>
                        </div>
                        <!-- 车辆保养情况的选择部分 ]] -->
                    </div>
                </li>
                <li>
                    <label>最高维修费</label>
                    <input name="max_cost" type="text" maxlength="8">
                </li>
                <li>
                    <label>过户次数</label>
                    <div class="info-choose-out">
                        <input type="text" name="transfer_num" readonly="readonly" class="info-choose-txt">
                        <a class="info-choose-tri" href="javascript:;"><img src="$static/img/sell/info-choose-tri.png"></a>
                        <!-- 车辆过户次数的选择部分 [[ -->
                        <div class="info-choose-in info-choose-time">
                            <div class="info-choose-in-one">
                                <a>1次</a>
                                <a>2次</a>
                                <a>3次以上</a>
                            </div>
                        </div>
                        <!-- 车辆过户次数的选择部分 ]] -->
                    </div>
                </li>
            </ul>
            <div class="btn-list">
                <a href="javascript:;" class="btn-link btn-submit">下一步</a>
            </div>
        </form>
    </div>
    <!-- 补充信息 ]] -->
</div>