<div class="modal fade" id="startPurchaseModal" tabindex="-1" role="dialog"
 aria-labelledby="creditsLogin" style="border-radius:10px;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modHeader"
            style="background-color:#223e94;color:#fff;font-size:18pt;
            font-weight:bold;text-align:center;padding:25px;">
	            <div class="creditAmount" style="float:left;">
	            </div>
	            <button
	            type="button"
	            class="close"
	            data-dismiss="modal">
	            	&times;
	            </button>
            </div>
            <div class="modal-body">
               <div class="purchaseDesc" 
               style="padding:15px;padding-bottom:0;
               color:#223e94;font-style:italic;">
               </div>
               <div style="padding:15px;padding-bottom:0;">
                  Enter your email to begin the purchase and create an account
               </div>
               <div style="padding:15px;">
                  <form class="newPurchaseQty"
                  id="newPurchaseForm"
                  method="post"
                  action="/mdbx/mdbxNewPurchase">
                     {{csrf_field()}}
                     <div style="float:left;width:80%;padding-right:15px;">
                        <input name="newPurchaseEmail"
                        type="text" style="width:100%;padding:5px;
                        border:1px solid #eee;">
                     </div>
                     <div style="float:left;width:20%;">
                        <input type="submit"
                        style="padding-top:5px;padding-bottom:5px;
                        background:#223e94;color:#fff;border-radius:5px;
                        width:100%;border:none;">
                        <input id="theAmt" name="amt" type="hidden" value="">
                        <input id="purchaseDesc" name="purchaseDesc" type="hidden" value="">
                     </div>
                  </form>
                  <div style="clear:both;">
                  </div>
               </div>
               <div style="text-align:right;padding:15px;font-size:10pt;">
                  ** If you are already a member,
                  <a class="shiftLogin" href="#">LOG IN</a>
                  to your existing account
               </div>
            </div>
        </div>
    </div>
</div>
