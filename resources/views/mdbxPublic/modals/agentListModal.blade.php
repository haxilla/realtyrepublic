<!-- The Modal -->
<div class="modal" id="agentListModal" style="border-radius:0 !important;">
  <div class="modal-dialog" style="max-width:80% !important;border-radius:0 !important;
  max-height:none !important;height:100% !important;margin:0 auto;">
    <div class="modal-content" style="height:100% !important;
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important;">
      <!-- Modal Header -->
      <div class="modal-header" style="text-align:center;background:#223e94;border-radius:0px !important;">
        <h4 class="modal-title" style="color:#fff;">Email Lists</h4>
        <button type="button" class="close" data-dismiss="modal"
        style="color:#fff;">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" style="overflow-y:auto;padding:50px;">
        <div style="margin-bottom:50px;">
          @include('mdbxPublic.includes.coverage.azCoverage')
        </div>
        <div>
          @include('mdbxPublic.includes.coverage.nvCoverage')
        </div>
      </div>
      <!-- Modal footer -->
      <div style="text-align:center;padding:25px;border-top:1px solid #eee;">
        @include('mdbxPublic.includes.elements.lightGradientCreate')
      </div>
    </div>
  </div>
</div>