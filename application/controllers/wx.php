<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "yuyanfei");
class Wx extends CI_Controller
{
	public function index()
    {

        $echoStr = $this->input->get("echostr");
        if($echoStr&&!empty($echoStr)){
            //验证账号
            if($this->checkSignature()){
                echo $echoStr;
                exit;
            }
        }
        else{
            //响应消息
           $this->responseMsg(); 
        }
        
    }
    private function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = file_get_contents('php://input');

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
				if(!empty( $keyword ))
                {
            	   //$proxyUrl = "http://www.yuyanfei.com/proxy/?url=";					
                    $result  = file_get_contents("http://soyo.360.cn/pic/index?kw=".$keyword."&start=0&count=24&json=1");
                    $resultArray = json_decode($result,true);
                    $item = $resultArray[0];
                    //$url = $item["_thumb"];
                    $title = $keyword;
                    $des = $item["name"];
                    $imgUrl = $item["smallurl"];
					$detailUrl = "http://www.yuyanfei.com/detail?kw=".$keyword."&pic=".$item["bigurl"];
                    $imgTpl =   "<xml>
                                 <ToUserName><![CDATA[%s]]></ToUserName>
                                 <FromUserName><![CDATA[%s]]></FromUserName>
                                 <CreateTime>%s</CreateTime>
                                 <MsgType><![CDATA[news]]></MsgType>
                                 <ArticleCount>1</ArticleCount>
                                 <Articles>
                                 <item>
                                 <Title><![CDATA[%s]]></Title> 
                                 <Description><![CDATA[%s]]></Description>
                                 <PicUrl><![CDATA[%s]]></PicUrl>
                                 <Url><![CDATA[%s]]></Url>
                                 </item>
                                 </Articles>
                                 <FuncFlag>1</FuncFlag>
                                 </xml>"; 
                    $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $title,$des,$imgUrl,$imgUrl);   
                    echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
            echo "errro";        
        	exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        	
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>