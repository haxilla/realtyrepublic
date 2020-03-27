<?php
Use App\models\oldsite\oldAgent;
Use App\models\core\propagent;
Use App\models\synch\propagentBackup;
//drop table if exists
if(!Schema::hasTable('propagent')){
  $results=DB::select( DB::raw("
    create table propagent
    like propagentSynch
  "));
};

Schema::dropIfExists('propagentBackup');
//create propagentSynch Table
$results=DB::select( DB::raw("
  create table propagentBackup
  like propagents
"));
//insert
$results = DB::select( DB::raw("
    INSERT INTO propagentBackup
    SELECT *
    FROM propagents
"));
//drop propagent if backup successful
if(propagentBackup::count()===propagent::count()){
  //drop command
  Schema::dropIfExists('propagents');
  //create table command
  $results=DB::select( DB::raw("
    create table propagents
    like propagentSynch
  "));
}else{
  dd('line42-insertPropAgents.php');}

//output json & exit
$idArray = array(
  'status'  => 'success',
);
echo json_encode($idArray);
exit();
