<?php

// GREAT WORKING CODE BUT MIGHT
// REWORK STRUCTURE IT CANT GO IN
// A LOOP

//set up array for sorting
$errorLog=$remailEventLog['error'];
ksort($errorLog);
$fullMerge=array_unique($errorLog, SORT_REGULAR);
//merges duplicate emails and xxAgtUnames
foreach($fullMerge as $key1=>$value1){
   foreach($errorLog as $key2=>$value2){
      if($value1['agtEmail'] && $value2['agtEmail']){
         if($value1['agtEmail'] == $value2['agtEmail'] ||
            $value1['agtEmail'] == $value2['xxAgtUname']){
            $fullMerge[$key1]["agtEmailMerge"][$key2] = $value1['agtEmail'];
         }
      }
      if($value1['xxAgtUname'] && $value2['xxAgtUname']){
         if($value1['xxAgtUname'] == $value2['xxAgtUname'] ||
            $value1['agtEmail'] == $value2['xxAgtUname']){
            $fullMerge[$key1]["xxAgtUnameMerge"][] = $key2;
         }
      }
   }
}
//set non dup email/xxAgtUname
$agtEmail=$fullMerge[$mainAccountID]['agtEmail'];
$xxAgtUname=$fullMerge[$mainAccountID]['xxAgtUname'];

/* to merge with main remailEventLog
/* used to be on main page

//mergeLog
$remailEventLog['allAccounts'][$mainAccountID]['errorMerge']=$fullMerge[$mainAccountID];
*/

/* original unaltered code
$resArr=$remailEventLog['error'];
ksort($resArr);
$tempArr = array_unique($resArr, SORT_REGULAR);
foreach ($tempArr as $key => $value) {
    foreach ($resArr as $key1 => $value2) {
        if($value['agtEmail'] == $value2['agtEmail'] ||
         $value['xxAgtUname'] == $value2['xxAgtUname']) {
            $tempArr[$key]["mergedWith"][] = $key1;
        }
    }
}
print_r($tempArr);
exit();
*/
