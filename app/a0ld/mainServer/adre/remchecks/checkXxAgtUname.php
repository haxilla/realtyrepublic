<?php
//update username/startDate
//set
$oldXxAgtUname=$mainAccountQuery['xxAgtUname'];
$newXxAgtUname=$lastLoginAccountQuery['xxAgtUname'];
//log
$remailEventLog['remchecks']['xxAgtUnameChange']=[
   'xxAgtUnameChange'   => 1,
   'oldXxAgtUname'      => $oldXxAgtUname,
   'newXxAgtUname'      => $newXxAgtUname];
