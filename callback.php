<?php
	
	require_once('shopify.php');

	if($_GET && isset($_GET["query"])){
	
	$query=	$_GET["query"];
	$variablesArr = explode("$#$",base64_decode($query));
    
	}
	else{
		echo json_encode("{'error':'Invalid Request'}");
		exit;
	}
	
	
     
	
	 
	 $framework = $variablesArr[0];
	 if($framework == "shopify"){

	    
		$request=getallheaders();
		
		//this header will check requests from shopify
		if(!isset($request["X-Shopify-Hmac-Sha256"]))
		{
			echo json_encode("{'error':'Untrusted source'}");
			exit;
		}
		
		$event = $variablesArr[1];
		$key = $variablesArr[2];
		$secret = $variablesArr[3];
		$from = $variablesArr[4];
		$threshold = $variablesArr[5];
		$storename = $variablesArr[6];
		$ownerno = $variablesArr[7];	
		$data = json_decode(file_get_contents('php://input'), true);
		$shop=new Shopify(); 
		 echo $shop->handler($event,$key,$secret,$from,$data,$threshold,$storename,$ownerno);
	 }
	else{

	   echo json_encode("{'error':'No Framework found'}");
	}
	

	
?>