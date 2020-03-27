<div class="container-fluid">
  <div class="row" style="position:relative;color:#fff;">
    <!-- filter-->
    <div style="position:absolute;width:100%;height:100%;
    background:rgba(0,0,0,.4);">
    </div>
    <!-- filter -->
    <div class="col-12 noPad">
      <div class="landingLogo"
      style="display:inline-block;position:relative;
      background:#090;margin-left:50px;padding:15px;z-index:2000">
        <img src="/images/remLogoO.png"
        style="max-height:45px;">
      </div>
      <div>
        <h1 style="font-size:72px;padding-top:8%;
        text-align:center;">
            <span style="text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
            font-weight:bold;">
              Online
             Real Estate Flyers.</span>
          </span>
        </h1>
        <div style="padding:25px;">
          <div style="text-align:center;">
            <div style="width:40%;margin:0 auto;">
                <div style="padding:10px 15px;background:rgba(255,255,255,.7);
                margin:0 auto;border-radius:.5em;width:100%;position:relative;
                border-bottom-left-radius:0;border-bottom-right-radius:0;">
                  <div style="line-height:40px;width:50px;
                  border-radius:50%;background:#090;text-align:center;
                  color:#fff;position:absolute;left:-15px;top:-15px;
                  border:1px solid #fff;">
                    <i class="fa fa-2x fa-bolt" 
                    style="color:#fff;"></i>
                  </div>
                  <span
                  style="font-weight:bold;font-size:150%;
                  color:#090;letter-spacing:2px;
                  text-shadow:-.5px -.5px 0 #fff,
                  .5px -.5px 0 #fff,
                  -.5px .5px 0 #fff,
                  .5px .5px 0 #fff;">
                    Create an E-Flyer INSTANTLY!
                  </span>
                  <div style="font-size:80%;color:#000;">
                    * All Photos & Details Imported Automatically!
                  </div>
                </div> 
            </div>
            <div style="width:40%;margin:0 auto;background:#fff;
            padding:15px;">
              @include('mdbxPublic.includes.elements.flyerAddressFormButton')
              @include('mdbxPublic.includes.elements.emailFormButton')
              <div style="margin-top:15px;">
                <input type="submit" value="Create FREE Flyer!" 
                style="border-radius:.5em;
                padding:20px 30px;background:#090;color:#fff;
                letter-spacing:2px;font-weight:bold;border:none;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>