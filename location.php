<?php
	$url = "http://localhost/test/location.php?appid=wxcf0d3593ce1ea1c5&redirect_uri=http%3A%2F%2Fshop2.eshanggu.cn%2Fmobile%2Fweixin%2Fact.php%3Faid%3D1&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
	if(isset($_GET["appid"])){
		echo ("stop");
	}else{
		header("Location:$url");
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<script>
	
	</script>
</head>
<body>
	Hello World
</body>
</html>
