function addQty(v) {
	var qty = document.getElementById(v).previousSibling;
	qty.value = parseInt(qty.value) + 1;
	qty.onchange();
}

function decQty(v) {
	var qty = document.getElementById(v).nextSibling
	if (qty.value != '0') {
		qty.value = parseInt(qty.value) - 1;
		qty.onchange();
	}
	
}


var nums = document.getElementsByClassName('num');
for (i=0; i<nums.length; i++)
{
	nums[i].onchange();
}





function createOB(v) {
	var obed = document.getElementById(v.id);
	var shop_price = obed.parentNode.previousSibling.firstChild.nodeValue;
	var ttlprice = obed.parentNode.nextSibling.firstChild;
	ttlprice.innerHTML = parseInt(v.value) * parseFloat(shop_price);
}