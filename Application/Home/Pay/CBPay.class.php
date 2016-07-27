<?php
namespace Home\Pay;

class CBPay {

	protected $v_mid;
	protected $paykey;
	protected $v_md5info;
	protected $v_url;
	public $v_moneytype = 'CNY';

	public $v_oid;
	public $v_amount;

	public function __construct() {
		$this->v_mid = C('v_mid');
		$this->paykey = C('paykey');
		$this->v_url = C('v_url');
	}

	public function form() {
		$this->crypt(); 
		$str =  '<form method=post action="https://pay3.chinabank.com.cn
			/PayGate">
			<input type=hidden name=v_mid value="{%s}">
			<input type=hidden name=v_oid value="{%s}">
			<input type=hidden name=v_amount value="{%s}">
			<input type=hidden name=v_moneytype value="{%s}">
			<input type=hidden name=v_url value="{%s}">
			<input type=hidden name=v_md5info value="{%s}">
			<input type="submit" value="支付" />
			</form>';
		return sprintf($str, $this->v_mid, $this->v_oid, $this->v_amount, $this->v_moneytype, $this->v_url, $this->v_md5info);
	}

	//生成数字签字
	public function crypt() {
		$str = $this->v_amount . $this->v_moneytype . $this->v_oid . $this->v_mid . $this->v_url . $this->paykey;
		$this->v_md5info = stroupper(md5($str));
	}
}