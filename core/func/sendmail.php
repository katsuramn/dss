<?php
function sendmail($to,$from,$returnpath,$subject,$body){

	$mailBody = mb_convert_encoding($body,"JIS","UTF-8");
	$mailHeaders = "From: ".$from."\r\n";

	mb_language("Ja") ;
	mb_internal_encoding("UTF-8") ;
	mb_send_mail($to,$subject,$mailBody,$mailHeaders, "-f ".$returnpath);
}
?>