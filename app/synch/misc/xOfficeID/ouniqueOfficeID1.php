<?php
Use App\models\core\agtoffice;
Use App\models\core\propoffice;
$id=request('id');
//run query
$getOffice=agtoffice::select('officeID','xOfficeID',
   'tempOfficeID','armlsOfficeID','officeName','officeAddress1',
   'propagent_id','officeCity','officeState','officeZip')
->where('propagent_id','=',"$id")
->first();

//set vars xOfficeID returned
include('setXofficeID.php');

//check for xOfficeID
$existingOffice=propoffice::where('officeID','=',"$xOfficeID")
->first();

//insert new id if not there
if(!$existingOffice){
   propoffice::create([
      'officeID'        =>$xOfficeID,
      'officeName'      =>trim($getOffice['officeName']),
      'officeAddress1'  =>trim($getOffice['officeAddress1']),
      'officeCity'      =>trim($getOffice['officeCity']),
      'officeState'     =>trim($getOffice['officeState']),
      'officeZip'       =>trim($getOffice['officeZip']),
      'armlsOfficeID'   =>trim($getOffice['armlsOfficeID']),
      'xOfficeID'       =>$xOfficeID,
      'tempOfficeID'    =>trim($getOffice['officeID']),
      'propagent_id'    =>$id
   ]);
   agtoffice::where('propagent_id','=',"$id")
   ->update([
      'tempOfficeID'=>$xOfficeID,
   ]);
}

if($existingOffice){?>
   <div style="margin:10px;padding:10px;border:1px solid #666;
   background-color:#fff;">
   <?php
   echo "EXISTING OFFICE<BR>";
   echo "$xOfficeID<BR>";
   echo $existingOffice['officeName'].'<br>';
   echo $existingOffice['officeAddress1'].'<br>';
   echo $existingOffice['officeCity']
   .', '.$existingOffice['officeState']
   .' '.$existingOffice['officeZip']
   .'<br>';
   ?>
   </div>
   <?php
   agtoffice::where('propagent_id','=',"$id")
      ->update([
      'tempOfficeID'=>$xOfficeID,
   ]);
}

//run loop
/*
$getOffice3=agtoffice::where('officeAddress1','like',$officeAddress5.'%')
->orWhere('officeName','like',$officeName5.'%')
->whereNull('tempOfficeID')
->get();
*/
$getOffice3=agtoffice::whereNull('tempOfficeID')
->where(function($q) use($officeName5,$officeAddress5){
   $q->where('officeName','like',$officeName5.'%')
      ->orWhere('officeAddress1','like',$officeAddress5.'%');
})
->orderBy('officeAddress1')
->get();
?>
<div>
   <?php
   echo"<div>";
   echo $xOfficeID;
   echo"</div>";
   echo'<form id="officeSelectForm">';
   if(!$getOffice3->first()){
      //output
      echo "no records";
      exit();
   }
   foreach($getOffice3 as $the){?>
       <div class="officeSelectRecord
               officeSelectRecord<?php echo $the->propagent_id; ?>">
         <div style="display:inline-block;margin-right:10px;">
            <input type="checkbox"
            value="<?php echo $the->propagent_id; ?>"
            name="propagent_id"
            class="checkClass<?php echo $the->propagent_id ;?>"
            id="<?php echo $the->propagent_id; ?>"
            data-officeid="<?php echo $the->officeID; ?>">
            <label for="<?php echo $the->propagent_id; ?>">
               <div
                  id="<?php echo $the->propagent_id ;?>">
                  <?php echo $the->officeID
                  .' '
                  .$the->officeName
                  .' '
                  .$the->officeAddress1; ?>
               </div>
            </label>
         </div>
      </div>
      <?php } ?>
   </form>
</div>
<?php

exit();
