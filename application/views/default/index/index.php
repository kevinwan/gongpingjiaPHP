	<div id="wrapper">
		<div id="top">
			<div class="wrap">
                <div id="logo"><a href="<?php echo "http://".$this->nowCity->pinyin.".".$this->domain; ?>"><img src="$static/img/index/logo.png" /></a></div>
				<div class="selarea">
					<div class="label-text">当前地区：</div>
					<div class="area"><?php echo $this->nowCity->name; ?></div>
				</div>
			</div>
		</div>
		<div id="search">
			<form action="" method="post">
				<input id="switch" type="hidden" name="switch" value="sale" />
				<input id="buyId" type="hidden" name="buyId" value="" />
				<div class="wrap">
					<div class="lable-text salebtn">
					</div>
					<div class="label-value">
						<div class="salebox" ></div>
						<div class="buybox" style="display: none;"><input id="typeahead-input" name="" value=""></div>
					</div>
					<div class="subbtn"><input id="searchbtn" type="button" class="searchbtn" value="" /></div>
				</div>
			</form>
		</div>
		<a href="/used/index/index" id="carMore">随便看看...</a>
		<div id="cdsSearchBox" style="display: none;">
			<div class="cdsSearchMain clearfix">
				<div class="cdsbrandbg"></div>
				<div class="cds_searTabBox clearfix">
					<div class="cds_searTab clearfix cds_searShow">
						<div class="cdsSbrand clearfix">
							<div class="csbNav">
								<a class="active" href="javascript:;">A</a><a href="javascript:;">B</a><a href="javascript:;">C</a><a href="javascript:;">D</a><a href="javascript:;">F</a><a href="javascript:;">G</a><a href="javascript:;">H</a><a href="javascript:;">J</a><a href="javascript:;">K</a><a href="javascript:;">L</a><a href="javascript:;">M</a><a href="javascript:;">N</a><a href="javascript:;">O</a><a href="javascript:;">Q</a><a href="javascript:;">R</a><a href="javascript:;">S</a><a href="javascript:;">T</a><a href="javascript:;">W</a><a href="javascript:;">X</a><a href="javascript:;">Y</a><a href="javascript:;">Z</a>
							</div>
							<div class="cdsBtabBox">
							</div>
						</div>
						<!--车系-->
						<div class="cdsStabBox cdsStabbg" style="overflow-y: scroll; display: block;">
						<!--点击品牌的车系-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="copyright">Copyright &copy; gongpingjia.com All Rights Reserved</div>
	</div>