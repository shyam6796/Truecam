<?php
class CCAvenue extends Functions
{
	/*
		*** CCAvenue Function Developed By Ravi * Patel :) <<<
	*/
	protected $sta = "";
	protected $sta_aa = "";
	protected $m = "";
	
	function __construct() {
		$this->sta = parent::rp_getValue("ccavenue_paymentgateway","status","id=1");
		$this->sta_aa = array(0=>"test_",1=>"live_");
		$this->m = $this->sta_aa[$this->sta];
	}
	public function rpgetCCAvenue_merchant_id(){
		return parent::rp_getValue("ccavenue_paymentgateway","merchant_id","id=1");
	}
	public function rpgetCCAvenue_working_key(){
		return parent::rp_getValue("ccavenue_paymentgateway",$this->m."working_key","id=1");
	}
	public function rpgetCCAvenue_access_code(){
		return parent::rp_getValue("ccavenue_paymentgateway",$this->m."access_code","id=1");
	}
	public function rpgetCCAvenue_payment_url(){
		return parent::rp_getValue("ccavenue_paymentgateway",$this->m."payment_url","id=1");
	}
	public function rpgetCCAvenue_str($str=""){
		return stripslashes(str_replace("'","",str_replace('"','',$str)));
	}
	/*
		*** CCAvenue Function Developed By Ravi * Patel :) <<<
	*/
}
?>