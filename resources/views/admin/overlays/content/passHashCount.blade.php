<div class="fix passwordFix">
  <div class="headWrapper">
    <div class="mainHead">
      <h5>PASSWORD FIX</h5>
    </div>
    <div class="subHead">
       Adds bcrypted password from agtPswd to passHash
    </div>
  </div>
  <div class="mainContent">
    <div class="fixCountLabel">
      FIXES NEEDED <span class="theCount">{{$passHashCount}}</span>
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
      data-fixcount="{{$passHashCount}}">
        <span class="ticon">
          <i class="ti-reload"></i>
        </span>Run Script
      </div>
    </div>
  </div>
</div>
