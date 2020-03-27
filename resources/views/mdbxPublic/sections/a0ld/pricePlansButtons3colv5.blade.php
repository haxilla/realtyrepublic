<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8">
      <div class="row">
        <div class="col-12">
          <div style="padding-bottom:50px;text-align:center;">
            <h1 style="margin:0;padding:0;">
              Pricing
            </h1>
            <div>
              <img src="/images/angle_divider.png">
            </div>
            <div>
              A plan for every budget!
            </div>
            <div>
              Choose from Pay-per-flyer or Unlimited E-flyers
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          @include('mdbxPublic.includes.elements.pricePlans.payPerFlyer')
        </div>
        <div class="col-lg-6">
          @include('mdbxPublic.includes.elements.pricePlans.unlimitedPlans')
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      @include('mdbxPublic.includes.sections.flyerAd-flyerPhotos')
    </div>
  </div>
</div>