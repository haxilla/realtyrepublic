<div style="color:#fff;padding:5px;font-size:9pt;">
   <div style="float:left;">
      <div style="display:inline-block;">
         @if($the->taskPriority)
            <?php $theClass='text-green'; ?>
         @else
            <?php $theClass='text-white'; ?>
         @endif
         <a href="#"
         class="devButton1 taskPriorityButton
         taskPriorityButton{{$the->taskID}} {{$theClass}}"
         id="{{$the->taskID}}">
            <i class="ti-flag"></i>
         </a>
      </div>
      <div style="display:inline-block;">
         <a href="#" class="devButton1 taskWizardButton" id="{{$the->taskID}}">
            <i class="ti-wand"></i>
         </a>
      </div>
      <div style="display:inline-block;">
         <a href="/dev/taskComplete?taskID={{$the->taskID}}" class="devButton1">
            Mark Done
         </a>
      </div>
      <div style="display:inline-block;">
         <!-- opens js window leave href alone! -->
         <a href="#"
         class="devButton1 addCommentButton" id="{{$the->taskID}}">
            Add Comment
         </a>
      </div>
      <!--
      @ if($adminInfo->authLevel==1)
      <div style="display:inline-block;">
         <a href="/dev/markTip?taskID={ {$the->taskID}}"
            class="devButton1">
            Mark Tip
         </a>
      </div>
      @ endif
      -->
      <!--
      @ if($adminInfo->authLevel==1)
      <div style="display:inline-block;">
         <a href="/dev/makeExcuse?taskID={ {$the->taskID}}"
            class="devButton1">
            Make Excuse
         </a>
      </div>
      @ endif
      -->
   </div>
   <div style="float:right;">
      @if($adminInfo->authLevel==1)
         <a href="/dev/taskDelete?taskID={{$the->taskID}}">
            <span class="badge" style="background-color:#900;color:#fff;">
               Delete
            </span>
         </a>
      @endif
   </div>
   <div style="clear:both;">
   </div>
</div>
