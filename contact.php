<?php
$email = $_POST['email'];
$to = "info@akuraenclosures.com";
$subject = "Mail From AKURA";
$txt ="Email = " .$email;
$headers = "From: ";
if($email!=NULL){
	mail($to,$subject,$txt,$headers);
}
header("LOCATION: http://web.cu-eflyer.tk/akura/");
?>