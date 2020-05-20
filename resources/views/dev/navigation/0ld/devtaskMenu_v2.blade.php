<div class="devTask fixedMenu">
	<div>
		<div class="taskstatus inlineBlock devMenu"
		data-menuclick="taskstatus" 
		style="border-left:1px solid rgba(255,255,255,.3)">
			<span class="mr15">
				{{$taskDisplay}}
			</span>
			<span class="angleDown">
				<i class='ti-angle-down'></i>
			</span>
		</div
		><div class="taskstatus dropMenuBox">
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Active">
					Active
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Flagged">
					Flagged
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Completed">
					Completed
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Snoozed">
					Snoozed
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Deleted">
					Deleted
				</a>	
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Tips">
					Tips
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus=Excuses">
					Excuses
				</a>
			</div>
		</div
		><div class="taskadd inlineBlock devMenu"
		data-menuclick='taskadd'>
			<i class="ti-plus"></i>
		</div
		><div class="taskadd dropMenuBox">
			<div class="floatLeft" style="width:85%;">
				<form class="taskaddForm">
					{{csrf_field()}}
					<input type="text" name="taskDesc" 
					placeholder="Add New Task" 
					class="taskaddField">
				</form>
			</div>
			<div class="floatRight" style="width:15%;text-align:right;">
				<div class="small circle darker5 inlineBlock mr15" 
				style="text-align:center;">
					<i class="ti-close"></i>
				</div>
			</div>
		</div
		><div class="taskfilter inlineBlock devMenu"
		data-menuclick="taskfilter">
			<i class="ti-filter"></i>
		</div
		><div class="taskfilter dropMenuBox">
			<div class="menuItem">
				<a href="/dev/index?taskstatus={{$taskstatus}}&filter=New">
					New
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus={{$taskstatus}}&filter=Bug">
					Bug
				</a>
			</div>
			<div class="menuItem">
				<a href="/dev/index?taskstatus={{$taskstatus}}&filter=Feature">
					Feature
				</a>
			</div>
		</div
		><div class="tasksearch inlineBlock devMenu"
		data-menuclick='tasksearch'>
			<i class="ti-search"></i>
		</div>
		<div class="tasksearch dropMenuBox">
			<div class="floatLeft" style="width:85%;">
				<input type="text" name="tasksearch"
				placeholder="Search...">
			</div>
			<div class="floatRight" style="width:15%;text-align:right;">
				<div class="small circle darker5 inlineBlock mr15" 
				style="text-align:center;">
					<i class="ti-close"></i>
				</div>
			</div>
			<div style="clear:both;">
			</div>
		</div>
	</div>
</div>