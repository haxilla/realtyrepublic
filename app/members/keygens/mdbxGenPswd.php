<?php
// seed with microseconds
function make_seed(){
  $randomness=rand(1,10000);
  list($usec, $sec) = explode(' ', microtime());
  return $sec + $usec * 1000000 + $randomness;
}

function generatePassword($length){

  $possible = "123456789abcdfghjkmnpqrstxyzABCDEFGHIJKLMNPQRSTXYZ_"; // allowed chars in the password

  if ($length == "" OR !is_numeric($length)){
    $length = 8;
  }

  srand(make_seed());

  $i = 0;
  $password = "";
  while ($i < $length) {
    $char = substr($possible, rand(0, strlen($possible)-1), 1);
    if (!strstr($password, $char)) {
      $password .= $char;
      $i++;
    }
  }
  return $password;
}

$digits=rand(10,20);
$genPswd=generatePassword($digits);
$sk1=$genPswd;
