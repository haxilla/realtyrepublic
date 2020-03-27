<?php
use App\models\core\agtoffice;
use App\models\core\propoffice;

$officeID=request('officeID');
//error if none
if(!$officeID){
   dd('error-line5-showOfficeAgents.php');}

include(app_path().'/queries/officeRosterQuery.php');

foreach($officeRosterQuery->sortByDesc('updated_at') as $the){
   ?>
      <form id="officeEditRosterForm">
         <input type="hidden"
         name="origOfficeID"
         id="origOfficeIDField"
         value="<?php echo $the[0]['tempOfficeID'];?>">
         <div>
            <!-- tempOfficeID -->
            <a class="showDiv showTempOfficeIDDiv
            tempOfficeIDField<?php echo $the[0]['tempOfficeID'];?>"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <?php
               if($the[0]['tempOfficeID']){
                  echo $the[0]['tempOfficeID'];
               }else{
               ?>
                  <div style="font-size:9pt;color:#900">
                     <span class="badge" style="background-color:#900;">
                        !
                     </span> OfficeID
                  </div>
               <?php }; ?>
            </a>
            <div class="editDiv editTempOfficeIDDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <input type="text" name="tempOfficeID"
               class="editField editTempOfficeIDField"
               value="<?php echo $the[0]['tempOfficeID']; ?>"
               style="width:100px;"
               id="tempOfficeIDField<?php echo $the[0]['tempOfficeID'];?>">
            </div>
         </div>
         <div>
            <!--officeName-->
            <a class="showDiv showOfficeNameDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>"
            style="display:inline-block;">
            <?php
               if($the[0]['officeName']){?>
               <div>
                  <div style="display:inline-block">
                     <div style="font-size:16pt;
                     font-weight:bold;color:#090;padding:10px;"
                     class="officeNameField<?php echo $the[0]['tempOfficeID'];?>">
                        <?php echo $the[0]['officeName']; ?>
                     </div>
                  </div>
               </div>
               <?php
               }else{
               ?>
                  <div style="font-size:9pt;color:#900">
                     <span class="badge" style="background-color:#900;">
                        !
                     </span> Name
                  </div>
               <?php }; ?>
            </a>
            <div style="display:inline-block;" class="editDiv showDiv">
               <a href="/admin/officeMatch?officeID=<?php echo $the[0]['tempOfficeID'];?>">
                  <i style="font-size:28px"
                  class="fa fa-question-circle grey-text"></i>
               </a>
            </div>
            <div class="editDiv editOfficeNameDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <input type="text" name="officeName"
               class="editField editOfficeNameField"
               value="<?php echo $the[0]['officeName']; ?>"
               style="width:250px;"
               id="officeNameField<?php echo $the[0]['tempOfficeID'];?>">
            </div>
         </div>
         <div>
            <!--officeAddress1-->
            <a class="showDiv showOfficeAddress1Div"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <?php
               if($the[0]['officeAddress1']){
                  echo $the[0]['officeAddress1'];
               }else{
               ?>
                  <div style="font-size:9pt;color:#900">
                     <span class="badge" style="background-color:#900;">
                        !
                     </span> Address
                  </div>
               <?php }; ?>
            </a>
            <div class="editDiv editOfficeAddress1Div"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <input type="text" name="officeAddress1"
               class="editField editOfficeAddress1Field"
               value="<?php echo $the[0]['officeAddress1']; ?>"
               style="width:250px;">
            </div>
         </div>
         <div style="display:inline-block;">
            <!--officeCity-->
            <a class="showDiv showOfficeCityDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <?php echo $the[0]['officeCity']; ?>
            </a>
            <div class="editDiv editOfficeCityDiv p-2"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <input type="text" name="officeCity"
               class="editField editOfficeCityField"
               value="<?php echo $the[0]['officeCity']; ?>">
            </div>
         </div>
         <div style="display:inline-block;">
            <!--officeState-->
            <a class="showDiv showOfficeStateDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <?php
               if($the[0]['officeState']){
                  echo $the[0]['officeState'];
               }else{
               ?>
                  <div style="font-size:9pt;color:#900">
                     <span class="badge" style="background-color:#900;">
                        !
                     </span> State
                  </div>
               <?php }; ?>
            </a>
            <div class="editDiv editOfficeStateDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <input type="text" name="officeState"
               class="editField editOfficeStateField"
               value="<?php echo $the[0]['officeState']; ?>"
               style="width:45px;">
            </div>
         </div>
         <div style="display:inline-block;">
            <!--officeZip-->
            <a class="showDiv showOfficeZipDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <?php
               if($the[0]['officeZip']){
                  echo $the[0]['officeZip'];
               }else{
               ?>
                  <div style="font-size:9pt;color:#900">
                     <span class="badge" style="background-color:#900;">
                        !
                     </span> Zip
                  </div>
               <?php }; ?>
            </a>
            <div class="editDiv editOfficeZipDiv"
            id="<?php echo $the[0]['tempOfficeID'];?>">
               <input type="text" name="officeZip"
               class="editField editOfficeZipField"
               value="<?php echo $the[0]['officeZip']; ?>"
               style="width:55px;">
            </div>
         </div>
      </form>
      </div>
      <hr style="margin-bottom:0;">
      <div style="padding:10px;background-color:#f9f9f9;">
         <div style="display:inline-block;width:50px;">
            Check
         </div>
         <div style="display:inline-block;width:50px;">
            ID
         </div>
         <div style="display:inline-block;width:50px;">
            Type
         </div>
         <div style="display:inline-block;width:200px;">
            Name
         </div>
         <div style="display:inline-block;width:150px;">
            Start Date
         </div>
         <div style="display:inline-block;width:50px;">
            Credit
         </div>
         <div style="display:inline-block;width:75px;">
            OfficeID
         </div>
      </div>
      <hr style="margin-top:0;">
   <?php
   foreach($the as $t){
      foreach($t['theAgent'] as $key){
      ?>
         <div>
            <div style="display:inline-block;width:50px;">
               <i style="font-size:18px"
               class="fa fa-question-circle grey-text">
               </i>
            </div>
            <div style="display:inline-block;width:50px">
               <?php echo $key['propagent_id']; ?>
            </div>
            <div style="display:inline-block;width:50px;">
               <?php echo $key['accountType']; ?>
            </div>
            <div style="display:inline-block;width:200px;">
               <?php echo $key['agtFullName']; ?>
            </div>
            <div style="display:inline-block;width:150px;">
               <?php
               if($key['startDate']){
                  echo $key['startDate']->toDateString();}
               ?>
            </div>
            <div style="display:inline-block;width:50px;">
               <?php echo $key['remCreds']; ?>
            </div>
            <div style="display:inline-block;width:75px;">
               <?php echo $key['officeID']; ?>
            </div>
         </div>
         <hr style="margin:5px;">
      <?php
      }
   }
}
