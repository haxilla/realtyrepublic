<div id="areyousureModal" class="modal fade in"
style="z-index:5000">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">			
				<h4 class="modal-title">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? 
				This process cannot be undone.</p>
			</div>
			<div class="modal-footer 
			areyousureModal">
				<button type="button" 
				class="borderNone modalDismiss rounder
				px10" 
				data-dismiss="modal">
					Cancel
				</button>
				<button type="button" 
				class="jqclick borderNone modalAccept
				rounder bg-red text-white px10"
				data-thisclick='retsdeleteOK'
				data-retsid="">
					Delete
				</button>
			</div>
		</div>
	</div>
</div>