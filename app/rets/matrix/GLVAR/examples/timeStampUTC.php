<?php
//converting to UTC for datefield searches
$theTimeStamp=\Carbon\Carbon::now('UTC')->format("c");
//example search for last 7 days only
$theDate=\Carbon\Carbon::now('UTC')->subdays('7')->format("c");