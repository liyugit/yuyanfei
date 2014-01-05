<?php
class GetData extends CI_Controller {
	
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
			$contstr = strip_tags($cont);
			$contstr = trim($contstr);
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
			$cnt["detail"] = $cont;
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