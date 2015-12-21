<?php


 class Shopify
 {
	
	public function __construct(){
        
		
   }
	
	public function writeLog($message)
	{
		
		//remove comment to enable log
     // $myfile = file_put_contents('logs.txt', $message.PHP_EOL , FILE_APPEND);
	}
	public function handler($event,$key,$secret,$fromuser,$allData,$threshold,$storename,$ownerno)
	{
		
		
			$amount=$allData["total_price"];
			$url="";
			
		if($amount>=$threshold)
		{		
	
			
			if($event == "order_creation"){
					//executes on order creation
				$onumber=$allData["order_number"];
				
				$currency=$allData["currency"];
			
				$customerInfo=$allData["customer"];
				$cname=$customerInfo["first_name"]." ".$customerInfo["last_name"];
				$message=urlencode("The order ".$onumber." is created of amount ".$currency." ".$amount." by ".$cname.".");
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$message;
				
				$this->writeLog("Order Create".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Create".$data);

				return $url;
				
			}
			
			if($event == "order_fulfillment"){
				
				//executes when order is fulfilled 
				$onumber=$allData["order_number"];
				
				$customerInfo=$allData["billing_address"];
				
				//assuming the vendor is shipper who ships and deliver the product
			
				$cname=$customerInfo["first_name"]." ".$customerInfo["last_name"];
			
				
				
				
				$storeownermessage=urlencode("The order ".$onumber." is fulfilled for ".$cname.".");
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$storeownermessage;
				$data = file_get_contents($url);
				$this->writeLog("Order FULFILL".$url);
				$this->writeLog("Order Full fill for Owner:".$data);
				//Message for Customer
				$customerphone=$customerInfo["phone"];
				
				$customermessage=urlencode("The order ".$onumber." is fulfilled by ".$storename.".");
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$customerphone."&text=".$customermessage;
				$this->writeLog("Order FULFILL CUS".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Full fill for customer:".$data);
				return $url;
				
			}
			if($event == "order_cancelled"){
				
				//executes when order is cancelled
				$onumber=$allData["order_number"];
				$cancelReason=$allData["cancel_reason"];
				$toOwnerMessage="";
				$toCustomerMessage="";
					
				if($cancelReason=="inventory"){
						$toOwnerMessage=urlencode("The order ".$onumber." has been cancelled because of inventory.");
					$toCustomerMessage=urlencode("The order ".$onumber." has been cancelled because we did not have enough stock to fulfill your order at ".$storename.".");
				}
				else if($cancelReason=="fraud"){
					$toOwnerMessage=urlencode("The order ".$onumber." has been cancelled.");
					$toCustomerMessage=urlencode("The order ".$onumber." has been cancelled at ".$storename.".");
				}
				else{
					$toOwnerMessage=urlencode("The order ".$onumber." has been cancelled.");
					$toCustomerMessage=urlencode("The order ".$onumber." has been cancelled at ".$storename.".");
				}
				
				
				
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$toOwnerMessage;
				$this->writeLog("Order Cancel".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Cancel for owner:".$data);
				$this->writeLog("Cancel Owner URL".$url);
				$this->writeLog("Cancel Owner URL".$toOwnerMessage);
				if($data=="")
				{
				$this->writeLog("Previous request was not succeed sent new request for order cancel owner");
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$toOwnerMessage;
				$data = file_get_contents($url);
				$this->writeLog("Order Cancel for owner:".$data);
				}
			
				$customerInfo=$allData["billing_address"];
				$customerphone=$customerInfo["phone"];
				$url1="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$customerphone."&text=".$toCustomerMessage;
				$data = file_get_contents($url1);
				$this->writeLog("Order CANCEL CUS".$url1);
				$this->writeLog("Order cancel for customer:".$data);
			
				return $url." and ".$url1;
				
			}
			if($event == "order_deleted"){
				
				//executes when order is deleted
				$onumber=$allData["order_number"];
				
				$customerInfo=$allData["customer"];
				$cname=$customerInfo["first_name"]." ".$customerInfo["last_name"];
				
			
				$message=urlencode("The order ".$onumber." has been deleted ".".");
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$message;
				$this->writeLog("Order DEL".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Delete:".$data);
				return $url;
				
			}
			if($event == "order_paid"){
				//executes when store owner receives payment
			    $isPaid=$allData["financial_status"];
				
				if($isPaid=="paid"){
				$onumber=$allData["order_number"];
				$currency=$allData["currency"];
				$message=urlencode("The payment of order ".$onumber." of amount ".$currency." ".$amount." is received.");
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$message;
				$this->writeLog("Order PAID".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Payment:".$data);
				}
				else{
					echo "financial status is not paid";
				}
				return $url;
				
			}
		
		}
		else{
			echo "Threshold value is not reached";
		}
	}

	
 }


?>