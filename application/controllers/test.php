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
	private function strip($str){
		$farr = array( 
		"/\s+/", //过滤多余空白 
		//过滤 <script>等可能引入恶意内容或恶意改变显示布局的代码,如果不需要插入flash等,还可以加入<object>的过滤 
		"/(<|\&lt\;)(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)(>|\&gt\;)/isU", 
		"/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",//过滤javascript的on事件 
		); 
		$tarr = array( 
		" ", 
		" ",//如果要直接清除不安全的标签，这里可以留空 
		" ", 
		); 
		$str = preg_replace( $farr,$tarr,$str); 
		return $str; 
	}
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
		//$this->smarty->assign("apppath",$apppath);
		//$this->smarty->display("test.tpl");
		
		$str = '<div class="zm-editable-content clearfix">&lt;script&gt;alert("test")&lt;/script&gt;</div>';
		//echo $str;
		echo $this->strip($str);
	}
	public function test(){
		$arr = range(1,15);
		foreach ($arr as $key => $value) {
			echo $value;
		}
	}
}