<?php
set_time_limit(0);
class SaveData extends CI_Controller 
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
	private function connectDB(){
		$mySQL = new MySQL();
		$mySQL->setConfig('youwei','root','');
		return $mySQL;
	}
	public function getCount($tableName){
		$mySQL = $this->connectDB();	
		$cont = $mySQL->ExecuteSQL('select COUNT(*) as totalcount from `'.$tableName.'`');
		return $cont["totalcount"];
	}	
	public function index()
	{
		$mySQL = $this->connectDB();	
		$fileLen = range(1,15);
		foreach ($fileLen as $key => $fileIndex) {
			sleep(5);
			var_dump($this->getCount("list"));
			$id = $this->getCount("list") + 1;
			$sid = $this->getCount("sub") + 1;
			$did = $this->getCount("detail") + 1;
			$postStr = file_get_contents('static/js/zhihu_q_a'.$fileIndex.'.js');
			$res = json_decode($postStr,true);
			foreach ($res as $key => $item) {
				$it = array();
				$it["id"] = $id;
				$it["content"] = $item["title"];
				$it["hot"] = 0;
				$mySQL->Insert($it,"list");
				$content = $item["item-content"];
				foreach ($content as $key => $cont) {
					$contstr = trim(strip_tags($cont));
					$contstrip = $this->strip($cont);
					if($contstrip !== $cont){
						continue;
					}
					if(strlen($contstr)<=0){
						continue;
					}
					if(strlen($contstr)>50){
						$sun =  mb_substr($contstr,0,50).".....";
					}
					else{
						$sun = $contstr;
					}
					$sun = $this->strip($sun);
					$sub = array();
					$detail = array();
					$sub["id"] = $sid;
					$sub["content"] = $sun;
					$sub["lid"] = $id;
					$mySQL->Insert($sub,"sub");
					$detail["id"] = $did;
					$detail["content"] = $this->strip($cont);
					$detail["sid"] = $sid;
					$mySQL->Insert($detail,"detail");
					$sid++;
					$did++;
				}
				$id++;
			}
			ob_flush();
			flush();
		}
	}
}
?>