<?php
class Question extends CI_Controller 
{	
	private function connectDB(){
		$this->load->library('MySQL');
		$this->mysql->setConfig('youwei','root','');
		return $this->mysql;
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
	//$fileNameArray = array("zhihu_movie.js","zhihu_movie.js","zhihu_football.js","zhihu_mall.js","zhihu_money.js","zhihu_person.js");
	//$postStr = file_get_contents('static/js/data/'.$fileNameArray[$type]);
	//$postStr = strip_tags($postStr);
	//$postStr = file_get_contents('http://localhost/yuyanfei/static/js/item.js');
	//随机读取list表里面一条数据
	$this->connectDB();
	$randomSQL = "SELECT * FROM `list` AS t1 JOIN (SELECT FLOOR(RAND() * (SELECT MAX(id) FROM `list`)) AS id) AS t2 WHERE t1.id >= t2.id ORDER BY t1.id ASC LIMIT 1";
	$arrayLen = 10;
	$res = array();
	$result = array();
	$nub = range(1,$arrayLen);
	foreach ($nub as $key => $value) {
		array_push($res, $this->mysql->ExecuteSQL($randomSQL)); 
	}
	foreach ($res as $item) {
		$id = $item["id"];
		$bestSQL = "SELECT  * FROM `sub` WHERE lid = ".$id ." LIMIT 1";
		$bestQustion = $this->mysql->ExecuteSQL($bestSQL);
		$item["best"] = $bestQustion;
		array_push($result, $item);
	}
	if($debug == "ttt"){
		header("Content-type:application/json");
		//echo(json_encode($res));
		echo(json_encode($result));
		exit;
	}
	//$this->smarty->assign("type",$type);
	$this->smarty->assign("list",$result);
	$this->smarty->display("question.tpl");
	}
	public function getSubList(){
		$lid = $this->input->get("lid");
		$this->connectDB();
		$listSQL = "SELECT  * FROM `sub` WHERE lid = ".$lid;
		$list = $this->mysql->ExecuteSQL($listSQL);
		header("Content-type:application/json");
		echo(json_encode($list));
		exit;
	} 
	public function getDetail(){
		$sid = $this->input->get("sid");
		$this->connectDB();
		$detailSQL = "SELECT  * FROM `detail` WHERE sid = ".$sid;
		$detail = $this->mysql->ExecuteSQL($detailSQL);
		header("Content-type:application/json");
		echo(json_encode($detail));
		exit;
	}
}