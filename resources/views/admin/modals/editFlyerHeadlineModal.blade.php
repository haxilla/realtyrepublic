<div class="modal fade" id="editFlyerHeadlineModal"
tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog autoWidthModal" role="document">
        <div class="modal-content">
            <div class="row" style="background:#fff;margin:0;padding:10px 0;">
                <div class="col-12" style="padding:10px;color:#223e94;">
                    <h4>EDIT YOUR HEADLINE</h4>
                    <hr style="margin-bottom:0;">
                </div>
                <div class="col-12">
                    <div style="padding:15px;" 
                    class="modalFlyerBackground">
                        <img class="modalHeadlineGraphic" src="">
                    </div>
                    <div style="padding:15px">
                        <select id="headlineCaption" class="form-control"
                        name="graphic_words" style="padding:5px;">
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
                    <hr>
                    <div style="padding:15px;">
                        Underline | Bold | 3D
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
