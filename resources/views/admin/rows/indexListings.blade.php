<div class="container-fluid pad5">
	<div class="row">
		<div class="col-12">
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
				    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#newAdds" role="tab"><span class="hidden-sm-up"><i class="tabIcon ti-home"></i></span><span class="hidden-xs-down">New Adds</span></a></li>
				    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#topViews" role="tab"><span class="hidden-sm-up"><i class="tabIcon ti-user"></i></span> <span class="hidden-xs-down">Most Views</span></a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
				    <div class="tab-pane active" id="newAdds" role="tabpanel"
				    style="position:relative;">
						<div class="slickLeftLight hidden">
						</div>
						<div class="slickRightLight hidden">
						</div>
						<div class="newAddSlide">
							@include('admin.includes.newAdds')
						</div>
				    </div>
				    <div class="tab-pane" id="topViews" role="tabpanel"
				    style="position:relative">
				    	<div class="slickLeftShade hidden">
						</div>
						<div class="slickRightShade hidden">
						</div>
						<div class="topViewSlide">
							@include('admin.includes.mostViews')
						</div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>