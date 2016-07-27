var vs = document.getElementById('thumb_img').firstChild;
chimg(vs);

function chimg(v) {
	var src = v.src.replace(/thumb/, "goods");
	document.getElementById('goods_img').firstChild.src=src;
}

function addQty() {
	var qty = document.getElementById('qty_input');
	qty.value = parseInt(qty.value) + 1;
}

function redQty() {
	var qty = document.getElementById('qty_input');
	if (qty.value != '0') {
		qty.value = parseInt(qty.value) - 1;
	}
	
}