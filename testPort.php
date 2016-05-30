<?php

$h = "http://www.baiud.com:8080/weixin/ss.php";
$str = preg_replace('/\:(\w+)\//i', "/", $h);

echo $str;
?>