
@if($p=='1')
	<div style="padding:25px;border:1px solid #ccc;">
		<h4 style="color:#223e94;">
			${{$amt}}.00
		</h4>
		<h5 style="color:#223e94;">
			{{$purchaseDesc}}
		</h5>
	</div>
	<div style="background:#223e94;padding:25px;">
		<h6 style="color:#fff;margin:0;padding:0;">
			Review the information Below & Complete Your Purchase
		</h6>
	</div>
@else
	<div>
		<h3>
			SETUP YOUR TRIAL ACCOUNT
		</h3>
	</div>
@endif