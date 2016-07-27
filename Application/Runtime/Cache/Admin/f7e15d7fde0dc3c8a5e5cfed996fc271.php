<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<p><?php echo ($info); ?></p>
<form action="/newshop/index.php/Admin/Manager/assignRole.html" method="post" >
	<p>
		<label for="">管理员</label>
		<select name="uid" id="uid">
			<option value="">请选择</option>
			<?php if(is_array($mg_group_list)): foreach($mg_group_list as $key=>$v): ?><option value="<?php echo ($v["uid"]); ?>"><?php echo ($v["username"]); ?></option><?php endforeach; endif; ?>
		</select>
		<label for="">角色</label>
		<select name="group_id" id="group_id">
			<option value="">请选择</option>
			<?php if(is_array($group_list)): foreach($group_list as $key=>$vv): ?><option value="<?php echo ($vv["id"]); ?>"><?php echo ($vv["title"]); ?></option><?php endforeach; endif; ?>
		</select>
		<button type="submit">提交</button>
	</p>
</form>

<table border="1">
<tr>
<th>管理员</th>
<th>角色</th>
<th>操作</th>
</tr>

<?php if(is_array($mg_group_list)): foreach($mg_group_list as $key=>$d): ?><tr>
<td><?php echo ($d["username"]); ?></td>
<td><?php echo ($d["title"]); ?></td>
<td><a href="#">重置权限</a></td>
</tr><?php endforeach; endif; ?>


<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
</body>
</html>