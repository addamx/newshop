<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/admin/goods/add" method="post" id="aform" enctype="multipart/form-data">
	<P><label for="name">商品名称:  </label><input type="text" id='name' name="name"/></P>
	<p><label for="category">商品分类: </label>
		<select name="cat_id" id="category">
			<option value="0">无</option>
			<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo (str_repeat("&nbsp;",$v["lev"]*4)); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
		</select>
	</p>
	<p><label for="ori_img">上传图片: </label><input type="file" id="ori_img1" name="ori_img[]" multiple/>[添加水印, 另外生成商品展示图片, 缩略图]</p>
	<P><label for="shop_price">本店售价  </label><input type="text" id='shop_price' name="shop_price"/>[合法格式(不能为0, 小数点后两位, 整数部分不能有0填充): 100, 0.12, 100.12]</P>
	<P><label for="market_price">市场售价：  </label><input type="text" id='market_price' name="market_price"/></P>
	<P>
		<label for="weight">商品重量：  </label><input type="text" id='weight' name="weight"/>
		<select name="weight_unit"><option value="1" selected>千克</option><option value="0.001">克</option></select>
	</P>
	<P><label for="goods_number">商品库存数量：  </label><input type="text" id='goods_number' name="goods_number"/></P>
	<P>
		<label for="">加入推荐：  
		<input type="checkbox" name="is_best" value="1"  />精品 
		<input type="checkbox" name="is_new" value="1"  />新品 
		<input type="checkbox" name="is_hot" value="1"  />热销
	</P>
	<P><label for="is_on_sale">上架：  </label><input type="checkbox" id="is_on_sale" name="is_on_sale" value="1" checked="checked" /> 打勾表示允许销售，否则不允许销售。</P>
	<P><label for="keywords">关键词：  </label><input type="text" id="keywords" name="keywords" value="" /> 用英文逗号分隔</P>
	<P><label for="brief">商品简单描述：  </label></P><textarea name="brief" cols="40" rows="3"></textarea>

	<P><label for="goods_desc">商品详细：  </label></P><script type="text/plain" id="editor" name="goods_desc" style="height:200px;"></script>

	<P><label for="seller_note">商家备注：  </label></P><textarea id="seller_note" name="seller_note" cols="30" rows="2"></textarea></p>
	<button type='submit'>确定</button>
</form>

<script type="text/javascript" src="http://devenv/newshop/Public/component/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="http://devenv/newshop/Public/component/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor("editor");
</script>
</body>
</html>