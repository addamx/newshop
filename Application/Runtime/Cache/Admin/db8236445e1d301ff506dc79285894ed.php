<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<p><label for="category">商品分类: </label>
	<select name="cat_id" id="category" onchange='chcat();'>
		<option value="0" <?php if(($cat) == "0"): ?>selected='selected'<?php endif; ?>>无</option>
		<?php if(is_array($cats)): foreach($cats as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if(($cat) == $v["id"]): ?>selected='selected'<?php endif; ?>><?php echo (str_repeat("&nbsp;",$v["lev"]*4)); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
	</select>
</p>
<table border='1'>
<tr>
	<th>商品名</th>
	<th>序号</th>
	<th>售价</th>
	<th>市场价</th>
	<th>库存</th>
	<th>添加时间</th>
	<th>上次修改</th>
	<th colspan='2'>操作</th>
</tr>
<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
	<td><?php echo ($v["name"]); ?></td>
	<td><?php echo ($v["sn"]); ?></td>
	<td><?php echo ($v["shop_price"]); ?></td>
	<td><?php echo ($v["market_price"]); ?></td>
	<td><?php echo ($v["goods_number"]); ?></td>
	<td><?php echo (date("h:i d/m/Y",$v["add_time"])); ?></td>
	<td><?php echo (date("h:i d/m/Y",$v["last_update"])); ?></td>
	<td><a href="/newshop/index.php/Admin/Goods/edit?id=<?php echo ($v["id"]); ?>">编辑</a></td>
	<td><a href="t.php" onclick="return delgood('<?php echo ($v["id"]); ?>');">删除</a></td>
</tr><?php endforeach; endif; ?>
<tr><td colspan="9" style="text-align: center;"><?php echo ($page); ?></td></tr>
</table>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript">
function delgood(id) {
	$.ajax({
		url: "/newshop/index.php/Admin/Goods/del",
		data: {'id':id},
		type: 'GET',
		dataType: "json",
		success:function(rst) {
			console.log(rst);
			if(rst.result) {
				alert(rst.info);
				window.location.reload();
			}
		}
	})
	return false;
}
function chcat() {
	var cat_id = $('#category').val();
	window.location.href="/newshop/index.php/Admin/Goods/index?p=1&cat="+cat_id;
}

</script>
</body>
</html>