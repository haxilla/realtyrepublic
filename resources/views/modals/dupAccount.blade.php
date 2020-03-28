<div class="modal fade" id="dupAccountModal" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" style="border-radius:10px;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modHeader"
            style="background-color:#090;color:#fff;font-size:18pt;
            font-weight:bold;text-align:center;padding:25px;">
	            <div style="float:left;">
		            YOU ALREADY HAVE AN ACCOUNT !
	            </div>
	            <div style="float:right;">
		            <button
		            type="button"
		            class="close"
		            data-dismiss="modal">
		            	&times;
		            </button>
	            </div>
	            <div style="clear:both;">
	            </div>
            </div>
            <div style="text-align:center;padding-top:15px;">
           	Log into your existing account to begin!
            </div>
            <div class="modal-body">
            	<div class="modMessage" style="display:block">
	            	<div class="modAlert" style="font-size:12pt;font-weight:bold;color:#333;">
	            	</div>
	            	<form id="noMatchForm" style="margin:0;">
	            	<div style="border-radius:5px;margin-top:10px;margin-bottom:10px;padding-right:15px;">
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	Username:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input
				            	type="text"
				            	class="form-control"
				            	name="username"
				            	style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
		            	<div>
		            		<div style="float:left;width:30%;text-align:right;padding:10px;">
				            	Password:
			            	</div>
			            	<div style="float:left;width:70%;">
				            	<input
				            	type="text"
				            	class="form-control"
				            	name="password"
				            	style="color:#333;width:100%;padding:5px;margin-bottom:10px;">
			            	</div>
			            	<div style="clear:both;">
			            	</div>
		            	</div>
	  					</div>
            	</form>
            </div>
            <div class="modButtons" style="text-align:right;">
					<div style="float:left;padding:10px;">
						<a style="font-size:9pt;color:#999;text-decoration:none;padding-top:5px;" href="#">
							Forgot Password?
						</a>
					</div>
					<a href="/trialDelete/
						{{ $_GET['trialStatus'] }}/
						{{ $_GET['trialKey'] }}">
							Delete Account
					</a>
					<div style="float:right;"">
						<button
						style="border-radius:5px;margin:10px;margin-top:0;
							border:1px solid #090;background-color:#090;
							padding:10px;padding-left:25px;padding-right:25px;
							color:#fff;font-family:arial;font-size:12pt;
							font-weigth:bold;"
						class="modSubmit">
		                	Submit
	                </button>
					</div>
					<div style="clear:both;">
					</div>
				</div>
        </div>
    </div>
</div>
