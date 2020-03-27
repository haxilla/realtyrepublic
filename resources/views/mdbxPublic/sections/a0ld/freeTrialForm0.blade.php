<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 noPad"
		style="background:#fff;text-align:center;
		display:flex;align-items:center;justify-content:center;
		flex-direction:column;line-height:3em;border-left:15px solid #efedff">
			<div>
				<h1 style="font-weight:bold;margin-bottom:18px;">
					Start Your
					<br>
					<span style="color:#223e94;">FREE TRIAL</span>
					<br>
					<i>Today!</i>
				</h1>
				<p style="margin-bottom:60px;">
					Create One Flyer
				<br>
					No Credit Card required
				<br>
					No commitment to purchase
				<br>
					Easy to upgrade later
				</p>
			</div>
		</div>
		<div class="col-lg-8 noPad">
			<div class="feature-info">
				<div class="row">
					<div class="col-12" style="text-align:center;">
						<h1 style="font-weight:bold;color:#223e94;">
							<div class="orangeGrad" style="border-radius:50%;
							width:75px;height:75px;display:inline-block;
							background:#fff;padding:5px;
							background-image:linear-gradient(to top, #f6d365, #fda085);">
								<div style="background:#223e94;color:#fff;
								border-radius:50%;padding:10px;
								width:100%;height:100%;">
									<span class="ti-wand gradientText"></span>
								</div>
							</div>
							<div style="margin-top:15px;">
								Flyer Creation Wizard
							</div>
						</h1>
					</div>
					<div>
						<div style="padding:15px 30px;">
						No need to waste time re-inputting the same info & photos.  If its your listing & already online
						<span style="color:#223e94;font-style:italic">anywhere</span>,
						our system will find it and auto create it!
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12" style="text-align:center;">
						<form action="/trialAccount" method="POST"
						id="freeTrialAddressForm"
						class="clearForm">
							{{csrf_field()}}
							@include('mdbxPublic.includes.elements.emailFormButton')
							@include('mdbxPublic.includes.elements.flyerAddressFormButton')
							@include('mdbxPublic.includes.elements.solidBlueCreateSubmit')
						</form>
					</div>
				</div>
			</div>
			<div class="declarations">
			</div>
		</div>
	</div>
</div>
