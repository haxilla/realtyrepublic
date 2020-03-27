  <!--Contact-->
<section id ="contact">
  <div class="container" style="padding:50px;">
    <div class="row">
      <div class="header-section" style="padding:15px;">
        <h2>Contact Us</h2>
      </div>
      @include('mainInclude.errorsAndMessages')
      <form action="/contactUsPost" method="post" role="form" class="contactForm">
        {{csrf_field()}}
          <div class="col-md-6 col-sm-6 col-xs-12 left">
            <div class="form-group">
                <input type="text" class="form-control form"
                name="senderName"
                value="{{old('senderName')}}"
                id="senderName"
                placeholder="Your Name" data-rule="minlen:4"
                data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control"
                name="senderEmail"
                value="{{old('senderEmail')}}"
                id="senderEmail"
                placeholder="Your Email" data-rule="email"
                data-msg="Please enter a valid email" />
                <div class="validation"></div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control"
                name="contactSubject"
                value="{{old('contactSubject')}}"
                id="contactSubject"
                placeholder="Subject"
                data-rule="minlen:4"
                data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 right">
            <div class="form-group">
                <textarea class="form-control"
                name="theMsg"
                rows="5"
                data-rule="required" data-msg="Please write something for us"
                placeholder="Message">{{old('theMsg')}}</textarea>
                <div class="validation"></div>
            </div>
          </div>
          <div class="col-xs-12">
            <!-- Button -->
            <div style="margin-top:10px;margin-bottom:10px;">
              <div class="g-recaptcha"
              data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR">
              </div>
            </div>
            <button type="submit" id="submit" name="submit"
            class="form contact-form-button light-form-button oswald light">
              SEND EMAIL
            </button>
          </div>
      </form>

    </div>
  </div>
  </section>
  <!--/ Contact-->
