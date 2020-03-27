<form id="mdbxHeadlineForm">
  {{csrf_field()}}
  <input type="hidden" id="theColorID" class="theColorField" name="theColor"
  value="{{$graphic_textcolor}}">
  <input type="hidden" id="theBackground" class="theBackgroundField" name="theBackground"
  value="{{$flyer_background}}">
  <div class="pt-1 pb-1 pr-2 z-depth-1"
  style="background-color:rgba(255,255,255,0.9)">
      <div class="form-row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
              <input type="text" class="form-control"
              placeholder="&#xf0a1; Type your Headline here!"
              name="theHeadline" id="theHeadline"
              value="{{$theHeadline}}"
              style="font-family:Arial,FontAwesome;"
              maxlength="140">
          </div>
      </div>
      <div class="form-row">
          <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-row" style="margin:0 auto;">
                <div style="width:auto;padding:0;margin:0;margin-top:.3rem;padding-right:.3rem"
                class="col-lg-6 col-md-6 col-sm-6">
                    <select id="headlineCaption" class="browser-default form-control"
                    name="graphic_words">
                        <option
                        value="justlisted"
                        @if($graphic_words=='justlisted')
                          selected="selected"
                        @endif>
                          Just Listed
                        </option>
                        <option value="reduced"
                        @if($graphic_words=='reduced')
                          selected="selected"
                        @endif>
                          Reduced
                        </option>
                        <option value="openhouse"
                        @if($graphic_words=='openhouse')
                          selected="selected"
                        @endif>
                          Open House
                        </option>
                        <option value="backonmarket"
                        @if($graphic_words=='backonmarket')
                          selected="selected"
                        @endif>
                          Back on Market
                        </option>
                        <option value="greatbuy"
                        @if($graphic_words=='greatbuy')
                          selected="selected"
                        @endif>
                          Great Buy
                        </option>
                        <option value="mustsee"
                        @if($graphic_words=='mustsee')
                          selected="selected"
                        @endif>
                          Must See
                        </option>
                        <option value="amazingviews"
                        @if($graphic_words=='amazingviews')
                          selected="selected"
                        @endif>
                          Amazing Views
                        </option>
                        <option value="horseproperty"
                        @if($graphic_words=='horseproperty')
                          selected="selected"
                        @endif>
                          Horse Property
                        </option>
                        <option value="acreage"
                        @if($graphic_words=='acreage')
                          selected="selected"
                        @endif>
                          Acreage
                        </option>
                        <option value="agentbonus"
                        @if($graphic_words=='agentbonus')
                          selected="selected"
                        @endif>
                          Agent Bonus
                        </option>
                        <option value="bankowned"
                        @if($graphic_words=='bankowned')
                          selected="selected"
                        @endif>
                          Bank Owned
                        </option>
                        <option value="modelcloseout"
                        @if($graphic_words=='modelcloseout')
                          selected="selected"
                        @endif>
                          Model Closeout
                        </option>
                    </select>
                </div>
                <div style="width:auto;padding:0;margin:0;margin-top:.3rem;" class="col-lg-5 col-md-5 col-sm-5">
                    <select id="headlineStyle" class="browser-default form-control"
                    name="graphic_style">
                        <option value="ul"
                          @if($graphic_style=='ul')
                            selected="selected"
                          @endif>
                          Shadow
                        </option>
                        <option value="bold"
                          @if($graphic_style=='bold')
                            selected="selected"
                          @endif>
                          Bold
                        </option>
                        <option value="3d"
                          @if($graphic_style=='3d')
                            selected="selected"
                          @endif>
                          3-D
                        </option>
                    </select>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                    <div class="headlineCompleteButton menuCompleteButton z-depth-1 hoverable">
                        <i title="Click when finished"
                        class="fa fa-check"></i>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</form>
