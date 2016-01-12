<?php
	
	require_once('shopify.php');

	if($_GET && isset($_GET["query"])){
	
	$query=	$_GET["query"];
	$str = explode("$#$",base64_decode($query));
    
	}
	else{
		echo json_encode("{'error':'Invalid Request'}");
		exit;
	}
	
	
     
	
	 
	 $framework = $str[0];
	 if($framework == "shopify"){

	    
		$request=getallheaders();
		if(!isset($request["X-Shopify-Hmac-Sha256"]))
		{
			echo json_encode("{'error':'Untrusted source'}");
			exit;
		}
		
		$event = $str[1];
		$key = $str[2];
		$secret = $str[3];
		$from = $str[4];
		$threshold = $str[5];
		$storename = $str[6];
		$ownerno = $str[7];	
		$data = json_decode(file_get_contents('php://input'), true);
		$shop=new Shopify(); 
		 echo $shop->handler($event,$key,$secret,$from,$data,$threshold,$storename,$ownerno);
	 }
	else{

	   echo json_encode("{'error':'No Framework found'}");
	}
	

	
?>