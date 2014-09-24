<?php

include('SimpleToken.php');

//Generate a key
//$key = SimpleToken::generateKey();
$key = '5f7ddb1bd6d98df8320146e319879fe6';

//Set content
$content = "<xml>some stuff</xml>";

//Generate a token for this content and key pair
$token = SimpleToken::generateToken($key, $content);

echo $key . "<br>";

echo $token . "<br>";

//Verify the authenticity of the token on the end system
if(SimpleToken::isAuthentic($key, $content, $token))
{
	echo 'Valid';
}
else
{
	echo 'Invalid';
}