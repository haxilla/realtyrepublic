<div class="tasksection inlineBlock"
data-menuclick="tasksection">
	<div class="dropMenu{{$the->taskID}} rounder lighter2" 
	style="padding:0 10px;">
		@if($the->taskSection)
			{{$the->taskSection}}
		@else
			<span class="mr15">
				<i class="ti-help-alt"></i>
			</span>
			<span class="angleDown">
				<i class="ti-angle-down"></i>
			</span>
		@endif
	</div>
	<div class="tasksection tasksection{{$the->taskID}} 
	dropMenuBox">
		<!-- left column -->
		<div class="dropMenuColumn">
			<div class="menuItem">
				<a href="" data-menuclick="Public">
					Public
				</a>
			</div>
			<div class="menuItem">
				<a href="" data-menuclick="Member">
					Member
				</a>
			</div>
			<div class="menuItem">
				<a href="" data-menuclick="Admin">
					Admin
				</a>
			</div>
		</div>
		<!-- right column -->
		<div class="dropMenuColumn">
			<div class="menuItem">
				<a href="" data-menuclick="Dev">
					Dev
				</a>
			</div>
			<div class="menuItem">
				<a href="" data-menuclick="Tip">
					Tip
				</a>
			</div>
			<div class="menuItem">
				<a href="" data-menuclick="Excuse">
					Excuse
				</a>
			</div>
		</div>
		<!-- columns ended -->
	</div>
	<!-- dropMenuBox ended -->
</div>
<!-- task section ended -->