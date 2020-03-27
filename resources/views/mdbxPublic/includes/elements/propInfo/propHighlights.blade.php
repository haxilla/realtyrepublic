<div style="background-color:#fff;color:#666;margin:0;">
    @if($getFlyer->first()->theRemarks->xb1||$getFlyer->first()->theRemarks->xb2||
    $getFlyer->first()->theRemarks->xb3||$getFlyer->first()->theRemarks->xb4||
    $getFlyer->first()->theRemarks->xb5||$getFlyer->first()->theRemarks->xb6||
    $getFlyer->first()->theRemarks->xb7||$getFlyer->first()->theRemarks->xb8)
        <fieldset style="margin-top:30px;margin-left:30px;margin-right:30px;">
            <legend>PROPERTY HIGHLIGHTS</legend>
            <div class="col-lg-6" style="background:#fff;display:block;">
                @if($getFlyer[0]->theRemarks->xb1)
                    <li>
                        {{$getFlyer[0]->theRemarks->xb1}}
                    </li>
                @endif
                @if($getFlyer[0]->theRemarks->xb3)
                    <li>
                        {{$getFlyer[0]->theRemarks->xb3}}
                    </li>
                @endif
                @if($getFlyer[0]->theRemarks->xb5)
                    <li>
                        {{$getFlyer[0]->theRemarks->xb5}}
                    </li>
                @endif
                @if($getFlyer[0]->theRemarks->xb7)
                    <li>
                        {{$getFlyer[0]->theRemarks->xb7}}
                    </li>
                @endif
            </div>
            <div class="col-lg-6" style="background:#fff;">
                @if($getFlyer[0]->theRemarks->xb2)
                    <li>
                        {{$getFlyer[0]->theRemarks->xb2}}
                    </li>
                @endif
                @if($getFlyer[0]->theRemarks->xb4)
                    <li>
                        {{$getFlyer[0]->theRemarks->xb4}}
                    </li>
                @endif
                @if($getFlyer[0]->theRemarks->xb6)
                    <li>
                      {{$getFlyer[0]->theRemarks->xb6}}
                    </li>
                @endif
                @if($getFlyer[0]->theRemarks->xb8)
                    <li>
                      {{$getFlyer[0]->theRemarks->xb8}}
                    </li>
                @endif
            </div>
        </fieldset>
    @endif
    <div class="clearfix">
    </div>
    @if($getFlyer->first()->theRemarks->xPubRemarks)
        <fieldset style="margin-left:30px;margin-top:30px;margin-right:30px;">
            <legend>AGENT REMARKS</legend>
            <div style="background:#fff;">
                {{$getFlyer[0]->theRemarks->xPubRemarks}}
            </div>
        </fieldset>
    @endif
</div>
