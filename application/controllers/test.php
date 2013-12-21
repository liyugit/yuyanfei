<?php
class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$t = "".time();	
		$token = "liyu";
		$r = "".rand();
		$tmpArr = array($token, $t, $r);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr);
		//echo "tmp:".$tmpStr; 
		$tmpStr = sha1( $tmpStr );
		//echo "token:".$token;
		//echo "<br/>time:".$t."<br/>rand:".$r."<br/>result:".$tmpStr;
		$apppath =  APPPATH;
		$this->smarty->assign("apppath",$apppath);
		$this->smarty->display("test.tpl");
	}
}