<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>NEWSHOP -- 首页</title>
        <link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/style.css" />
        <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
    </head>
<body>
<div id="banner">

<div id="banner1"><h1>M - C: <?php echo (MODULE_NAME); ?> -- <?php echo (CONTROLLER_NAME); ?></h1>	</div>
<div id='log'><div id="person">用户登录状态: 
	<?php if(($_SESSION['user']) != ""): ?><div><a href="/newshop/index.php/Home/User/index">个人中心</a>&nbsp;&nbsp;&nbsp;<a href="/newshop/index.php/Home/User/logout"><button>退出</button></a></div>
	<?php else: ?>
	<div>未登录&nbsp;&nbsp;&nbsp;<a href="/newshop/index.php/Home/user/login"><button>登录</button></a><a href="/newshop/index.php/Home/User/register"><button>注册</button></a></div><?php endif; ?>
	</div>
<div style="text-align:right;"><a href="/newshop/index.php/admin/manager/login">管理员后台</a></div>
</div>
</div>





<div id='bread'>
	<ul>
	<li><a href="/newshop/index.php/Home/Index/index">首页</a></li>
	<?php if(is_array($breadmenu)): foreach($breadmenu as $key=>$v): ?><span>-></span>
	<li><a href="/newshop/index.php/<?php echo ($v["name"]); ?>"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; ?>
	</ul>
</div>







	<div id='nav'>
	<ul>
		<?php if(is_array($goodcates)): foreach($goodcates as $key=>$v): ?><a href="/newshop/index.php/Home/Index/category?cid=<?php echo ($v["id"]); ?>"><li <?php if(($cid) == $v["id"]): ?>style="background-color:yellow;"<?php endif; ?>><?php echo (str_repeat("&nbsp;",$v["lev"]*2)); echo ($v["name"]); ?></li></a><?php endforeach; endif; ?>
	</ul>
	</div>



<div id="main">
	<div id="newlist" class="goodslist">
	<p>新品促销中....</p>
		<?php if(is_array($newlist)): foreach($newlist as $key=>$v): ?><div class="good newgood">
				<img src="<?php echo (UPLOAD_URL); echo explode(',', $v['goods_img'])[0]; ?>">
				<div><a href="/newshop/index.php/Home/goods/detail?gid=<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></a></div>
				<div>[新品]<span> ¥<?php echo ($v["shop_price"]); ?>&nbsp;&nbsp;<a href="/newshop/index.php/Home/Flow/add?goods_id=<?php echo ($v["id"]); ?>">购买</a></span></div>
			</div><?php endforeach; endif; ?>
	</div>
	<div id="hotlist" class="goodslist">
	<p>热销中....</p>
		<?php if(is_array($hotlist)): foreach($hotlist as $key=>$vv): ?><div class="good newgood">
				<img src="<?php echo (UPLOAD_URL); echo explode(',', $vv['goods_img'])[0]; ?>">
				<div><a href="/newshop/index.php/Home/goods/detail?gid=<?php echo ($vv["id"]); ?>"><?php echo ($vv["name"]); ?></a></div>
				<div>[热销]<span>&nbsp;&nbsp;¥<?php echo ($vv["shop_price"]); ?>&nbsp;&nbsp;<a href="/newshop/index.php/Home/Flow/add?goods_id=<?php echo ($vv["id"]); ?>">购买</a></span></div>
			</div><?php endforeach; endif; ?>
	</div>
</div>



	<div id='right'>
		<?php echo W('Ad/aw');?>
	</div>




<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>