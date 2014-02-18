<?php
class GetData extends CI_Controller 
{	 
	 private function strip($str){
		$farr = array( 
		//"/\s+/", //过滤多余空白 
		//过滤 <script>等可能引入恶意内容或恶意改变显示布局的代码,如果不需要插入flash等,还可以加入<object>的过滤 
		"/(<|\&lt\;)(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)(>|\&gt\;)/isU", 
		"/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",//过滤javascript的on事件 
		); 
		$tarr = array( 
		//" ", 
		" ",//如果要直接清除不安全的标签，这里可以留空 
		" ", 
		); 
		$str = preg_replace( $farr,$tarr,$str); 
		return $str; 
	}	
	public function index()
	{
	$debug = $this->input->get("debug");
	$type = $this->input->get("type");
	if($type){
		$type = intval($type);
	}
	else{
		$type = 1;
	}
	$fileNameArray = array("zhihu_movie.js","zhihu_movie.js","zhihu_football.js","zhihu_mall.js","zhihu_money.js","zhihu_person.js");
	$postStr = file_get_contents('static/js/data/'.$fileNameArray[$type]);
	//$postStr = strip_tags($postStr);
	//$postStr = file_get_contents('http://localhost/yuyanfei/static/js/item.js');
	$res = json_decode($postStr,true);
	$result = array();
	foreach ($res as $key => $item) {
		$it = array();
		$it["title"] = $item["title"];
		$content = $item["item-content"];
		$contArray = array();
		foreach ($content as $key => $cont) {
			$contstr = trim(strip_tags($cont));
			$contstrip = $this->strip($cont);
			if($contstrip !== $cont){
				continue;
			}
			if(strlen($contstr)<=0){
				continue;
			}
			$cnt = array();
			if(strlen($contstr)>50){
				//echo mb_substr($cont,0,50);
				$cnt["sun"] =  mb_substr($contstr,0,50).".....";
			}
			else{
				$cnt["sun"] = $contstr;
			}
			// if($key == 92){
			// 	//echo $this->strip($cont);
			// }
			$cnt["sun"] = $this->strip($cnt["sun"]);
			$cnt["detail"] = $this->strip($cont);
			array_push($contArray,$cnt);
		}
		$it["content"] =  json_encode($contArray);
		array_push($result,$it);
	}
	if($debug == "ttt"){
		header("Content-type:application/json");
		//echo(json_encode($res));
		echo(json_encode($result));
		exit;
	}
	$this->smarty->assign("type",$type);
	$this->smarty->assign("list",$result);
	$this->smarty->display("page.tpl");
	}
}