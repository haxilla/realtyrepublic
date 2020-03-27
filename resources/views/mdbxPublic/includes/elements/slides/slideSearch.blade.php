<ul class="nav nav-tabs"
role="tablist">
  <li class="nav-item">
    <a data-toggle="tab" class="nav-link active" 
    href="#a1">
        Search ID or MLS #
    </a>
  </li>
  <li class="nav-item">
    <a data-toggle="tab" 
    role="tab"
    class="nav-link" 
    href="#a2">
        Search Features &amp; Location
    </a>
  </li>
</ul>
<div class="tab-content">
  <div class="tab-pane fade show active" 
  id="a1"
  role="tabpanel">
    <div class="container-fluid searchFormTop formPadding">
      <div class="row">
        <div class="col-12" style="padding:25px;border:1px solid #eee;
        border-top:none;background:#f3f0ed;">
          <div style="width:350px;">
            <form method="POST" action="/flyerSearch">
              {{ csrf_field() }}
              <div style="float:left;">
              <input
                class="propIDinput form-control"
                type="text"
                placeholder="Enter ID or MLS Number" name="propIDsearch">
              </div>
              <div style="float:left;margin-left:10px;">
                <input class="propIDsubmit form-control"
                value="Submit"
                type="submit"
                style="width:75px;background-color:#fff; color:#666;">
              </div>
              <div style="clear:both;">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade searchFormTop" 
  id="a2"
  role="tabpanel">
    <div class="searchFormTop formPadding">
      <div class="container-fluid" style="border:1px solid #eee;padding:25px;background:#f3f0ed;">
        <form action="/featureSearch" method="POST">
          {{csrf_field()}}
          <div class="row">
            <div class="col-lg-3 col-md-3 col-3" style="margin:0;">
              <div>
                  <select name="location" class="propSlideFormInput form-control">
                    <option selected disabled value="">Location</option>
                    <option value="AZ">Arizona</option>
                    <option value="NV">Nevada</option>
                  </select>
              </div>
              <div>
                <select name="propType" class="propSlideFormInput form-control">
                  <option selected disabled value="">Property Type</option>
                  <option value="forSaleRes">Residential For Sale</option>
                  <option value="forRentRes">Residential Rental</option>
                  <option value="commercial">Commercial</option>
                  <option value="land">Land</option>
                  <option value="busOpp">Business For Sale</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-3" style="margin:0;">
                <div>
                  <select name="minPrice" class="propSlideFormInput form-control">
                    <option selected disabled value="">Min Price</option>
                    <option value="1">No Min</option>
                    <option value="100000">$100,000</option>
                    <option value="200000">$200,000</option>
                    <option value="350000">$350,000</option>
                    <option value="700000">$700,000</option>
                  </select>
                </div>
                <div>
                  <select name="maxPrice" class="propSlideFormInput form-control">
                    <option selected disabled value="">Max Price</option>
                    <option value="250000">$250,000</option>
                    <option value="500000">$500,000</option>
                    <option value="1000000">$1M</option>
                    <option value="99999999">No Max</option>
                  </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-3" style="margin:0;">
                <div>
                  <select name="xBeds" class="propSlideFormInput form-control">
                    <option selected disabled value="">Bedrooms</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5+</option>
                  </select>
                </div>
                <div>
                  <select name="xBaths" class="propSlideFormInput form-control">
                    <option selected value="">Bathrooms</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                  </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-3 " style="margin:0;">
              <div style="padding:10px;padding-bottom:25px;">
              </div>
              <div>
                <input type="submit" class="propSlideFormInput form-control"
                style="width:75px;border-radius:10px;background-color:#666;color:#fff;">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div style="font-size:8pt;padding-top:5px;"">
  *** This search will only retrieve results for our flyers and slide shows.  It is not a complete home search or affiliated with any MLS system
</div>

