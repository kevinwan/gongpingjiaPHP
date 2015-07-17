<div id="main" class="bscreen">
    <div class="report">
        <div id="top">
                <div class="wrap">
                        <div id="logo"><img src="$static/img/index/logo.png" /></div>
                            <div class="selarea">
                                <div class="label-text">当前地区：</div>
                                <div class="area">北京</div>
                        </div>
                </div>
        </div>
            <div class="r-choose">
                    <form name="srcForm" id="srcForm" action="" verify="true">
                            <div class="r-logo"></div>
                            <ul class="r-form">
                                    <input type="hidden" name="serialId" id="serialId" value="<?php echo $this->serialId ?>" />
                                    <li class="car-series"><?php echo $this->type->detail_model ?></li>
                                    <input type="hidden" name="typeid" id="typeid" value="<?php echo $this->type->id ?>" />
                                    <li class="r-form-even">
                                        <label>上牌时间</label><a class="form-text" id="year" onClick="WdatePicker({dateFmt:'yyyy'})" href="javascript:;">2011</a>年
                                    </li>
                                    <li>
                                        <label>上牌城市</label><a class="form-text" id="city" py="<?php echo $this->nowCity->pinyin; ?>" href="javascript:;"><?php echo $this->nowCity->name; ?></a>
                                    </li>
                                    <li class="r-form-even">
                                        <label>行驶里程</label><input datatype="float" name="mileage" id="mileage" nullmsg="不能空" class="form-text form-input" value="<?php echo $this->mileage; ?>" type="text" />
                                            <span>万公里</span>
                                    </li>
                            </ul>
                            <a class="more-car" href="javascript:;" onclick="sellreport();">更新爱车信息</a>
                            <div id="selectcar" class="selectcar" style="display: none;">
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
                    </form>
            </div>
            <div class="r-cost">
                    <div class="r-math">
                            <h4>您爱车的公平价值为</h4>
                            <p class="g-cost"><span><?php echo $this->V->deal_price; ?></span>万元</p>
                            <div class="count">
                                    <div class="fl count-group">
                                            <h5>分析数量总数</h5>
                                            <p><?php echo $this->V->analysis_car_count; ?></p>
                                    </div>
                                    <div class="fr count-group">
                                            <h5>估值准确率</h5>
                                            <p><?php echo $this->V->accuracy ?>%</p>
                                    </div>
                            </div>
                    </div>
                    <ul class="r-sells">
                            <li class="sealer">
                                    <h2>卖给商家</h2>
                                    <p class="title-msg">3日内成交 安全快捷</p>
                                    <p class="sell-cost"><span><?php echo $this->V->min_sell_price; ?></span> - <span><?php echo $this->V->max_sell_price; ?></span><label>万元</label></p>
                            </li>
                            <li class="sFour">
                                    <h2>卖给4S店</h2>
                                    <p class="title-msg">服务有保障 手续快捷方便</p>
                                    <p class="sell-cost"><span><?php echo $this->V->min_replace_price; ?></span> - <span><?php echo $this->V->max_replace_price; ?></span><label>万元</label></p>
                            </li>
                            <li class="self">
                                    <h2>卖给个人</h2>
                                    <p class="title-msg">省去中间环节 透明交易流程</p>
                                    <p class="sell-cost"><span><?php echo $this->V->min_private_price; ?></span> - <span><?php echo $this->V->max_private_price; ?></span><label>万元</label></p>
                            </li>
                    </ul>
            </div>
    </div>
</div>

