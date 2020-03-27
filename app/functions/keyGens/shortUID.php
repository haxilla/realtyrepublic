<?php
// include this file and use $var=gen_uid()
// to invoke and retrieve a value
function gen_uid($l=10){
   $str = ""; for ($x=0;$x<$l;$x++)
   $str .= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 1);
   return $str;}

$shortUID=gen_uid();
$newRemailAgentID=$shortUID;

