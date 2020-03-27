<div style="display:inline-block;padding:15px;background:#fff;
border:1px solid #ccc;color:#223e94;text-align:center;">
	<div style="margin-bottom:15px;">
		<div style="font-weight:bold;">
			{{$purchaseDesc}}
		</div>
		<hr>
		<div>
			${{$amt}}.00
		</div>
	</div>
	<div>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="P535KBVJMWXN4">
		<input type="hidden" name="custom" value="{{$shortKey}}">
		<input type="image" src="https://www.realtyrepublic.com/images/button_buy.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>
</div>
