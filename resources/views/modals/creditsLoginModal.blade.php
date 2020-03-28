<?php
$theURL=url()->current();
if(strpos($theURL,'azPrice')!==false){
    $theState='AZ';
}elseif(strpos($theURL,'nvPrice')!==false){
    $theState='NV';
}else{
  $theState="ER";
}
?>
<div class="modal fade" id="creditsLogin" tabindex="-1" role="dialog"
 aria-labelledby="creditsLogin" style="border-radius:10px;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modHeader"
            style="background-color:#090;color:#fff;font-size:18pt;
            font-weight:bold;text-align:center;padding:25px;">
	            <div class="creditAmount" style="float:left;">
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
            <div class="modal-body">
               <div class="creditValue" style="padding:15px;padding-bottom:0;">
               </div>
               <div style="padding:15px;padding-bottom:0;">
                  Enter your email to begin the purchase and create an account
               </div>
               <div style="padding:15px;">
                  <form class="newPurchaseQty"
                  id="newPurchaseForm"
                  method="post"
                  action="">
                     {{csrf_field()}}
                     <div style="float:left;width:80%;padding-right:15px;">
                        <input name="newPurchaseEmail"
                        type="text"
                        class="form-control">
                     </div>
                     <input type="hidden" name="theState" value="{{$theState}}">
                     <div style="float:left;width:20%;">
                        <input class="btn btn-success" type="submit"
                        style="padding-top:5px;padding-bottom:5px;">
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
