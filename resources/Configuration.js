$(document).ready(function(){
		
		$("#aftervalidation").hide();
		$("#webhooks").hide();
		$("#errorkey").hide();
		$("#errorsecret").hide();
		$("#errorthreshold").hide();
		$("#errorstore").hide();
		$("#errormobile").hide();
		$("#errorhide").show();
		$("#errorfrom").hide();
    $("#validatekeys").click(function(){
		//alert($("#key").val());
        validateKeys();
    });
	
	
	$("#genwebhook").click(function(){
		//alert($("#key").val());
        genWebHook();
    });
	
	$("#goback").click(function(){
		//alert($("#key").val());
        $("#fromfields").show();
	$("#webhooks").hide();
	$("#msgbox").hide();
	
    });
	
});


function validatetamount()
{

	var val=$.trim($("#thresholdamount").val()) ;
		
	if(val<0)
	{
		
		$("#errorthreshold").show();
		$("#errorthreshold").text("Please enter a valid Threshold");
	}
	else{
			$("#errorthreshold").hide();
			$("#errorthreshold").text("Please enter the Threshold value");
	}
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function genWebHook()
{
	
	
	
	if($.trim($("#key").val()) == ""){
		
		$("#errorkey").show();
		$("#key").focus();
		return;
	}
	 $("#errorkey").hide();
	if($.trim($("#secret").val()) == ""){
		$("#errorsecret").show();
		//$("#error").text("Please enter the Nexmo Secret");
		$("#secret").focus();
		return;
	}
	 $("#errorsecret").hide();
	 	var defaultFromNumber = $('#fromNumbers').find(":selected").val();
		
	if(defaultFromNumber=="")
	{
		$("#errorfrom").show();
		$('#fromNumbers').focus();
		return;
	}
	$("#errorfrom").hide();
	if($.trim($("#thresholdamount").val()) == ""){
		$("#errorthreshold").show();
		//$("#error").text("Please enter the Threshold Amount");
		$("#thresholdamount").focus();
		return;
	}
	var val=$.trim($("#thresholdamount").val()) ;
		
	if(val<0)
	{
		$("#thresholdamount").focus();
		$("#errorthreshold").show();
		$("#errorthreshold").text("Please enter a valid Threshold");
		return;
	}
	else{
			$("#errorthreshold").hide();
			$("#errorthreshold").text("Please enter the Threshold value");
	}
	
	$("#errorthreshold").hide();
	if($.trim($("#storename").val()) == ""){
		$("#errorstore").show();
		//$("#error").text("Please enter the Store Name");
		$("#storename").focus();
		return;
	}
	$("#errorstore").hide();
	
	var mobile_no=$.trim($("#storephone").val());
	if(mobile_no == ""){
		$("#errormobile").show();
	//	$("#error").text("Please enter the Store Owner Mobile Number");
		$("#storephone").focus();
		return;
	}
	var mob=$.trim($("#storephone").val()) ;
		
	if(mob<0 || mob.length!=12 || isNumeric(mob)==false)
	{
		$("#storephone").focus();
		$("#errormobile").show();
		$("#errormobile").text("Please enter valid Mobile Number");
		return;
	}
	else{
			$("#errormobile").hide();
			$("#errormobile").text("Please enter the Store Owner Mobile Number");
	}
	
	$("#errormobile").hide();
	
	
	
	validateKeys();
	$("#msgbox").hide();
	$("#error").text("");
	var home=window.location;
	var api=$("#key").val();
	var secret=$("#secret").val();
	var threshold=$("#thresholdamount").val();
	var storename=$("#storename").val();
	var storephone=$("#storephone").val();

	
	//http://52.34.200.198/sunil_home/index.php?framework=shopify&event=order_creation&key=5b2a23d7&secret=59d9fa03&from=919460264151%threshold=100&storename&ownerno=919782177245
	
	var oc64="shopify$#$order_creation$#$"+api+"$#$"+secret+"$#$"+defaultFromNumber+"$#$"+threshold+"$#$"+storename+"$#$"+storephone;
	var ordercreate=home+"/callback.php?query="+btoa(oc64);
	$("#ordercreate").val(ordercreate);
	
	
	oc64="shopify$#$order_fulfillment$#$"+api+"$#$"+secret+"$#$"+defaultFromNumber+"$#$"+threshold+"$#$"+storename+"$#$"+storephone;
	var orderfulfilled=home+"/callback.php?query="+btoa(oc64);
	//var orderfulfilled=home+"/callback.php?framework=shopify&event=order_fulfillment&key="+api+"&secret="+secret+"&from="+defaultFromNumber+"&threshold="+threshold+"&storename="+storename+"&ownerno="+storephone;
	$("#orderfulfilled").val(orderfulfilled);
	
	oc64="shopify$#$order_cancelled$#$"+api+"$#$"+secret+"$#$"+defaultFromNumber+"$#$"+threshold+"$#$"+storename+"$#$"+storephone;
	var ordercancelled=home+"/callback.php?query="+btoa(oc64);
	//var ordercancelled=home+"/callback.php?framework=shopify&event=order_cancelled&key="+api+"&secret="+secret+"&from="+defaultFromNumber+"&threshold="+threshold+"&storename="+storename+"&ownerno="+storephone;
	$("#ordercancelled").val(ordercancelled);
	
	
	oc64="shopify$#$order_paid$#$"+api+"$#$"+secret+"$#$"+defaultFromNumber+"$#$"+threshold+"$#$"+storename+"$#$"+storephone;
	var orderpaid=home+"/callback.php?query="+btoa(oc64);
	//var orderpaid=home+"/callback.php?framework=shopify&event=order_paid&key="+api+"&secret="+secret+"&from="+defaultFromNumber+"&threshold="+threshold+"&storename="+storename+"&ownerno="+storephone;
	$("#orderpaid").val(orderpaid);
	
	oc64="shopify$#$order_deleted$#$"+api+"$#$"+secret+"$#$"+defaultFromNumber+"$#$"+threshold+"$#$"+storename+"$#$"+storephone;
	var orderdeletion=home+"/callback.php?query="+btoa(oc64);
	//var orderpaid=home+"/callback.php?framework=shopify&event=order_paid&key="+api+"&secret="+secret+"&from="+defaultFromNumber+"&threshold="+threshold+"&storename="+storename+"&ownerno="+storephone;
	$("#orderdeletion").val(orderdeletion);
	
	
	$("#fromfields").hide();
	$("#webhooks").show();
}

function getFromNo(response) {
	
	//{"count":2,"numbers":[{"country":"IN","msisdn":"919222010055","type":"mobile-lvn","features":["SMS"]},{"country":"IN","msisdn":"919222010111","type":"mobile-lvn","features":["SMS"]}]}
		  var obj = jQuery.parseJSON( response );
		  
		   $('#fromNumbers')
   		 .empty();
	for(i=0;i<obj.numbers.length;i++){
		
		
		   $('<option/>', {
   					 'text': obj.numbers[i].msisdn+"   "+obj.numbers[i].features,
   					 'value':obj.numbers[i].msisdn,
   					
					}).appendTo('#fromNumbers');
	}
	$("#aftervalidation").show();
	 $('#key').attr('readonly', 'true');
	  $('#secret').attr('readonly', 'true')
	 
	
	
}
function getPathFromUrl(url) {
  return url.split("?")[0];
}
function validateKeys()
  {
  
  
	
	if($.trim($("#key").val()) == ""){
		
		$("#errorkey").show();
		
		//$("#error").text("Please enter the Nexmo Key");
		$("#key").focus();
		return;
	}
	$("#errorkey").hide();
	var apiKeys=$.trim($("#key").val());
   
   
    if($.trim($("#secret").val()) == ""){
		$("#errorsecret").show();
		//$("#error").text("Please enter the Nexmo Secret");
		$("#secret").focus();
		return;
	}
	$("#errorsecret").hide();
	
     var secret=$("#secret").val();
    secret=$.trim(secret);
   
	urls=window.location+"/"+"index.php?req=validate&apiKeys="+apiKeys+"&secret="+secret;
    //urls= "https://rest.nexmo.com/account/numbers/"+apiKeys+"/"+secret+"";
   
     
    $("#progressSpinner").show();
    $.ajax({
      url: urls,
      type: "GET",
      dataType: "json",
     cache: false,
     crossDomain: true,
     processData: true,
     contentType: "application/json",
	  success:function(resp){
		  $("#progressSpinner").hide();
		  if(resp==false){
			
			 alert("Please enter valid Nexmo Key and Secret.");
			 $("#aftervalidation").hide();
			  $("#validationdiv").show();
		  }
		  else{
			    $("#validationdiv").hide();
			     getFromNo(resp); 
		  }
		     
	  		 
			 
	  		 
	  },
	   error: function (XMLHttpRequest, textStatus, errorThrown) {
		    $("#progressSpinner").hide();
			 $("#validationdiv").show();
		  $("#aftervalidation").hide();	
         alert("Please enter valid Nexmo Key and Secret.");
     }
    });
  
  
  }