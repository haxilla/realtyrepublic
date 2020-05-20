<div class="devTask fixedMenu">
	<div>
		<div class="taskstatus inlineBlock devMenu clickable"
		data-menuclick="taskstatus" 
		style="border-left:1px solid rgba(255,255,255,.3);
		width:135px;">
			<div class="py5-px10">
				<span class="mr15">
					{{$taskDisplay}}
				</span>
				<span class="angleDown">
					<i class='ti-angle-down'></i>
				</span>
			</div>
			<div class="taskstatus dropMenuBox"
			style="width:133px;">
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
			</div>
		</div
		><div class="taskadd inlineBlock devMenu devInput"
		data-menuclick='taskadd' data-toggle="tooltip"
		title="Add Task">
			<div class="py5-px10">
				<i class="ti-plus"></i>
			</div>
			<div class="taskadd dropMenuBox">
				<div class="floatLeft" style="width:85%;">
					<form class="taskaddForm">
						{{csrf_field()}}
						<input type="text" name="taskDesc" 
						placeholder="Add New Task" 
						class="taskaddField" autocomplete="off">
					</form>
				</div>
				<div class="floatRight devInputClose" 
				style="width:15%;text-align:right;">
					<div class="small circle darker5 inlineBlock mr15" 
					style="text-align:center;">
						<i class="ti-close"></i>
					</div>
				</div>
			</div>
		</div
		><div class="taskfilter inlineBlock devMenu clickable"
		data-menuclick="taskfilter" data-toggle="tooltip"
		title="Filter Task">
			<div class="py5-px10">
				<i class="ti-filter"></i>
			</div>
			<div class="taskfilter dropMenuBox">
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter=New&sectionFilter={{$sectionFilter}}">
						New
					</a>
				</div>
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter=Bug&sectionFilter={{$sectionFilter}}">
						Bug
					</a>
				</div>
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter=Feature&sectionFilter={{$sectionFilter}}">
						Feature
					</a>
				</div>
			</div>
		</div
		><div class="taskfilter inlineBlock devMenu clickable"
		data-menuclick="tasksection" data-toggle="tooltip"
		title="Task Section">
			<div class="py5-px10">
				<i class="ti-layers"></i>
			</div>
			<div class="tasksection dropMenuBox">
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter={{$filter}}&sectionFilter=Public">
						Public
					</a>
				</div>
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter={{$filter}}&sectionFilter=Member">
						Member
					</a>
				</div>
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter={{$filter}}&sectionFilter=Admin">
						Admin
					</a>
				</div>
				<div class="menuItem">
					<a href="/dev/index?taskstatus={{$taskstatus}}&filter={{$filter}}&sectionFilter=Dev">
						Dev
					</a>
				</div>
			</div>
		</div
		><div class="tasksearch inlineBlock devMenu devInput"
		data-menuclick='tasksearch' data-toggle="tooltip"
		title="Search Tasks">
			<div class="py5-px10">
				<i class="ti-search"></i>
			</div>
			<div class="tasksearch dropMenuBox">
				<div class="floatLeft" style="width:85%;">
					<input type="text" name="tasksearch"
					class="tasksearchField"
					placeholder="Search..." autocomplete="off">
					<div class="tasksearchResults">
					</div>
				</div>
				<div class="floatRight devInputClose" 
				style="width:15%;text-align:right;">
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
</div>