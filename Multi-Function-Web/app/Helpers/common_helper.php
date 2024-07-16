<?php
#Fixed Code Starts-------------------------------------c
function PrintR($StrArr){
	echo "<pre>";print_r($StrArr);echo "</pre>";
}


function _e($string){
    $key = "MAL_89763551234"; //key to encrypt and decrypts.
    $result = '';
    $test = array();
     for($i=0; $i<strlen($string); $i++) {
       $char = substr($string, $i, 1);
       $keychar = substr($key, ($i % strlen($key))-1, 1);
       $char = chr(ord($char)+ord($keychar));
   
       $test[$char]= ord($char)+ord($keychar);
       $result.=$char;
     } 
   
   
   return bin2hex(urlencode(base64_encode($result)));
  }


  function _d($string){
    $key = "MAL_89763551234";  
    $result =''; 
    $string =  base64_decode(urldecode(hex2bin($string))); 
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }
  return $result;
}

function FCrtRplc($StrVal){
	return str_replace("'","\"",trim($StrVal));
}