<div class="
    @if(strpos($theme,'sunsetGrad')!==false)
        sunsetGradAni
    @elseif(strpos($theme,'blueSmoke')!==false)
        blueSmokeGradAni
    @elseif(strpos($theme,'blueGrays')!==false)
        blueGraysAni
    @else
        background-blueGrayGradient
    @endif video-container" style="position:relative;">
    @if(strpos($theme,'showVideo')!==false)
    <video autoplay loop muted>
        <source src="/videos/lightRays.mov"
        type="video/mp4">
    </video>
    @endif
    <div>
        @include('mdbxPublic.includes.sections.landingPageCarousel')
    </div>
</div>