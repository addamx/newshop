<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<table border="1" width="100%">
<tr>
	<th>ID</th>
	<th>管理员</th>
	<th>规则</th>
	<th colspan="2">操作</th>
</tr>
<?php if(is_array($group_list)): foreach($group_list as $key=>$v): ?><tr>
	<td><?php echo ($v["id"]); ?></td>
	<td><?php echo ($v["title"]); ?></td>
	<td>
		<ul>
		<?php if(is_array($v["rules"])): foreach($v["rules"] as $key=>$r): if(($r["pid"]) == "0"): ?><li><?php echo ($r["title"]); ?>
				<ul>
				<?php if(is_array($v["rules"])): foreach($v["rules"] as $key=>$rr): if(($rr["pid"]) == $r["id"]): ?><li><?php echo ($rr["title"]); ?>
					</li><?php endif; endforeach; endif; ?>
				</ul>
			</li><?php endif; endforeach; endif; ?>
		</ul>
	</td>
	<td><a href="/newshop/Admin/Group/modify?id=<?php echo ($v["id"]); ?>">编辑</a></td>
	<td><a href="/newshop/Admin/Group/del?id=<?php echo ($v["id"]); ?>">删除</a></td>
</tr><?php endforeach; endif; ?>
</table>