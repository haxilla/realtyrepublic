<div class="row" style="background:#fff;">
	<div class="col-12">
		<div>
			<div class="row">
				<div class="col-12">
					<div style="float:left;padding:10px;">
						<h4 style="margin:0;padding:0;">
							Welcome, Admin
						</h4>
					</div>
					<div style="float:right;height:100%;
					display: flex;justify-content: center;
					align-items: center;padding-right:10px;"
					class="smallerText">
						<div>
							{{\Carbon\Carbon::now() 
							->timezone('America/Phoenix')
							->format('D, M jS Y H:i A')}}
						</div>
					</div>
					<div style="clear:both;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

