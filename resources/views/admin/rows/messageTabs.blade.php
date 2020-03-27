<div class="container-fluid pad5">
	<div class="row">
		<div class="col-12">
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
				    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="tabIcon ti-home"></i></span> <span class="hidden-xs-down">Support</span></a></li>
				    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="tabIcon ti-user"></i></span> <span class="hidden-xs-down">Messages</span></a></li>
				    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="tabIcon ti-email"></i></span> <span class="hidden-xs-down">Trials</span></a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content tabcontent-border">
				    <div class="tab-pane active" id="home" role="tabpanel"
				    style="position:relative;">
						<div class="slickLeftShade hidden">
						</div>
						<div class="slickRightShade hidden">
						</div>
						<div class="supportSlide" 
						style="padding-bottom:15px;padding-top:15px;">
							@include('admin.includes.supportRequests')
						</div>
				    </div>
				    <div class="tab-pane p-20" id="profile" role="tabpanel">2</div>
				    <div class="tab-pane p-20" id="messages" role="tabpanel">3</div>
				</div>
			</div>
		</div>
	</div>
</div>