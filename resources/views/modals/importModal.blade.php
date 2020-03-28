<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modHeader"
            style="background-color:#4286f4;color:#fff;font-size:16pt;
            font-weight:bold;text-align:center;">
         		<div style="float:left;position:relative;left:50%;">

                  <!-- This Div populated by import.js script-->
						<div style="float:left;position:relative;left:-50%;">
                     <div class="importCount" style="text-align:center;">
                        One Moment...
                     </div>
						</div>

						<div style="float:right;">
							<div>
								<button type="button" class="close" data-dismiss="modal">
								&times;
								</button>
							</div>
						</div>

                  <div style="clear:both;">
                  </div>

            	</div>
				</div>
            <div class="earlyLoad" style="display:none;text-align:center;">
               <!-- room for other divs if needed -->
               <div style="padding:50px;">
                  <img
                  id="loadPhotoURL"
                  src="/img/largeLoader.gif"
                  style="width:25%;">
               </div>
               <div style="padding-bottom:25px;">
                  Gathing info for import
               </div>
               <!-- Early Load Messages -->
            </div>
				<div class="modLoader" style="display:none;text-align:center;">

               <!-- loaded from import.js -->
					<div class="staticLoader"
                  style="text-align:center;
                  margin-top:25px;">
						<img class="loadPhotoURL" src="" style="width:50%;">
					</div>

               <div class="dynaLoader"
                  style="display:none;
                  border:1px solid #ebebeb;
                  width:50%;position:relative;left:25%;
                  margin-top:25px;border-radius:15px;">

            		<div id="progPercent"
                     class="progress-bar progress-bar-striped active progress-bar-success"
                     role="progressbar"
                     aria-valuenow="10" aria-valuemin="0"
                     aria-valuemax="100"
                     style="width:130px;
                     border-radius:15px;
                     padding:7px;">
            		</div>

                  <div class="clearfix">
                  </div>

               </div>

   				<div class="modLoadMsg">
   				</div>

   				<div class="modLoadMLS" style="text-align:center;
               padding-top:15px;padding-bottom:15px;font-size:12pt;
               color:#4286f4;font-weight:bold">
   				</div>

   				<div class="modLoadAddress" style="text-align:center;
               padding-bottom:25px;padding-top:0;font-size:12pt;
               color:#4286f4;font-weight:bold">
   				</div>

			   </div>
        </div>
    </div>
</div>
