<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<table border="1" width="60%">
<tr><th>ID</th><th>栏目名</th><th colspan='2'>操作</th></tr>
<?php if(is_array($cats)): foreach($cats as $key=>$v): ?><tr>
<td><?php echo ($v["id"]); ?></td>
<td><?php echo (str_repeat('-->',$v["lev"])); echo ($v["name"]); ?></td>
<td><a href="/newshop/index.php/Admin/Categorys/edit?id=<?php echo ($v["id"]); ?>">编辑</a></td>
<td><a href="/newshop/index.php/Admin/Categorys/del?id=<?php echo ($v["id"]); ?>" onclick="return recheck('<?php echo ($v["name"]); ?>');">删除</a></td>
</tr><?php endforeach; endif; ?>
</table>

<script type="text/javascript">
function recheck(name) {
	if(!confirm("确定要删除栏目["+name+"]么?")){return false;};
}
</script>

</body>
</html>