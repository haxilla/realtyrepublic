<div class="modal fade" id="freeTrialModal"
tabindex="-1" role="dialog" aria-labelledby="confirmFlyerDelete" aria-hidden="true">
    <div class="modal-dialog modal-md modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">

            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <div style="float:left;color:#090;font-size:16pt;">
                    <b>REALTY</b>EMAILS<b>.com</b>
                </div>
                <div style="float:right;">
                    <a data-dismiss="modal" href="#">
                        <i class="fa fa-times-circle"></i>
                    </a>
                </div>
                <div style="clear:both;">
                </div>
            </div>

            <!--Body-->
            <div class="modal-body" style="padding-top:0;padding-bottom:0;">
                <div class="formContainer"
                    style="background-color:#ebebeb;">
                        <div class="formHeader">
                          FREE TRIAL
                        <!-- <img src="img/freetrial.png"> -->
                        </div>
                        <div>
                            <form method="POST" action="/trialAccount">
                                {{ csrf_field() }}
                                <fieldset class="form-group">
                                    <label class="form-control-label sr-only">Your Email</label>
                                    <div>
                                        <div style="float:left;width:75%;">
                                            <input
                                            style="border:none;height:50px;width:100%;
                                            padding-left:15px;font-size:14pt;
                                            border-top-left-radius:10px;
                                            border-bottom-left-radius:10px;font-family:arial;"
                                            placeholder="Your Email"
                                            name="theEmail"
                                            id="trialEmail"
                                            class="modInputMsg form-control"
                                            type="email"
                                            required>
                                        </div>
                                        <div style="float:left;width:25%;">
                                            <input
                                            class=""
                                            style="width:100%;padding:10px;margin-top:0;
                                            border:none;height:50px;background-color:#ccc;
                                            color:#666;border-top-right-radius:10px;
                                            border-bottom-right-radius:10px;
                                            font-family:arial;"
                                            type="submit" id="freetrialx">
                                        </div>

                                        <div style="clear:both;">
                                        </div>
                                        <div class="modInputMsg">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="formText" style="color:#666;">
                        *** Create an E-flyer and website at no cost! Only pay if you like it and want to activate it.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
