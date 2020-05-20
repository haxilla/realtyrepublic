@if($the->adminInfo->authLevel<2)
	<div class="taskauthlevel inlineBlock text-center"
	data-menuclick="taskauthlevel">
		<div class="dropMenu{{$the->taskID}} small circle lighter2">
			{{$the->authLevel}}
		</div>
		<div class="dropMenuBox taskauthlevel{{$the->taskID}}">
			<div class="menuItem">
				<a href="" data-menuclick="1">
					1
				</a>
			</div>
			<div class="menuItem" >
				<a href="" data-menuclick="2">
					2
				</a>
			</div>
			<div class="menuItem" >
				<a href="" data-menuclick="3">
					3
				</a>
			</div>
		</div>
	</div>
@endif