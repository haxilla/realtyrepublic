<footer class="publicFooter textWhite"
style="background: #666;border-top:5px solid #fff;">
  <div style="padding-top:15px;padding-bottom:15px;">
    <div class="row row-30">
      <div class="col-sm-6">
        <div class="pr-xl-4">
          <div style="margin-bottom:15px;margin-top:25px;">
            <img src="/images/remLogoO.png" style="max-height:35px;">
          </div>
          <p>We are a team of marketing experts with 25+ years Real Estate experience dedicated to helping you and your listings stand out!</p>
          <div style="margin-bottom:15px;">
            <div style="float:left;padding:15px 0;">
              Subscribe Now
            </div>
            <div style="float:left;padding:15px">
              |
            </div>
            <div style="float:left;padding:15px 0;">
              Privacy Policy
            </div>
            <div style="clear:both;">
            </div>
          </div>
          <!-- Rights-->
          <p class="rights"><span>©</span><span class="copyright-year">2019</span><span> </span><span>RealtyEmails.com</span><span>. </span><span>All Rights Reserved.</span></p>
        </div>
      </div>
      <div class="col-sm-6">
        <h5 style="color:#fff;margin-top:15px;"><u>Contacts</u></h5>
        <dl class="contact-list">
          <dt>Address:</dt>
          <dd>
            7260 W Azure Drive #1110<br>
            Las Vegas, NV 89130
          </dd>
        </dl>
        <dl class="contact-list">
          <dt style="margin-bottom:10px;">Phone:</dt>
          <dd>
            <span style="margin-right:10px;">
              <img src="/images/nvShape1.png"
              style="max-height:25px;">
            </span>
            (702) 907-1720
          </dd>
          <dd>
            <span style="margin-right:8px;">
              <img src="/images/azShape1.png"
              style="max-height:25px;">
            </span>
            (602) 842-3002
          </dd>
        </dl>
      </div>
      <!--
      <div class="col-sm-6 col-xl-3">
        <h5 style="color:#fff;">
          <u>Email Us</u>
        </h5>
          @if(session()->has('contactError'))
            <div class="alert alert-danger">
              {{ session()->get('contactError') }}
            </div>
          @endif
          @if($errors->any() && session()->has('contactError'))
             <div class="alert alert-danger"
             style="margin:0;margin-bottom:15px;">
                <ul>
                   @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                   @endforeach
                </ul>
             </div>
          @endif
          <form action="/contactUsPost" method="POST">
            {{csrf_field()}}
            <input type="text" style="background:#fff;width:100%;padding:0 5px;
            border:2px solid #eee;margin-bottom:5px;padding:5px;"
            placeholder="Your Name" name="senderName"
            value="{{old('senderName')}}">
            <input type="text" style="background:#fff;width:100%;padding:0 5px;
            border:2px solid #eee;margin-bottom:5px;padding:5px;"
            placeholder="Email Address" name="senderEmail"
            value="{{old('senderEmail')}}">
            <textarea style="background:#fff;color:#333;width:100%;padding:0 5px;border:none;
            padding:5px;margin-bottom:5px;border:2px solid #eee;"
            placeholder="Your Message" name="theMsg">{{old('theMsg')}}</textarea>
              <div class="g-recaptcha"
              data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR"
              style="transform:scale(0.9);-webkit-transform:scale(0.85);
              transform-origin:0 0;-webkit-transform-origin:0 0;">
              </div>
            <input type="submit" style="background:#fff;width:100%;margin:5px 0;padding:5px;
            border:1px solid #ccc;border-radius:5px;color:#666"
            value="Send Message">
          </form>
      </div>
      -->
    </div>
  </div>
</footer>
