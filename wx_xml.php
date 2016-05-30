<?php
$xmlStr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<note>
	<to>Tom</to>
	<from>Jack</from>
	<message>Hello</message>
	<time>2016-05-24</time>
</note>
XML;

$xml = simplexml_load_string($xmlStr);
var_dump($xml);

define("TOKEN", "weixin");

$wx = new Weixin();
if(!empty($_GET['echostr'])){  
    $wx->valid();  
}else{    
    $wx->response();  
}  


?>