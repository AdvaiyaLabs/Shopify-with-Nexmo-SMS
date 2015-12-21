<?php 
	
	  if($_GET && isset($_GET["req"])){
	  
	   $req=$_GET["req"];
	   $apiKeys=$_GET["apiKeys"];
	   $secret=$_GET["secret"];
	   $url="https://rest.nexmo.com/account/numbers/".$apiKeys+"/".$secret."";
	   $data = file_get_contents("https://rest.nexmo.com/account/numbers/".$apiKeys."/".$secret);
	   echo json_encode($data);
	   exit;
	  }
	
	?>
<html>
  <head>
	<title>Shopify with Nexmo SMS</title>
   
  
	<link rel="stylesheet" type="text/css" href="resources/Configuration.css">
	<script  src="resources/jquery-1.11.3.min.js">
	</script>
	
	<script src="resources/Configuration.js">
	
	</script>
	
	
  </head>
  <body>
	<div class="logoWrapper" align="center"><img src="resources/images/logo.png" alt="Nexmo" width="200"><p class="heading1">Configuration Settings</p></div>
	
		<div id="msgbox" class="fieldLabel">
			<div id="upm-base-url-invalid" class="aui-message error hidden">
			<span class="aui-icon icon-error"></span>
		   
		</div><span class="aui-icon icon-error"></span>
			<p id="error" name="error" align="center"></p>
	   </div> 
  <div id="defaults" class="pageWrapper">
	
 
	
 
	<div class="mainContent">
	
	<form id="admin" class="aui">
	 
	
	<div id="fromfields">
	
	 <div class="mb-20">
				<div class="fieldLabel">Nexmo Key <span class="handCursor"></span></div>
				<div>
					 <input id="key" name="key"  type="text" class="customTxtBox" />
				</div>
				<div class="errorLabel" id="errorkey">Please enter the Nexmo Key<span class="handCursor"></span></div>
	</div>
	
	
	<div class="mb-20">
				<div class="fieldLabel">Nexmo Secret <span class="handCursor"></div>
				<div>
					 <input id="secret" name="secret" type="text" class="customTxtBox" />
				</div>
				<div class="errorLabel" id="errorsecret">Please enter the Nexmo Secret<span class="handCursor"></span></div>
				
				<div id="validationdiv"></br>  <input class="blueBtn" id="validatekeys" type="button"  value="Validate"></div>
	</div>
	
	
	<div id="aftervalidation">
	
	<div class="mb-20">
				<div class="fieldLabel">From Number<span class="handCursor"></div>
				<div>
					<select class="customdropdown"  name="fromNumbers" id="fromNumbers">
					  </select></br>
					  
				</div>
					<div class="errorLabel" id="errorfrom">Please select valid From Number<span class="handCursor"></span></div>
	</div>
	
	 <div class="mb-20">
				<div class="fieldLabel">Threshold Value <span class="handCursor"></div>
				<div>
					 <input id="thresholdamount" name="thresholdamount" onKeyUp="return validatetamount()" type="number" min="0" class="customTxtBox" />
				</div>
				<div class="errorLabel" id="errorthreshold">Please enter the Threshold Value<span class="handCursor"></span></div>
				
	</div>
	
	<div class="mb-20">
				<div class="fieldLabel">Store Name <span class="handCursor"></div>
				<div>
					 <input id="storename" name="storename" type="text" class="customTxtBox" />
				</div>
				<div class="errorLabel" id="errorstore">Please enter the Store Name<span class="handCursor"></span></div>
				
	</div>
	<div class="mb-20">
				<div class="fieldLabel">Store Owner Mobile Number (with country code)<span class="handCursor"></div>
				<div>
					 <input id="storephone" name="storephone" type="tel" pattern="\d{3}[\-]\d{3}[\-]\d{4}" maxlength="12" class="customTxtBox" />
				</div>
				<div class="errorLabel" id="errormobile">Please enter the Store Owner Mobile Number<span class="handCursor"></span></div>
				
	</div>
			
			
		  
		  
			
			
			
		   <div>  <input class="blueBtn" id="genwebhook" type="button" value="Get Webhook"></div>
	</div>
			
			
			
	</div>
		<div id="webhooks">
			
			<div class="mb-20">
				<div class="fieldLabel">Order Creation  <span class="handCursor"></div>
				<div>
					 <input onClick="this.select();" readonly id="ordercreate" name="ordercreate" type="text" class="customTxtBox" />
				</div>
				
			</div>
			
			<div class="mb-20">
				<div class="fieldLabel">Order fulfillment <span class="handCursor"></div>
				<div>
					 <input onClick="this.select();" readonly id="orderfulfilled" name="orderfulfilled" type="text" class="customTxtBox" />
				</div>
				
			</div>
			
			
			<div class="mb-20">
				<div class="fieldLabel">Order Cancelled  <span class="handCursor"></div>
				<div>
					 <input onClick="this.select();" readonly id="ordercancelled" name="ordercancelled" type="text" class="customTxtBox" />
				</div>
				
			</div>
			
			<div class="mb-20">
				<div class="fieldLabel">Order Deletion  <span class="handCursor"></div>
				<div>
					 <input onClick="this.select();" readonly id="orderdeletion" name="orderdeletion" type="text" class="customTxtBox" />
				</div>
				
			</div>
			
			<div class="mb-20">
				<div class="fieldLabel">Order Payment<span class="handCursor"></div>
				<div>
					 <input onClick="this.select();" readonly id="orderpaid" name="orderpaid" type="text" class="customTxtBox" />
				</div>
				</br>
				<div>  <input class="blueBtn" id="goback" type="button" value="Back"></div>
			</div>
			
		</div>
			
			  <table class="tableStyle">
			 <tr>
			   
				<td class="auto-style1">
					
				</td>
			</tr>
			
			
			<tr id="messagecreate"> 
			 <td class="auto-style2">
				  
				</td>
				
				<td  class="auto-style2">   <input type="hidden" id="pagecreateeventmessage" name="pagecreateeventmessage">  </td>
			</tr>
		   
			
			 
			
			
			
			<tr id="messageupdate">
			
			<td class="auto-style2">
				   
				</td>
				
				<td  class="auto-style2">   <input type="hidden" id="pageupdateeventmessage" name="pageupdateeventmessage">  </td>
			</tr>
			
		
			 <tr>
				
				<td class="auto-style1">
					<input id="fromuser" name="fromuser" type="hidden" />
				</td>
			</tr>
		</table>
	
	
	 
	</form>
	</div>
</div>

<div id="progressSpinner" style="z-index:1000;position:absolute; top: 45%;left: 45%; background:rgba(255,255,255,1) none repeat scroll 0% 0%; padding: 20px;overflow:auto;border:1px solid; display: block; background-color: #0D6F91; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: small; font-weight: bold; color: #333399; display:none">
		
		<p id="progressText">
		<img src="resources/images/ajax-loader.gif">
		
		</p>
	</div>
  </body>
</html>
