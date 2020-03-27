<?php
//get file
$file=app_path()."/adre/notes/$getTheRemailAgentID"
// Read JSON file
$json = file_get_contents($file);
//Decode JSON
$json_data = json_decode($json,true);
//loop and display
//dd($json_data);
echo "EMAIL NOTES".'<br>';
foreach($json_data[$mainAccountID]['emailNotes'] as $t){
   echo $t.'<BR>';}

echo "<BR>Account IDs Moved<BR>";
foreach($json_data[$mainAccountID]['accountIdsMoved'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>Flyers Moved<BR>";
foreach($json_data[$mainAccountID]['flyerMoveNotes'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>Photo Notes<BR>";
foreach($json_data[$mainAccountID]['agentPhotoNotes'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>Logo Notes<BR>";
foreach($json_data[$mainAccountID]['agentLogoNotes'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>Images OK<BR>";
foreach($json_data[$mainAccountID]['imagesOK'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>xxAgtUname Change<BR>";
foreach($json_data[$mainAccountID]['xxAgtUnameChange'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>StartDate Change<BR>";
foreach($json_data[$mainAccountID]['changeStartDate'] as $k=>$v){
   echo "$k - $v<BR>";}

echo "<BR>agtUname Change<BR>";
foreach($json_data[$mainAccountID]['agtUnameError'] as $k=>$v){
   echo "$k - $v<BR>";}
