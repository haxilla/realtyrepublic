<style>
  .context-dark, .bg-gray-dark, .bg-primary {
    color: rgba(255, 255, 255, 0.8);
}

.footer-classic a, .footer-classic a:focus, .footer-classic a:active {
    color: #ffffff;
}
.nav-list li {
    padding-top: 5px;
    padding-bottom: 5px;
}

.nav-list li a:hover:before {
    margin-left: 0;
    opacity: 1;
    visibility: visible;
}

ul, ol {
    list-style: none;
    padding: 0;
    margin: 0;
}

.social-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding: 23px;
    font: 900 13px/1 "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
}
.social-container .col {
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.nav-list li a:before {
    color: #4d6de6;
    display: inline-block;
    vertical-align: baseline;
    margin-left: -28px;
    margin-right: 7px;
    opacity: 0;
    visibility: hidden;
    transition: .22s ease;
}
</style>
<footer class="section footer-classic context-dark bg-image" style="background: #666;">
  <div class="container" style="padding-top:15px;padding-bottom:15px;">
    <div class="row row-30">
      <div class="col-md-4 col-xl-5">
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
      <div class="col-md-4">
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
            <span style="margin-right:10px;"><img src="/images/nvShape1.png" style="max-height:25px;"></span>
            <a href="tel:#">(702) 907-1720</a>
          </dd>
          <dd>
            <span style="margin-right:8px;"><img src="/images/azShape1.png" style="max-height:25px;"></span>
            <a href="tel:#">(602) 842-3002</a>
          </dd>
        </dl>
      </div>
      <div class="col-md-4 col-xl-3">
        <h5 style="color:#fff;">
          <u>Email Us</u>
        </h5>
          @if(session()->has('contactError'))
            <div class="alert alert-danger">
              {{ session()->get('contactError') }}
            </div>
          @endif
          @if($errors->any() && session()->has('contactError'))
             <div class="alert alert-danger" style="margin:0;margin-bottom:15px;">
                <ul>
                   @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                   @endforeach
                </ul>
             </div>
          @endif
          <form action="/contactUsPost" method="POST">
            {{csrf_field()}}
            <input type="text" style="background:#fff;width:100%;padding:0 5px;"
            placeholder="Your Name" name="senderName" value="{{old('senderName')}}">
            <input type="text" style="background:#fff;width:100%;padding:0 5px;"
            placeholder="Email Address" name="senderEmail" value="{{old('senderEmail')}}">
            <textarea style="background:#fff;color:#333;width:100%;padding:0 5px;"
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
    </div>
  </div>
</footer>
