<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/Admin/Goods/edit?id=21" method="post" id="aform" enctype="multipart/form-data">
	<P><label for="name">商品名称:  </label><input type="text" id='name' name="name" value="<?php echo ($info["name"]); ?>"/></P>
	<p><label for="category">商品分类: </label>
		<select name="cat_id" id="category">
			<option value="0" <?php if(($info["cat_id"]) == "0"): ?>selected="selected"<?php endif; ?>>无</option>
			<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if(($info["cat_id"]) == $v["id"]): ?>selected="selected"<?php endif; ?>><?php echo (str_repeat("&nbsp;",$v["lev"]*4)); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
		</select>
	</p>
	<p><label for="ori_img">上传图片: </label><input type="file" id="ori_img" name="ori_img" onchange="showimg();"/></p>
	<div><img id='img_show' src="" ><span></span></div>
	<P><label for="shop_price">本店售价  </label><input type="text" id='shop_price' name="shop_price" value="<?php echo ($info["shop_price"]); ?>"/>[合法格式(不能为0, 小数点后两位, 整数部分不能有0填充): 100, 0.12, 100.12]</P>
	<P><label for="market_price">市场售价：  </label><input type="text" id='market_price' name="market_price" value="<?php echo ($info["market_price"]); ?>" /></P>
	<P>
		<label for="weight">商品重量：  </label><input type="text" id='weight' name="weight" value="<?php echo ($info["weight"]); ?>" />
		<select name="weight_unit"><option value="1" selected>千克</option><option value="0.001">克</option></select>
	</P>
	<P><label for="goods_number">商品库存数量：  </label><input type="text" id='goods_number' name="goods_number" value="<?php echo ($info["goods_number"]); ?>"/></P>
	<P>
		<label for="">加入推荐：  
		<input type="checkbox" name="is_best" value="<?php echo ($info["is_new"]); ?>"  />精品 
		<input type="checkbox" name="is_new" value="<?php echo ($info["is_new"]); ?>"  />新品 
		<input type="checkbox" name="is_hot" value="<?php echo ($info["is_hot"]); ?>"  />热销
	</P>
	<P><label for="is_on_sale">上架：  </label><input type="checkbox" id="is_on_sale" name="is_on_sale" value="<?php echo ($info["is_on_sale"]); ?>" checked="checked" /> 打勾表示允许销售，否则不允许销售。</P>
	<P><label for="keywords">关键词：  </label><input type="text" id="keywords" name="keywords" value="<?php echo ($info["keywords"]); ?>" /> 用英文逗号分隔</P>
	<P><label for="brief">商品简单描述(10到100字符)：  </label></P><textarea name="brief" cols="40" rows="3"><?php echo ($info["brief"]); ?></textarea>

	<P><label for="goods_desc">商品详细描述：  </label></P><script type="text/plain" id="editor" name="goods_desc" style="height:200px;"><?php echo ($info["goods_desc"]); ?></script>

	<P><label for="seller_note">商家备注：  </label></P><textarea id="seller_note" name="seller_note" cols="30" rows="2"><?php echo ($info["seller_note"]); ?></textarea></p>
	<input type="text" hidden='hidden' name="id" value='<?php echo ($info["id"]); ?>'/>
	<button type='submit'>确定</button>
</form>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript" src="http://devenv/newshop/Application//Public/component/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="http://devenv/newshop/Application//Public/component/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor("editor");
</script>
<script type="text/javascript">
function showimg() {
	var pic=document.getElementById('ori_img').files[0];
	//console.log(pic);
	if(pic!=false) {
		var img_src=window.URL.createObjectURL(pic);	//二进制写进浏览器
		//console.log(img_src);
		var dom_img = document.getElementById('img_show')
		dom_img.src=img_src;
		dom_img.style.height='200px';
		var cont = '';
		cont += '待上传文件名称:' + pic.name + ' -- ';
    	cont += '大小: ' + pic.size/1024+'kb';
		dom_img.nextSibling.innerHTML=cont;
	}
}
</script>
</body>
</html>