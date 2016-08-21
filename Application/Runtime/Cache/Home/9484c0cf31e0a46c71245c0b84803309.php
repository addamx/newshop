<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>NEWSHOP - </title>
        <link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/style.css" />
        <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
    </head>
<body>
<div id="banner">

<div id="banner1"><h1>M - C: <?php echo (MODULE_NAME); ?> -- <?php echo (CONTROLLER_NAME); ?></h1>	</div>
<div id='log'><div id="person">用户登录状态: 
	<?php if(($_SESSION['user']) != ""): ?><div><a href="/newshop/Index.php/Home/User/index">个人中心</a>&nbsp;&nbsp;&nbsp;<a href="/newshop/Index.php/Home/User/logout"><button>退出</button></a></div>
	<?php else: ?>
	<div>未登录&nbsp;&nbsp;&nbsp;<a href="/newshop/Index.php/Home/user/login"><button>登录</button></a><a href="/newshop/Index.php/Home/User/register"><button>注册</button></a></div><?php endif; ?>
	</div>
<div style="text-align:right;"><a href="/newshop/Index.php/admin/manager/login">管理员后台</a></div>
</div>
</div>





<div id='bread'>
	<ul>
	<li><a href="/newshop/Index.php/Home/Index/index">首页</a></li>
	<?php if(is_array($breadmenu)): foreach($breadmenu as $key=>$v): ?><span>-></span>
	<li><a href="/newshop/Index.php/<?php echo ($v["name"]); ?>"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; ?>
	</ul>
</div>







<link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/userindex.css" />

<div id="left">
<p>功能中心</p>
</div>

<block name="main">
<div id="main">
<table>
<tr>
	<th>订单号</th>
	<th>姓名</th>
	<th>手机号码</th>
	<th>地址</th>
	<th>支付方式</th>
	<th>备注</th>
	<th>总价</th>
	<th>下单时间</th>
	<th>支付状态</th>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
<td><?php echo ($v["ord_sn"]); ?></td>
<td><?php echo ($v["xm"]); ?></td>
<td><?php echo ($v["mobile"]); ?></td>
<td><?php echo ($v["address"]); ?></td>
<td><?php if(($v["paytype"]) == "1"): ?><span>在线支付</span><?php else: ?><span>货到付款</span><?php endif; ?></td>
<td><?php echo ($v["note"]); ?></td>
<td><?php echo ($v["money"]); ?></td>
<td><?php echo (date("Y/m/d",$v["ordtime"])); ?></td>
<td><?php if(($v["paystatus"]) == "0"): ?><span>未支付</span><a href="">去支付</a><?php else: ?><span>已支付</span><?php endif; ?></td>
</tr><?php endforeach; endif; ?>
</table>
</div>





<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>