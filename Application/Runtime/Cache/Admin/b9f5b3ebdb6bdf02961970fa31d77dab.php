<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<table border="1">
<tr>
<th>Id</th>
<th>Username</th>
<th>Email</th>
<th>Phone</th>
<th>Register_time</th>
<th>last_login_ip</th>
<th>last_login_time</th>
<th colspan="2">操作</th>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
<td><?php echo ($v["id"]); ?></td>
<td><?php echo ($v["username"]); ?></td>
<td><?php echo ($v["email"]); ?></td>
<td><?php echo ($v["phone"]); ?></td>
<td><?php echo (date("Y/m/d",$v["register_time"])); ?></td>
<td><?php echo ($v["last_login_ip"]); ?></td>
<td><?php echo ($v["last_login_time"]); ?></td>
<td><a href="/newshop/index.php/Admin/Manager/editManager?id=<?php echo ($v["id"]); ?>">编辑</a></td>
<td><a href="/newshop/index.php/Admin/Manager/delManager?id=<?php echo ($v["id"]); ?>" onclick="return recheck('<?php echo ($v["username"]); ?>');">删除</a></td>
</tr><?php endforeach; endif; ?>
</table>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript">
function recheck(name) {
	if(!confirm("确定要删除"+name+"管理员么?")){return false;};
}

</script>


</body>
</html>