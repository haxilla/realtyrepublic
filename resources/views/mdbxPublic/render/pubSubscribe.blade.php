<div class="default overlayContent pubSubscribe">
  <div class="overlayBorder">
    <div class="row noMargin textCenter">
      <div class="col-12 noPad">
          <div class="textCenter circle25
          publicOverlayClose">
            X
          </div>
      </div>
    </div>
    <div class="row noMargin">
      <div class="col-12 noPad
      mainHead textCenter">
        Subscribe Today
      </div>
      <div class="col-12 noPad
      subHead textCenter">
        Begin receiving the lastest RealtyEmails!
      </div>
      <div class="col-12 noPad textCenter">
        <form>
          <input type="text" class="firstField field" name="yourName"
          placeholder="Your Name" required>
          <input type="email" class="field" name="yourEmail"
          placeholder="Your Email" required>
          <select style="width:85%;text-align:center !important;padding:5px 15px"
          name="theState" required>
            <option selected="selected"
            name="choose" value="">
              Choose Area
            </option>
            <option value="Arizona">
              Arizona
            </option>
            <option value="Nevada">
              Nevada
            </option>
          </select>
          <div style="max-width:85%;margin:0 auto;margin-top:15px;"
          class="transformSmall">
              @include('mdbxPublic.includes.elements.captchav2')
          </div>
          <input type="submit"
          style="background:#223e94;border-radius:2em;
          color:#fff;border:2px solid #efedff;text-align:center;
          margin-bottom:25px;padding:5px 20px;"
          value="Subscribe">
        </form>
      </div>
    </div>
  </div>
</div>
