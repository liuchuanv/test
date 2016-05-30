<?php
//测试
$cache = new Cache();
$cache->dir = "../cc/";
//$cache->setCache("zhang", "zhangsan", 100);
echo $cache->getCache("zhang");
//$cache->removeCache("zhang");

$cache->setCache("liu", "liuqi", 100);
echo $cache->getCache("liu");

class Cache{
	public $cacheFile = "cache.json";	//文件
	public $dir = "./cach2/";			//目录

	//缓存
	public function setCache($name, $val, $expires_time){
		$file = $this->hasFile();
		//字符串转数组
		$str = file_get_contents($file);
		$arr = json_decode($str, true);
		
		//值为空，则移除该缓存
		if(empty($val)){
			unset($arr[$name]);
		}else{
			$arr[$name] = array("value"=>$val, "expires_time"=>$expires_time, "add_time"=>time());
		}	
		//数组转字符串
		$str = json_encode($arr);
		file_put_contents($file, $str);
    }
    public function getCache($name){
		$file = $this->hasFile();
		
		//字符串转数组
		$str = file_get_contents($file);
		$allArr = json_decode($str, true);
		$arr = $allArr[$name];

		if(!$arr || time() > ($arr["expires_time"] + $arr["add_time"])){
			$this->removeCache($name);	//过期移除
			return false;
		}
		return $arr["value"];
    }
	public function removeCache($name){
		$this->setCache($name, '', 0);
	}
	
	private function hasFile(){
		//如果不存在缓存文件，则创建一个
		if(!file_exists($this->dir)){
			mkdir($this->dir);
		}
		if(!file_exists($this->dir . $this->cacheFile)){
			touch($this->dir . $this->cacheFile);
		}
        return $this->dir . $this->cacheFile;
	}
}

?>