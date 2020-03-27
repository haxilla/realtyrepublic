<?php
// include this file and use $var=gen_uid()
// to invoke and retrieve a value

$str = ""; for ($x=0;$x<10;$x++)
$str .= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 1);

$ezshortUID=$str;
$newRemID=$ezshortUID;

