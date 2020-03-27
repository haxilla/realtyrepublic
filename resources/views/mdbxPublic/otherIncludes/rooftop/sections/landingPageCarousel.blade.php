<div style="color:rgba(255,255,255,.9);"
class="container-fluid">
  <div class="row" 
  @if(strpos($theme,'100h')!==false)
    style="min-height:100vh;position:relative;"
  @endif>
    <div class="col-lg-5">
      <div class="landingPageLeft">
        <div class="padding25 landingLogo">
          <img src="/images/remLogoO.png"
          style="max-height:50px;">
        </div>
        <h1 style="font-size:180%;padding:5%;padding-bottom:0;padding-top:10%;">
          <span class="gradientText text-bold">DAZZLING</span>
          <span style="text-shadow: 2px 4px 3px rgba(0,0,0,0.3);">
            Online Real Estate Flyers 
          & Custom Property Websites
          </span>
        </h1>
        <p style="font-size:135%;padding:5%">
           Get Your Listing NOTICED!
        </p>
        <div style="font-size:115%;padding:5%;padding-top:0;padding-bottom:0">
          <ul style="list-style-type:none;">
            <li>
              <i class="fa fa-envelope" 
              style="color:rgba(255,255,255,.5);margin-right:10px;"></i>
              Email Thousands of Local Agents!
            </li>
            <li>
              <i class="fa fa-user" 
              style="color:rgba(255,255,255,.5);margin-right:10px;"></i>
              Share on Social Media Sites
            </li>
            <li>
              <i class="fa fa-print" 
              style="color:rgba(255,255,255,.5);margin-right:10px;"></i>
              Print Brochures
            </li>
            <li>
              <i class="fas fa-chart-bar" 
              style="color:rgba(255,255,255,.5);margin-right:10px;"></i>
              Track Progress
            </li>
          </ul>
        </div>
        <div style="padding:25px;padding-bottom:35px;">
          <div style="text-align:center;">
            <div>
                <div style="font-size:125%;padding:15px;
                padding-bottom:5px;font-weight:bold;">
                  <i class="fa fa-bolt gradientText" 
                  style="margin-right:10px;"></i>
                  <span class="gradientText">Auto Create in Minutes!</span>
                </div> 
                <div>
                  Just Enter Address & Email!
                </div>
            </div>
            <div style="margin-top:15px;">
              <input type="submit" value="Create FREE Flyer!" style="border-radius:2em;
              padding:15px 30px;background:#900;color:#fff;
              border:3px solid #fff;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7 noPad">
      <div class="landingPageRight" 
      @if(strpos($theme,'rotateFlyer')!==false)
        style="perspective:2500px;"
      @else
      @endif>
        @include('mdbxPublic.includes.sections.carouselOnly')
      </div>
    </div>
  </div>
</div>
