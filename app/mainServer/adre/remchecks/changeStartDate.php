<?php
//set values
$oldStartDate=$mainAccountQuery['startDate'];
$newStartDate=$earliestAccountQuery['startDate'];
//log
$remailEventLog['remchecks']['changeStartDate']=1;
$remailEventLog['remchecks']['oldStartDate']=$oldStartDate;
$remailEventLog['remchecks']['changeStartDate']=$newStartDate;
