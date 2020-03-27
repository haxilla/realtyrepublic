<div class="modal fade" id="joinNowModal"
tabindex="-1" role="dialog" aria-labelledby="joinNowModal" aria-hidden="true">
    <div class="modal-dialog joinNowCustom" role="document">
        <!--Content-->
        <div class="modal-content text-center" style='border-radius:0;'>
            <!--Header-->
            <div class="modal-header" style="background:#223e94;border-radius:0;">
                <img src="/images/remLogoO.png" style="max-height:45px">
                <button type="button" class="close" data-dismiss="modal" 
                style="color:#fff;">
                    &times;
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                @if($errors->any())
                    <div class="alert alert-danger showErrors">
                        <ul style="padding:0;margin:0;padding-left:1.5em;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div style="background-color:#ebebeb;padding:25px;">
                        <div class="formHeader" style="color:#223e94;">
                            <h3>
                                Join Now & Make Your First Flyer FREE!
                            </h3>
                        </div>
                        <div style="padding:25px;">
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
                                            value="{{old('theEmail')}}"
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
                                <input type="hidden" name="fromForm" value="theModal">
                            </form>
                        </div>
                        <div class="formText" style="color:#666;">
                            <div>
                                *** Create an E-flyer and website at no cost! Only pay if you like it and want to activate it.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
