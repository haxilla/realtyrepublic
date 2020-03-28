<div class="modal fade" id="addMlsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modHeader" style="background-color:#4286f4;color:#fff;font-size:16pt;
            font-weight:bold;text-align:center;">
            	<div style="float:left;">
	            	<div>
					If your property is in the MLS
					</div>
					<div>
					Enter the MLS# to auto-import!
					</div>
				</div>
				<div style="float:right;">
					<div>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div style="clear:both;">
				</div>
            </div>
            <div class="modHeaderLoad" style="display:none;text-align:center;background-color:#4286f4;
            color:#fff;font-size:14pt;font-weight:bold;padding:15px;margin-bottom:15px;">
            </div>
        	<form id="mlsImport" class="formEntry" style="margin:0;"
        	action="/startImport" method="POST">
        		{{csrf_field()}}
	            <div class="modal-body">
	            	<div class="modMessage" style="display:block">
		            	<div class="modAlert" style="font-size:12pt;font-weight:bold;color:#333;">
		            	</div>
		            	<div>
			            	<div style="padding:15px;background-color:#ffffe6;color:#333;">
			            		<div style="padding:10px;text-align:right;">
			            		</div>
			            		<div style="float:left;width:30%;text-align:right;padding:10px;">
					            	MLS#:
				            	</div>
				            	<div style="float:left;width:70%;">
					            	<input type="text" placeholder="Enter MLS# or Create Manually" class="modMLSimport" id="modMLSimport" name="xMlsNum" style="color:#333;width:100%;padding:5px;">
				            	</div>
				            	<div style="clear:both;">
				            	</div>
			            	</div>
			            	<div>
			            		<input type="hidden" class="modSysID" name="sysID">
			            		<input type="hidden" class="modSk1" name="sk1">
			            		<input type="hidden" class="modStatus" name="verStatus">
			            	</div>
		            	</div>
	            	</div>
	            </div>
	            <div class="modal-footer">
	            	<div class="modButtons">
		                <button type="button" style="float:left;border-radius:5px;margin:0;border:1px solid #999;
		                background-color:#fff;padding:10px;color:#999;font-family:arial;font-size:11pt;
		                margin:15px" class="modCancel">
			                Make Flyer Manually
		                </button>
						<button type="button" style="float:right;border-radius:5px;margin:0;border:1px solid #4286f4;
		                background-color:#fff;padding:10px;padding-left:25px;padding-right:25px;color:#4286f4;font-family:arial;font-size:12pt;
		                margin:15px;font-weight:bold;" class="modMLSimportSubmit">
		                	Submit
		                </button>
					</div>
	            </div>
            </form>
			<div class="modLoader" style="display:none;text-align:center;">
				<div class="staticLoader" style="margin-top:25px;text-align:center;">
					<img style="width:15%;" src="/img/largeLoader.gif">
				</div>
				<div class="dynaLoader" style="display:none;border-radius:15px;height:35px;margin:15px;margin-top:25px;">
					<div id="progPercent" class="progress-bar progress-bar-striped active progress-bar-success"
					role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"
					style="width:130px;border-radius:15px;padding:7px;">
					</div>
				</div>
				<div class="modLoadMsg">
				</div>
				<div class="modLoadMLS" style="text-align:center;padding-top:25px;padding-bottom:15px;font-size:12pt;color:#4286f4;font-weight:bold">
				</div>
				<div class="modLoadAddress" style="text-align:center;padding:25px;padding-top:0;font-size:12pt;color:#4286f4;font-weight:bold">
				</div>
			</div>
        </div>
    </div>
</div>
