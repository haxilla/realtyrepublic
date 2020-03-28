<div class="modal fade" id="addVerifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modHeader" style="background-color:#4286f4;color:#fff;font-size:18pt;
            font-weight:bold;text-align:center;">
            </div>
            <div class="modal-body">
            	<div class="modMessage" style="display:block">
	            	<div class="modAlert" style="font-size:12pt;font-weight:bold;color:#333;">
	            	</div>
	            	<form id="verAddFailForm" style="margin:0;">
	            	<div style="border:1px solid #ebebeb;margin:15px;padding:15px;">
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	Street Address:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modAddress" name="xAddress" style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	Unit# (if any)
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modUnitNum" name="xUnitNum" style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	City:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modCity" name="xCity" style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	State:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modState" name="xState" style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	Zip Code:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modZip" name="xZip" style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	County:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modCounty" name="xCountyName" style="color:#333;width:100%;padding:5px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div style="margin-top:15px;padding:15px;background-color:#ffffe6;color:#333;">
		            		<div style="padding:10px;text-align:right;">
		            			If your property is in the MLS, enter the MLS# to auto-import!
		            		</div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	MLS#:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input type="text" class="modMLSnum" name="xMlsNum" style="color:#333;width:100%;padding:5px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<input type="hidden" class="modSysID" name="sysID">
		            		<input type="hidden" class="modStatus" name="verStatus">
		            	</div>
	            	</div>
            	</div>
            	</form>
            	<div class="modLoader" style="display:none;text-align:center;margin:0 auto;">
            		<div style="padding:15px;text-align:center;">
	            		<img style="width:15%;" src="/img/largeLoader.gif">
            		</div>
            		<div class="modLoadMsg" style="padding:15px;text-align:center;">
            		</div>
            	</div>
            </div>
            <div class="modal-footer">
            	<div class="modButtons">
	                <button type="button" style="float:left;border-radius:5px;margin:0;border:1px solid #999;
	                background-color:#fff;padding:10px;color:#999;font-family:arial;font-size:11pt;
	                margin:15px" class="modCancel">
		                Cancel
	                </button>
					<button type="button" style="float:right;border-radius:5px;margin:0;border:1px solid #4286f4;
	                background-color:#fff;padding:10px;padding-left:25px;padding-right:25px;color:#4286f4;font-family:arial;font-size:12pt;
	                margin:15px;font-weigth:bold;" class="modSubmit" class="modSubmit">
	                	Submit
	                </button>
	                <div id="DPB" style="display:none"></div>
					<div id="xMlsNumVar" style="display:none"></div>
				</div>
            </div>
        </div>
    </div>
</div>
