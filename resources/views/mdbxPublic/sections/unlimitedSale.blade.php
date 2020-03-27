<div class="container-fluid unlimitedSale
background-bluePurple">
  <div class="row noMargin textWhite textCenter">
    <div class="col-12 preHead">
      Special Offer!
    </div>
    <div class="col-12">
      <div class="mainHead">
        <div class="darker3 circle65 inlineBlock marginAuto
        ticon lineHeight75">
          <span class="ti-infinite"></span>
        </div>
        <div class="mainHeadText">
          UNLIMITED E-FLYERS
        </div>
      </div>
      <hr>
      <p class="subHead">
        Promote ALL Your listings for ONE Low Fee!
      </p>
    </div>
  </div>
  <div class="row noMargin">
    <div class="col-12 darker3 startPurchase padding5 borderRadius5"
    id="startPurchase99" data-desc="3 Months Unlimited E-flyers Account">
      <div class="row noMargin background-bluePurple borderRadius5">
        <div class="col-4 darker3 tl-radius-5 bl-radius-5 textCenter
        textWhite padding50-0">
          <div class="colWrapper">
            <div class="vertical-center">
              <span class="priceUnit">$</span>
              <span class="price">99</span>
            </div>
          </div>
        </div>
        <div class="col-8 padding25-0 backgroundWhite
        bl-radius-0 tl-radius-0 borderRadius5">
          <div class="colWrapper textCenter">
            <div class="timeFrame">
              3 MONTHS
            </div>
            <div>
              Unlimited E-flyers Until
            </div>
            <div>
              {{\Carbon\Carbon::now()
                ->addMonths(3)
                ->format('M d, Y')}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin:0;color:#fff;padding:25px;
  font-size:80%;">
    <div style="text-align:center;margin:0 auto;">
      @include('mdbxPublic.includes.elements.buyNowRedCreateSubmit')
    </div>
    <div class="col-12">
      <div style="text-align:center;margin:15px 0;">
        <div>Send Each E-flyer One Time</div>
        <div>Free Resend After 21 Days</div>
      </div>
      <div>
        *** To send the same flyer more often, extra charges would apply.
        If you anticipate a need to send the same flyers more than once
        a month, use the pay-per-flyer plan.
      </div>
    </div>
  </div>
</div>
