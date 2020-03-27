<div class="col-12" style="color:#666;">
    <div style="margin-left:15px;">
        <div style="float:left;">
            <H4 style="margin:0;padding:0;padding-top:30px;">
                MLS# {{ $getFlyer[0]->xMlsNum}}
                <div style="padding-top:15px;">
                    {{$getFlyer[0]->xHeadline}}
                </div>
            </H4>
        </div>
        <div style="float:right;padding-top:30px;padding-right:15px;">
        </div>
        <div style="clear:both;">
        </div>
    </div>
    <div style="margin-top:30px;margin-left:15px;border-style:none;">
        <div class="col-lg-6" style="background:#fff;display:block;">
             @if($getFlyer[0]->xBeds)
                <li style="list-style:none;">
                    {{$getFlyer[0]->xBeds}} Bedrooms
                </li>
            @elseif($getFlyer->first()->xxBeds)
                <li style="list-style:none;">
                    {{$getFlyer[0]->xxBeds}} Bedrooms
                </li>
            @endif
            @if($getFlyer[0]->xBaths)
                <li style="list-style:none;">
                    {{$getFlyer[0]->xBaths}} Bathrooms
                </li>
            @elseif($getFlyer->first()->xxBaths)
                <li style="list-style:none;">
                    {{$getFlyer[0]->xxBaths}} Bathrooms
                </li>
            @endif
            @if($getFlyer[0]->xSqft)
                <li style="list-style:none;">
                    {{$getFlyer[0]->xSqft}} Sq. Ft.
                </li>
            @elseif($getFlyer->first()->xxSqft)
                <li style="list-style:none;">
                    {{$getFlyer[0]->xxSqft}} Sq. Ft.
                </li>
            @endif
        </div>
        <div class="col-lg-6">
        @if($getFlyer[0]->xYrBuilt)
            <li style="list-style:none;">
                Year Built: {{$getFlyer[0]->xYrBuilt}}
            </li>
        @endif
        @if($getFlyer[0]->xPoolPvt
        && $getFlyer[0]->xPoolPvt !== 'No'
        && $getFlyer[0]->xPoolPvt !== 'Community')
            <li style="list-style:none;">
                Private Pool: {{$getFlyer[0]->xPoolPvt}}
            </li>
        @elseif($getFlyer[0]->xPoolPvt && $getFlyer[0]->xPoolPvt=='No')
            <li style="list-style:none;">
                No Pool
            </li>
        @endif
        @if($getFlyer[0]->xParking)
            <li style="list-style:none;">
                Parking: {{$getFlyer[0]->xParking}}
            </li>
        @endif
        </div>
    </div>
</div>
