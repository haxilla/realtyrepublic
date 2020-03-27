<div class="
    @if(strpos($theme,'sunsetGrad')!==false)
        sunsetGradAni
    @elseif(strpos($theme,'blueSmoke')!==false)
        blueSmokeGradAni
    @elseif(strpos($theme,'blueGrays')!==false)
        blueGraysAni
    @endif"
    style="background-image:url('/images/rebg_img17.jpg');
    background-position:20% 15%;">
    <div>
        @include('mdbxPublic.includes.sections.landingPagex')
    </div>
</div>