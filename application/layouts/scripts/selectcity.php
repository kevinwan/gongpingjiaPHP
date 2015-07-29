<?php
$domain = $this->domain;
$tmp = explode('com', $this->referer);
$domain = $domain.'/?redirect_url='.urlencode($tmp[1]);
?>
<div id="selarea" style="display: none;">
	<div class="dialogs-title">猜你要去 <a class="defsel" href="http://beijing.<?php echo $domain;?>">北京站</a> 或者 <a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://shanghai.<?php echo $domain;?>">上海</a> <a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://guangdong.<?php echo $domain;?>">广东</a> <a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://chongqing.<?php echo $domain;?>">重庆</a> <a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://jiangsu.<?php echo $domain;?>">江苏</a> <a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://shanxi.<?php echo $domain;?>">山西</a> <a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://shandong.<?php echo $domain;?>">山东</a></div>
	<div class="dialogs-cont">
		<p class="subtitle">请选择您的地区：</p>
		<div class="area clearfix">
			<div class="label-text">直辖市</div>
			<div class="label-value">
				<a <?php if($this->nowCity->pinyin == "beijing"){ echo 'class="defsel"'; } ?> href="http://beijing.<?php echo $domain;?>">北京</a>
                <a <?php if($this->nowCity->pinyin == "shanghai"){ echo 'class="defsel"'; } ?> href="http://shanghai.<?php echo $domain;?>">上海</a>
                <a <?php if($this->nowCity->pinyin == "chongqing"){ echo 'class="defsel"'; } ?> href="http://chongqing.<?php echo $domain;?>">重庆</a>
                <a <?php if($this->nowCity->pinyin == "tianjin"){ echo 'class="defsel"'; } ?> href="http://tianjin.<?php echo $domain;?>">天津</a>
			</div>
		</div>
		<div class="area clearfix">
			<div class="label-text">华北东北</div>
			<div class="label-value">
				<a <?php if($this->nowCity->pinyin == "hebei"){ echo 'class="defsel"'; } ?> href="http://hebei.<?php echo $domain;?>">河北</a>
                <a <?php if($this->nowCity->pinyin == "shanxi"){ echo 'class="defsel"'; } ?> href="http://shanxi.<?php echo $domain;?>">山西</a>
                <a <?php if($this->nowCity->pinyin == "neimenggu"){ echo 'class="defsel"'; } ?> href="http://neimenggu.<?php echo $domain;?>">内蒙古</a>
                <a <?php if($this->nowCity->pinyin == "heilongjiang"){ echo 'class="defsel"'; } ?> href="http://heilongjiang.<?php echo $domain;?>">黑龙江</a>
                <a <?php if($this->nowCity->pinyin == "jilin"){ echo 'class="defsel"'; } ?> href="http://jilin.<?php echo $domain;?>">吉林</a>
                <a <?php if($this->nowCity->pinyin == "liaoning"){ echo 'class="defsel"'; } ?> href="http://liaoning.<?php echo $domain;?>">辽宁</a>
			</div>
		</div>
		<div class="area clearfix">
			<div class="label-text">华东地区</div>
			<div class="label-value">
				<a <?php if($this->nowCity->pinyin == "shandong"){ echo 'class="defsel"'; } ?> href="http://shandong.<?php echo $domain;?>">山东</a>
                <a <?php if($this->nowCity->pinyin == "jiangsu"){ echo 'class="defsel"'; } ?> href="http://jiangsu.<?php echo $domain;?>">江苏</a>
                <a <?php if($this->nowCity->pinyin == "zhejiang"){ echo 'class="defsel"'; } ?> href="http://zhejiang.<?php echo $domain;?>">浙江</a>
                <a <?php if($this->nowCity->pinyin == "anhui"){ echo 'class="defsel"'; } ?> href="http://anhui.<?php echo $domain;?>">安徽</a>
                <a <?php if($this->nowCity->pinyin == "fujian"){ echo 'class="defsel"'; } ?> href="http://fujian.<?php echo $domain;?>">福建</a>
			</div>
		</div>
		<div class="area clearfix">
			<div class="label-text">中南西北</div>
			<div class="label-value">
				<a <?php if($this->nowCity->pinyin == "henan"){ echo 'class="defsel"'; } ?> href="http://henan.<?php echo $domain;?>">河南</a>
                <a <?php if($this->nowCity->pinyin == "hubei"){ echo 'class="defsel"'; } ?> href="http://hubei.<?php echo $domain;?>">湖北</a>
                <a <?php if($this->nowCity->pinyin == "hunan"){ echo 'class="defsel"'; } ?> href="http://hunan.<?php echo $domain;?>">湖南</a>
                <a <?php if($this->nowCity->pinyin == "jiangxi"){ echo 'class="defsel"'; } ?> href="http://jiangxi.<?php echo $domain;?>">江西</a>
                <a <?php if($this->nowCity->pinyin == "sichuan"){ echo 'class="defsel"'; } ?> href="http://sichuan.<?php echo $domain;?>">四川</a>
                <a <?php if($this->nowCity->pinyin == "yunnan"){ echo 'class="defsel"'; } ?> href="http://yunnan.<?php echo $domain;?>">云南</a>
                <a <?php if($this->nowCity->pinyin == "guizhou"){ echo 'class="defsel"'; } ?> href="http://guizhou.<?php echo $domain;?>">贵州</a>
                <a <?php if($this->nowCity->pinyin == "xizang"){ echo 'class="defsel"'; } ?> href="http://xizang.<?php echo $domain;?>">西藏</a>
                <a <?php if($this->nowCity->pinyin == "ningxia"){ echo 'class="defsel"'; } ?> href="http://ningxia.<?php echo $domain;?>">宁夏</a>
                <a <?php if($this->nowCity->pinyin == "xinjiang"){ echo 'class="defsel"'; } ?> href="http://xinjiang.<?php echo $domain;?>">新疆</a>
                <a <?php if($this->nowCity->pinyin == "qinghai"){ echo 'class="defsel"'; } ?> href="http://qinghai.<?php echo $domain;?>">青海</a>
                <a <?php if($this->nowCity->pinyin == "sx"){ echo 'class="defsel"'; } ?> href="http://sx.<?php echo $domain;?>">陕西</a>
                <a <?php if($this->nowCity->pinyin == "gansu"){ echo 'class="defsel"'; } ?> href="http://gansu.<?php echo $domain;?>">甘肃</a>
			</div>
		</div>
		<div class="area clearfix">
			<div class="label-text">华南地区</div>
			<div class="label-value">
				<a <?php if($this->nowCity->pinyin == "guangdong"){ echo 'class="defsel"'; } ?> href="http://guangdong.<?php echo $domain;?>">广东</a>
                <a <?php if($this->nowCity->pinyin == "guangxi"){ echo 'class="defsel"'; } ?> href="http://guangxi.<?php echo $domain;?>">广西</a>
                <a <?php if($this->nowCity->pinyin == "hainan"){ echo 'class="defsel"'; } ?> href="http://hainan.<?php echo $domain;?>">海南</a>
			</div>
		</div>
	</div>
</div>