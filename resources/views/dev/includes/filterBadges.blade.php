<div class="buffer">
@if($filter||$sectionFilter)
	@if($filter)
		<div class="inlineBlock rounder darker5" 
		style="margin:15px 5px;margin-top:0;
		padding:3px 10px;">
			<span style="margin-right:5px;">
				<i class="ti-filter"></i>
			</span
			><span style="margin-right:5px;">
				{{$filter}}
			</span
			><span>
				<a href="/dev/index?taskstatus={{$taskstatus}}&sectionFilter={{$sectionFilter}}"
				style="color:#fff;">
					x
				</a>
			</span>
		</div>
	@endif
	@if($sectionFilter)
		<div class="inlineBlock rounder darker5" 
		style="margin:15px 5px;margin-top:0;
		padding:3px 10px;">
			<span style="margin-right:5px;">
				<i class="ti-layers"></i>
			</span
			><span style="margin-right:5px;">
				{{$sectionFilter}}
			</span
			><span>
				<a href="/dev/index?taskstatus={{$taskstatus}}&filter={{$filter}}" style="color:#fff;">
					x
				</a>
			</span>
		</div>
	@endif
@endif
</div>