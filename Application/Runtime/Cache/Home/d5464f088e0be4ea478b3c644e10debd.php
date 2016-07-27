<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>NEWSHOP -- 首页</title>
        <link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/style.css" />
    </head>
<body>
<div id="banner">

<div id="banner1"><h1>M - C: <?php echo (MODULE_NAME); ?> -- <?php echo (CONTROLLER_NAME); ?></h1>	</div>
<div id='log'><span>登录状态: 
	<?php if(($_SESSION['uname']) != ""): ?><div><?php echo (session('uname')); ?></div>
	<button>退出</button>
	<?php else: ?>未登录<button>登录</button><?php endif; ?>
	</span>
</div>
</div>







<div id='bread'>
	<ul>
	<li><a href="/newshop/Home/Index/index">首页</a></li>
	</ul>
</div>



	<div id='nav'>
	<ul>
		<?php if(is_array($goodcates)): foreach($goodcates as $key=>$v): ?><a href="/newshop/Home/Index/category?cid=<?php echo ($v["id"]); ?>"><li><?php echo (str_repeat("&nbsp;",$v["lev"]*2)); echo ($v["name"]); ?></li></a><?php endforeach; endif; ?>
	</ul>
	</div>



<div id="main" style="width:1000px;">
	<div id="goods" class="">
		<?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div class="good">
				<img src="<?php echo (UPLOAD_URL); echo explode(',', $v['goods_img'])[0]; ?>">
				<div><a href="/newshop/Home/goods/detail?gid=<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></a></div>
				<div>[新品]<span> ¥<?php echo ($v["shop_price"]); ?>&nbsp;&nbsp;<a href="/newshop/Home/Flow/add?id=<?php echo ($v["id"]); ?>">购买</a></span></div>
			</div><?php endforeach; endif; ?>
	</div>
</div>


<script type="text/javascript" src="<?php echo (SITE_URL); ?>/Public//static/home/js/goods.js"></script>



<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>