<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>公平价 - 估值详情</title>
	<link rel="stylesheet" href="$static/css/base.css"  />
	<link rel="stylesheet" href="$static/css/report/report.css"  />
	<link rel="stylesheet" href="$static/css/valid.css"  />
	<script src="$static/js/jquery/jquery-1.11.1.js"></script>
	<script src="$static/js/layer/layer.js"></script>
	<script src="$static/js/jquery/Validform_v5.3.2.js"></script>
	<script src="$static/js/date/WdatePicker.js"></script>
	<script src="$static/js/pagejs/sellreport.js"></script>
</head>
<body>
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
						<li class="car-series"><?php echo $this->type->detail_model ?></li>
						<li class="r-form-even">
							<label>上牌时间</label><a class="form-text" onClick="WdatePicker({dateFmt:'yyyy年'})" href="javascript:;">2011年</a>
						</li>
						<li>
							<label>上牌城市</label><a class="form-text" href="javascript:;"><?php echo $this->nowCity->name; ?></a>
						</li>
						<li class="r-form-even">
							<label>行驶里程</label><input datatype="plusInt" nullmsg="不能空" class="form-text form-input" type="text" />
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
									<div class="carmodel"><?php echo $item->detail_model ?></div>
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
					<p class="g-cost"><span>26.99</span>万元</p>
					<div class="count">
						<div class="fl count-group">
							<h5>分析数量总数</h5>
							<p>451,327</p>
						</div>
						<div class="fr count-group">
							<h5>估值准确率</h5>
							<p>93.67%</p>
						</div>
					</div>
				</div>
				<ul class="r-sells">
					<li class="sealer">
						<h2>卖给商家</h2>
						<p class="title-msg">3日内成交 安全快捷</p>
						<p class="sell-cost"><span>24.97</span> - <span>27.36</span><label>万元</label></p>
					</li>
					<li class="sFour">
						<h2>卖给4S店</h2>
						<p class="title-msg">服务有保障 手续快捷方便</p>
						<p class="sell-cost"><span>24.97</span> - <span>27.36</span><label>万元</label></p>
					</li>
					<li class="self">
						<h2>卖给个人</h2>
						<p class="title-msg">省去中间环节 透明交易流程</p>
						<p class="sell-cost"><span>24.97</span> - <span>27.36</span><label>万元</label></p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>

