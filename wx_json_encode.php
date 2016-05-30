<?php
	$str = ' {
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }';
	$arr = json_decode($str, true);
	var_dump($arr);

	echo "<br/><br/>";
	
	$arr1 = cnConv($arr);
	$str1 = json_encode($arr1);
	echo urldecode($str1);
	
	function cnConv($obj){
		if(!$obj) return false;

		if(is_array($obj)){
			foreach($obj as $k=>$v){
				$obj[urlencode($k)] = cnConv($v);
			}
			return $obj;
		}else{
			return urlencode($obj);
		}
	}
?>