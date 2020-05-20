@if($the->taskDetails
->where('linkID','!=',null)
->count()>0)		
	@foreach($the->taskDetails
	->where('linkID','!=',null) as $t)
		<div class="tasklinkDiv tasklink{{$t->linkID}}"
		data-menuclick="tasklink" 
		data-linkid={{$t->linkID}}>
			<div class="inlineBlock smaller circle 
			linkEdit bg-white m5 ml0" 
			style="color:#223e94;
			font-size:.80em;">
				<i class="ti-link"></i>
			</div>
			<a class="inlineBlock" 
			href="{{$t->linkURL}}" target="_blank">
				{{$t->linkTitle}}
			</a>
		</div>
	@endforeach
@endif