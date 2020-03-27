<div class="row noticeRow">

	<div class="col-md-3">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div>
							<h4 style="padding:.125em 0;">
								Menu
							</h4>
						</div>
						<hr style="margin-top:0;">
						<div>
							Add Agent
						</div>
						<div>
							Create Flyer
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-9" style="margin-bottom:1.5em;">
		<div class="card" style="height:100%;">
			<div class="card-body" style="padding-bottom:0;">
				<div class="adminHeader row noPad">
					<div class="col-12 my-auto">
						<div class="row">
							<div class="col-lg-6 my-auto">
								<h4 style="padding:.125em 0">Welcome, Admin</h4>
							</div>
							<div class="col-lg-6 my-auto">
								<div style="padding:.125em 0">
									{{\Carbon\Carbon::now() 
									->timezone('America/Phoenix')
									->format('D, M jS Y H:i A')}}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="text-align:right;position:relative;">
					<div class="dropdown" style="position:absolute;right:0;bottom:0;">
						<button class="btn btn-secondary"
						type="button" id="dropdownMenuButton" data-toggle="dropdown" 
						aria-haspopup="true" aria-expanded="false">
							<i class="mdi mdi-settings"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-right" 
						aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Site Modes</a>
							<a class="dropdown-item" href="#">Add Admin</a>
							<a class="dropdown-item" href="#">Logs</a>
						</div>
					</div>
				</div>
				<hr style="margin-top:0;">
				@include('admin.rows.noticeLabels')
			</div>

		</div>
	</div>
</div>