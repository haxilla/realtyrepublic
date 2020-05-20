@if($taskstatus!="Snoozed" && !$the->taskComplete)
	<div class="small circle lighter2 inlineBlock"
	data-toggle="tooltip" title="Snooze" 
	data-taskclick="tasksnooze">
		<div>
			<i class="ti-timer"></i>
		</div>
		<div class="taskSnooze dropMenuBox">
			<div class="dropMenuColumn">
				<div class="menuItem">
					<a href="" data-snoozetimer="fewHours">
						3 Hours
					</a>
				</div>
				<div class="menuItem">
					<a href="" data-snoozetimer="oneDay">
						1 Day
					</a>
				</div>
				<div class="menuItem">
					<a href="" data-snoozetimer="fewDays">
						3 Days
					</a>
				</div>
			</div>
			<div class="dropMenuColumn">
				<div class="menuItem">
					<a href="" data-snoozetimer="week">
						1 Week
					</a>
				</div>
				<div class="menuItem">
					<a href="" data-snoozetimer="month">
						1 Month
					</a>
				</div>
				<div class="menuItem">
					<a href="" data-snoozetimer="indefinite">
						Indefinite
					</a>
				</div>
			</div>
		</div>
	</div>
@elseif(!$the->taskComplete)
	<div class="small circle lighter2 inlineBlock"
	data-toggle="tooltip" title="UnSnooze" 
	data-taskclick="taskunsnooze">
		<i class="ti-back-left"></i>
	</div>
@endif