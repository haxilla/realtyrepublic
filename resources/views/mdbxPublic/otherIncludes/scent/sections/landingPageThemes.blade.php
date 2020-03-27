<div class="
    @if(strpos($theme,'sunsetGrad')!==false)
        sunsetGradAni
    @elseif(strpos($theme,'blueSmoke')!==false)
        blueSmokeGradAni
    @elseif(strpos($theme,'blueGrays')!==false)
        blueGraysAni
    @else
        background-blueGrayGradient
    @endif">
    <div>
        @include('mdbxPublic.includes.sections.landingPagex2')
    </div>
</div>