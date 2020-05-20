<div class="taskstepDiv mb5">
	@if($the->taskSteps->count()>0)
		<div class="taskstepDisplay">
			@foreach($the->taskSteps as $t)
				<div class="taskstepDesc">
					{{$t['taskstepDesc']}}
				</div>
			@endforeach
		</div>
	@else
		<div class="taskstepEdit">
			<input type="text" name="taskstepDesc"
			placeholder="Task Step" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- controller --> 
<div class="controllernameDiv mb5">
	@if($the->taskDetails->where('controllername','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow controllername{{$the->taskID}}"
			data-menuclick="controllername" data-detailID={{$t->detailID}}>
				{{$t->controllername}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit controllername{{$the->taskID}}">
			<input type="text" name="controllername"
			placeholder="Controller Name" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- routename --> 
<div class="routenameDiv mb5">
	@if($the->taskDetails->where('routename','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow routename{{$the->taskID}}"
			data-menuclick="routename" data-detailID={{$t->detailID}}>
				{{$t->routename}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit routename{{$the->taskID}}">
			<input type="text" name="routename"
			placeholder="Route Name" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- modelpath --> 
<div class="modelpathDiv mb5">
	@if($the->taskDetails->where('modelpath','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow modelpath{{$the->taskID}}"
			data-menuclick="modelpath" data-detailID={{$t->detailID}}>
				{{$t->modelpath}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit modelpath{{$the->taskID}}">
			<input type="text" name="modelpath"
			placeholder="Model Path" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- filepath --> 
<div class="filepathDiv mb5">
	@if($the->taskDetails->where('filepath','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow filepath{{$the->taskID}}"
			data-menuclick="filepath" data-detailID={{$t->detailID}}>
				{{$t->filepath}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit filepath{{$the->taskID}}">
			<input type="text" name="filepath"
			placeholder="File Path" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- CSSpath --> 
<div class="csspathDiv mb5">
	@if($the->taskDetails->where('csspath','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow csspath{{$the->taskID}}"
			data-menuclick="csspath" data-detailID={{$t->detailID}}>
				{{$t->csspath}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit csspath{{$the->taskID}}">
			<input type="text" name="csspath"
			placeholder="CSS Path" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- JSpath --> 
<div class="jspathDiv mb5">
	@if($the->taskDetails->where('jspath','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow jspath{{$the->taskID}}"
			data-menuclick="jspath" data-detailID={{$t->detailID}}>
				{{$t->jspath}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit jspath{{$the->taskID}}">
			<input type="text" name="jspath"
			placeholder="JS Path" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- liveURL --> 
<div class="liveURLDiv mb5">
	@if($the->taskDetails->where('liveURL','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow liveURL{{$the->taskID}}"
			data-menuclick="liveURL" data-detailID={{$t->detailID}}>
				{{$t->liveURL}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit liveURL{{$the->taskID}}">
			<input type="text" name="liveURL"
			placeholder="Live URL" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
<!-- tipURL --> 
<div class="tipURLDiv mb5">
	@if($the->taskDetails->where('tipURL','!=',null)->count()>0)
		@foreach($the->taskDetails as $t)
			<div class="taskdetailShow tipURL{{$the->taskID}}"
			data-menuclick="tipURL" data-detailID={{$t->detailID}}>
				{{$t->tipURL}}
			</div>
		@endforeach
	@else
		<div class="taskdetailEdit tipURL{{$the->taskID}}">
			<input type="text" name="tipURL"
			placeholder="Tip URL" 
			class="roundedInputBar bg-black text-white">
		</div>
	@endif
</div>
