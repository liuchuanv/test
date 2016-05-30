<?php
define("TOKEN", "weixin");

$wx = new Weixin();
$wx->valid();    
$wx->response();  

class Weixin{

	public function valid(){
		$echoStr = $_GET["echostr"];
		if(!empty($echoStr) && $this->checkSignature()){
			echo $echoStr;
			exit();
		}
	}
	//验证服务器地址有效性
	private function checkSignature(){
		$nonce = $_GET["nonce"];
		$timestamp = $_GET["timestamp"];
		$token = TOKEN;
		$signature = $_GET["signature"];
		
		$arr = array($nonce, $timestamp, $token);
		sort($arr, SORT_STRING);
		$str = implode($arr);
		$enStr = sha1($str);
		
		if($enStr == $signature){
			return true;
		}else{
			return false;
		}
	}
	//响应
	public function response(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$obj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		switch($obj->MsgType){
			case "text" : 
				$content = strtoupper($obj->Content);
				if($content == "OPENID" ){
					$this->replyText($obj, $obj->FromUserName);
				}
			break;
		}
		
		
	}
	
	//回复文本
	public function replyText($object, $content, $flag=0){
		$xmlText="<xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%s</CreateTime>
                  <MsgType><![CDATA[text]]></MsgType>
                  <Content><![CDATA[%s]]></Content>
                  <FuncFlag>%d</FuncFlag>
                  </xml>";
		$resultStr = sprintf($xmlText,$object->FromUserName,$object->ToUserName,time(),$content,$flag);
		echo $resultStr;exit();
	}
}


?>