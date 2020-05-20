<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
-->
<div class="bs-example" style="margin:10px;">
    <div class="accordion" id="accordionExample"
    style="background:none;color:#fff;
    border:1px solid rgba(255,255,255,.5);border-bottom:none;">
        <div class="taskstepDiv">
            <div id="headingOne"
            class="accordionTab"
            data-menuclick="taskstep">
                <div data-toggle="collapse" 
                data-target="#collapseOne">
                    Task Step
                </div>									
            </div>
            <div id="collapseOne" 
            class="collapse show accordionContent" 
            aria-labelledby="headingOne" 
            data-parent="#accordionExample">
                <div>
                    <div>
                        <input type="text" 
                        name="taskstep" 
                        class="text-white borderlessInput
                        accordionInput lighter1"
                        placeholder="Add New..."
                        style="border-bottom:1px solid rgba(255,255,255,.5)">
                    </div>
                </div>
            </div>
        </div>
        <div class="tipURLDiv">
            <div id="headingTwo"
            class="accordionTab"
            data-menuclick="tipURL">
                <div class="collapsed" 
                data-toggle="collapse" 
                data-target="#collapseTwo">
                    TIP URL
                </div>
            </div>
            <div id="collapseTwo" 
            class="collapse accordionContent" 
            aria-labelledby="headingTwo" 
            data-parent="#accordionExample">
                <input type="text"
                id="tipURLinput" 
                name="tipURL"
                placeholder="Add New..." 
                class="borderlessInput text-white
                accordionInput lighter1">
            </div>
        </div>
        <div class="controllerDiv">
            <div id="headingThree"
            class="accordionTab"
            data-menuclick="controllername">
                <div class="collapsed" 
                data-toggle="collapse" 
                data-target="#collapseThree">
                    Controller
                </div>                     
            </div>
            <div id="collapseThree" 
            class="collapse accordionContent" 
            aria-labelledby="headingThree" 
            data-parent="#accordionExample">
                <input type="text" 
                name="controllername"
                placeholder="Add New..." 
                class="borderlessInput text-white
                accordionInput lighter1">
            </div>
        </div>
        <div class="modelpathDiv">
            <div id="headingFive"
            class="accordionTab"
            data-menuclick="modelpath">
                <div class="collapsed" 
                data-toggle="collapse" 
                data-target="#collapseFive">
                    Model Path
                </div>                     
            </div>
            <div id="collapseFive" 
            class="collapse accordionContent" 
            aria-labelledby="headingFive" 
            data-parent="#accordionExample">
                <input type="text" 
                name="modelpath"
                placeholder="Add New..." 
                class="borderlessInput text-white
                accordionInput lighter1">
            </div>
        </div>
        <div class="filepathDiv">
            <div id="headingSix"
            class="accordionTab"
            data-menuclick="filepath">
                <div class="collapsed" 
                data-toggle="collapse" 
                data-target="#collapseSix">
                    File Path
                </div>                     
            </div>
            <div id="collapseSix" 
            class="collapse accordionContent" 
            aria-labelledby="headingSix" 
            data-parent="#accordionExample">
                <input type="text" 
                name="filepath"
                placeholder="Add New..." 
                class="borderlessInput text-white
                accordionInput lighter1">
            </div>
        </div>
        <div class="routeDiv">
            <div id="headingFour"
            class="accordionTab"
            data-menuclick="routename">
                <div class="collapsed" 
                data-toggle="collapse" 
                data-target="#collapseFour">
                    Route
                </div>                     
            </div>
            <div id="collapseFour" 
            class="collapse accordionContent" 
            aria-labelledby="headingFour" 
            data-parent="#accordionExample">
                <input type="text" 
                name="routename"
                placeholder="Add New..." 
                class="borderlessInput text-white
                accordionInput lighter1">
            </div>
        </div>
    </div>
</div>
                                                    