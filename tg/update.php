<?php 

$Token = "918644493:AAG7qiNXsWKWGlCfs7Yj6yWSGu64PUKRuRE"; //your add Token
$sudo = "id sudo"; //your add id sudo
mkdir("tg");
$ok = json_decode(file_get_contents("https://api.telegram.org/bot" . $Token . "/getme"),true)['ok'];

$done = ["Token"=>$Token,"sudo"=>$sudo];

$error = ["Token"=>null,"sudo"=>null];

if($ok == true ){
   $put = file_put_contents("tg/info.json",json_encode($done));
	echo " done : Was lifted Data";
}else{
	$put = file_put_contents("info.json",json_encode($error));
	echo "error : The code is incorrect ";
}
