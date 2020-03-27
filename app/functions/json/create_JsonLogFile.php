<?php

// * THIS VERSION IS NOT BEING USED
// * SINCE IT REFERENCES SPECIFIC
// * VARIABLES ITS COPIED
// * INTO THE PROJECT FOLDER

//function
include(app_path().'/functions/keyGens/shortUID.php');
//use above to generate
$uniq=gen_uid();
//make directory
if(!is_dir(app_path()."/adre/notes/$remailAgentID")){
   mkdir(app_path()."/adre/notes/$remailAgentID", 0777, true);}
$results=var_export($remailEventLog,TRUE);
$file1=app_path()."/adre/notes/$remailAgentID/jsonMergeLog-$remailAgentID.txt";
$file2=app_path()."/adre/notes/$remailAgentID/jsonMergeLog-$remailAgentID-$uniq.txt";

// file1 has no uniqueID and will be overwritten by newest
// file2 has uniqueID and will serve as an archive

//writes file1
$fp = fopen($file1, 'w');
fwrite($fp, json_encode($remailEventLog));
fclose($fp);
//writes file2
$fp = fopen($file2, 'w');
fwrite($fp, json_encode($remailEventLog));
fclose($fp);
