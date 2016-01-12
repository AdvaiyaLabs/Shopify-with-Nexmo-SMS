<?php


 class Shopify
 {
	
	public function __construct(){
        
		
        }
	
	public function writeLog($message)
	{
     // $myfile = file_put_contents('logs.txt', $message.PHP_EOL , FILE_APPEND);
	}
	public function handler($event,$key,$secret,$fromuser,$allData,$threshold,$storename,$ownerno)
	{
		
		
			$amount=$allData["total_price"];
			$url="";
			
		if($amount>=$threshold)
		{		
			if($event == "order_creation"){
				
				$onumber=$allData["order_number"];
				
				$currency=$allData["currency"];
			
				$customerInfo=$allData["customer"];
				$cname=$customerInfo["first_name"]."+".$customerInfo["last_name"];
			
			    $cname=str_replace(" ","+",$cname);
				//a new order of amount 00 is created;
				//
				$message="The+order+".$onumber."+is+created+of+amount+".$currency."+".$amount."+by+".$cname.".";
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$message;
				$this->writeLog("Order Create".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Create".$data);

				return $url;
				
			}
			
			if($event == "order_fulfillment"){
				
				$onumber=$allData["order_number"];
				
				$customerInfo=$allData["billing_address"];
				
				//assuming the vendor is shipper who ships and deliver the product
			
				$cname=$customerInfo["first_name"]."+".$customerInfo["last_name"];
				$cname=str_replace(" ","+",$cname);
				
				//
				//MessageforStoreOwner
				$storeownermessage="The+order+".$onumber."+is+fulfilled+for+".$cname".";
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$storeownermessage;
				$data = file_get_contents($url);
				$this->writeLog("Order FULFILL".$url);
				$this->writeLog("Order Full fill for Owner:".$data);
				//Message for Customer
				$customerphone=$customerInfo["phone"];
				$storename=str_replace(" ","+",$storename);
				$customermessage="The+order+".$onumber."+is+fulfilled+by+".$storename".";
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$customerphone."&text=".$customermessage;
				$this->writeLog("Order FULFILL CUS".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Full fill for customer:".$data);
				return $url;
				
			}
			if($event == "order_cancelled"){
				
				$onumber=$allData["order_number"];
				$cancelReason=$allData["cancel_reason"];
					$toOwnerMessage="";
					$toCustomerMessage="";
					$storename=str_replace(" ","+",$storename);
				if($cancelReason=="inventory"){
						$toOwnerMessage="The+order+".$onumber."+has+been+cancelled+because+of+inventory.";
					$toCustomerMessage="The+order+".$onumber."+has+been+cancelled+because+we+did+not+have+enough+stock+to+fulfill+your+order+at+".$storename;
				}
				else if($cancelReason=="fraud"){
					$toOwnerMessage="The+order+".$onumber."+has+been+cancelled.";
					$toCustomerMessage="The+order+".$onumber."+has+been+cancelled+at+".$storename".";
				}
				else{
					$toOwnerMessage="The+order+".$onumber."+has+been+cancelled.";
					$toCustomerMessage="The+order+".$onumber."+has+been+cancelled+at+".$storename".";
				}
				
				//because we did not have enough stock to fulfill your order
				//to store owner
				
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
				//to customer 
			
				$customerInfo=$allData["billing_address"];
				$customerphone=$customerInfo["phone"];
				$url1="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$customerphone."&text=".$toCustomerMessage;
				$data = file_get_contents($url1);
				$this->writeLog("Order CANCEL CUS".$url1);
				$this->writeLog("Order cancel for customer:".$data);
			
				return $url." and ".$url1;
				
			}
			if($event == "order_deleted"){
				
				$onumber=$allData["order_number"];
				
				$customerInfo=$allData["customer"];
				$cname=$customerInfo["first_name"]."+".$customerInfo["last_name"];
				$cname=str_replace(" ","+",$cname);
				//a new order of amount 00 is created;
				//
				$message="The+order+".$onumber."+has+been+deleted+".".";
				$url="https://rest.nexmo.com/sms/json?api_key=".$key."&api_secret=".$secret."&from=".$fromuser."&to=".$ownerno."&text=".$message;
				$this->writeLog("Order DEL".$url);
				$data = file_get_contents($url);
				$this->writeLog("Order Delete:".$data);
				return $url;
				
			}
			if($event == "order_paid"){
				
			    $isPaid=$allData["financial_status"];
				
				if($isPaid=="paid"){
				$onumber=$allData["order_number"];
				$currency=$allData["currency"];
				$message="The+payment+of+order+".$onumber."+of+amount+".$currency."+".$amount."+is+received.";
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