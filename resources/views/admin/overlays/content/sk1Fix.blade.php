<div class="fix sk1Fix">
  <div class="headWrapper">
    <div class="mainHead">
      <h5>SK1 Fix</h5>
    </div>
    <div class="subHead">
      <div>
        Replaces problematic SK1 IDs
      </div>
      <div style="padding-bottom:15px;margin-bottom:15px;">
        Remote, Local & Archives
      </div>
    </div>
  </div>
  <div class="mainContent">
    <div class="fixCountLabel">
      FIXES NEEDED <span class="theCount">{{$sk1_fixCount}}</span>
    </div>
    <div class="progressDiv">
      <div class="progressWait">
        <span class="progressWaitText">
          Please wait ...
        </span>
      </div>
      <div class="progress position-relative">
        <div class="progress-bar progress-bar-striped
        progress-bar-animated bg-success"
        role="progressbar">
        </div>
        <small class="progressText justify-content-center
        d-flex position-absolute w-100">
        </small>
      </div>
      <div class="startNow scriptStartButton"
      data-fixcount="{{$sk1_fixCount}}">
        <span class="ticon">
          <i class="ti-reload"></i>
        </span>Run Script
      </div>
    </div>
  </div>
</div>
