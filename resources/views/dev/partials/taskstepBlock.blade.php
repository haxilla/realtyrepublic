@if($the->taskSteps->count()>0)
	<div class="taskstepDiv mb5">
		<div class="taskstepDisplay">
			@foreach($the->taskSteps as $t)
				<div class="taskstepDesc">
					{{$t['taskstepDesc']}}
				</div>
			@endforeach
		</div>
	</div>
@endif
@if($the->taskDetails->where('controllername','!=',null)->count()>0)
	<div>
		Controllers
	</div>
	<hr>
	@foreach($the->taskDetails as $t)
		<div class="taskdetailShow controllername{{$the->taskID}}"
		data-menuclick="controllername" data-detailID={{$t->detailID}}>
			{{$t->controllername}}
		</div>
	@endforeach
@endif
@if($the->taskDetails->where('routename','!=',null)->count()>0)
	<div>
		Routes
	</div>
	<hr>
	@foreach($the->taskDetails as $t)
		<div class="taskdetailShow routename{{$the->taskID}}"
		data-menuclick="routename" data-detailID={{$t->detailID}}>
			{{$t->routename}}
		</div>
	@endforeach
@endif
@if($the->taskDetails->where('modelpath','!=',null)->count()>0)
	<div>
		Models
	</div>
	<hr>
	@foreach($the->taskDetails as $t)
		<div class="taskdetailShow modelpath{{$the->taskID}}"
		data-menuclick="modelpath" data-detailID={{$t->detailID}}>
			{{$t->modelpath}}
		</div>
	@endforeach
@endif
@if($the->taskDetails->where('filepath','!=',null)->count()>0)
	<div>
		Files
	</div>
	<hr>
	@foreach($the->taskDetails as $t)
		<div class="taskdetailShow filepath{{$the->taskID}}"
		data-menuclick="filepath" data-detailID={{$t->detailID}}>
			{{$t->filepath}}
		</div>
	@endforeach
@endif
@if($the->taskDetails->where('tipURL','!=',null)->count()>0)
	<div>
		TIP URL
	</div>
	<hr>
	@foreach($the->taskDetails as $t)
		<div class="taskdetailShow tipURL{{$the->taskID}}"
		data-menuclick="tipURL" data-detailID={{$t->detailID}}>
			{{$t->tipURL}}
		</div>
	@endforeach
@endif

<div class="taskdetail_accordion">
	@include('dev.partials.taskdetail_accordion')
</div>