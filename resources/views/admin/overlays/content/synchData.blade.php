<div style="position:fixed;top:15px;left:20px;">
	<div>
		<h5><b>{{$responseOverlayTitle}}</b></h5>
	</div>
	<div>
		<h6>{{$responseOverlaySubtitle}}</h6>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
	    <div class="col-12">
	        <div class="table-responsive">
	            <table class="table synchTable 
	            bg-charcoal text-white">
	                <thead>
	                    <tr class="tableLegend bg-charcoal text-white">
	                        <th scope="col"><h3>DATA</h3></th>
	                        <th scope="col">Old</th>
	                        <th scope="col">Cur</th>
	                        <th scope="col">Dif</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr class="synchRow propagent agtoffice synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propagent">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propagents
	                        </th>
	                        <td>{{$propagentOld}}</td>
	                        <td>{{$propagentCur}}</td>
	                        <td>{{$propagentDif}}</td>
	                    </tr>
	                    <tr class="synchRow propagent agtoffice synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propagent">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propagents
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="synchRow propflyer propflyerstat 
	                   	propmapping propmeta propremark synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propflyer">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propflyers
	                        </th>
	                        <td>{{$propflyerOld}}</td>
	                        <td>{{$propflyerCur}}</td>
	                        <td>{{$propflyerDif}}</td>
	                    </tr>
	                    <tr class="synchRow propflyer propflyerstat 
	                   	propmapping propmeta propremark synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propflyer">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propflyers
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                    <tr class="synchRow propstyle synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propstyle">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propstyles
	                        </th>
	                        <td>{{$propstyleOld}}</td>
	                        <td>{{$propstyleCur}}</td>
	                        <td>{{$propstyleDif}}</td>
	                    </tr>
	                    <tr class="synchRow propstyle synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propstyle">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propstyles
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="synchRow propphoto synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propphoto">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propphotos
	                        </th>
	                        <td>{{$propphotoOld}}</td>
	                        <td>{{$propphotoCur}}</td>
	                        <td>{{$propphotoDif}}</td>
	                    </tr>
	                    <tr class="synchRow propphoto synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propphoto">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propphotos
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                  	<tr class="synchRow propdeliv synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propdeliv">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propdelivs
	                        </th>
	                        <td>{{$propdelivOld}}</td>
	                        <td>{{$propdelivCur}}</td>
	                        <td>{{$propdelivDif}}</td>
	                    </tr>
	                    <tr class="synchRow propdeliv synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propdeliv">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propdelivs
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                  	<tr class="synchRow propdelivnow synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propdelivnow">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propdelivnow
	                        </th>
	                        <td>{{$propdelivnowOld}}</td>
	                        <td>{{$propdelivnowCur}}</td>
	                        <td>{{$propdelivnowDif}}</td>
	                    </tr>
	                    <tr class="synchRow propdelivnow synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propdeliv">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propdelivnow
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>

	                    <tr class="synchRow allorder synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="allorder">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	allorders
	                    	</th>
	                        <td>{{$allorderOld}}</td>
	                        <td>{{$allorderCur}}</td>
	                        <td>{{$allorderDif}}</td>
	                    </tr>
	                    <tr class="synchRow allorder synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="allorder">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	allorders
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="synchRow emailremoval synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="emailremoval">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	emailremovals
	                    	</th>
	                        <td>{{$emailremovalOld}}</td>
	                        <td>{{$emailremovalCur}}</td>
	                        <td>{{$emailremovalDif}}</td>
	                    </tr>
	                    <tr class="synchRow emailremoval synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="emailremoval">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	emailremovals
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="synchRow etrack synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="etrack">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	etrack
	                    	</th>
	                        <td>{{$etrackOld}}</td>
	                        <td>{{$etrackCur}}</td>
	                        <td>{{$etrackDif}}</td>
	                    </tr>
	                    <tr class="synchRow etrack synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="etrack">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	etrack
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="synchRow deletepropflyer deletepropflyerstat deletepropmapping deletepropmeta deletepropremark 
	                   	synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="deletepropflyer">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	deletepropflyers
	                    	</th>
	                        <td>{{$deletepropflyerOld}}</td>
	                        <td>{{$deletepropflyerCur}}</td>
	                        <td>{{$deletepropflyerDif}}</td>
	                    </tr>
	                    <tr class="synchRow deletepropflyer deletepropflyerstat 
	                    deletepropmapping deletepropmeta deletepropremark synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="deletepropflyer">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	deletepropflyers
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped 
									progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center 
									d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="synchRow deletepropphoto synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="deletepropphoto">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	deletepropphotos
	                    	</th>
	                        <td>{{$deletepropphotoOld}}</td>
	                        <td>{{$deletepropphotoCur}}</td>
	                        <td>{{$deletepropphotoDif}}</td>
	                    </tr>
	                    <tr class="synchRow deletepropphoto synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="deletepropphoto">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	deletepropphotos
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                    <tr class="synchRow deletepropstyle synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="deletepropstyle">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	deletepropstyles
	                    	</th>
	                        <td>{{$deletepropstyleOld}}</td>
	                        <td>{{$deletepropstyleCur}}</td>
	                        <td>{{$deletepropstyleDif}}</td>
	                    </tr>
	                    <tr class="synchRow deletepropstyle synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="deletepropstyle">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	deletepropstyles
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
	<div class="row" style="margin-top:15px;margin-bottom:15px;">
	    <div class="col-12">
	        <div class="table-responsive">
	            <table class="table synchTable bg-charcoal 
	            text-white synchDownload">
	                <thead>
	                    <tr class="tableLegend">
	                        <th scope="col"><h3>DOWNLOADS</h3></th>
	                        <th scope="col">Count</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr class="propphotoDownload synchCounts">
	                    	<th scope="row">	                        	
	                    		<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propphotoDownload">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propphotoDownload
	                        </th>
	                        <td>{{$propphotoDownload}}</td>
	                    </tr>
	                    <tr class="synchRow propphotoDownload synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propphotoDownload">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propphotoDownload
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped 
									progress-bar-animated bg-success" role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center 
									d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="propphotoResize synchCounts">
	                   		<th scope="row">
	                   			<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="propphotoResize">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propphotoResize
	                   		</th>
	                        <td>{{$propphotoResize}}</td>
	                    </tr>
	                    <tr class="synchRow propphotoResize synchProgress
	                    synchDownload">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="propphotoResize">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	propphotoResize
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped 
									progress-bar-animated bg-success" role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center 
									d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                    <tr class="agentphotoDownload synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="agentphotoDownload">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	agentphotoDownload
	                    	</th>
	                        <td>{{$agentphotoDownload}}</td>
	                    </tr>
	                    <tr class="synchRow agentphotoDownload synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="agentphotoDownload">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	agentphotoDownload
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped 
									progress-bar-animated bg-success" role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center 
									d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                    <tr class="agentlogoDownload synchCounts">
	                        <th scope="row">
	                        	<a class="startSynch synchOne
	                        	smallCircleButton hover bg-green">
	                        		<div class="agentlogoDownload">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	agentlogoDownload
	                        </th>
	                        <td>{{$agentlogoDownload}}</td>
	                    </tr>
	                    <tr class="synchRow agentlogoDownload synchProgress">
	                        <th scope="row">
	                        	<a class="smallCircleButton bg-green rotating">
	                        		<div class="agentlogoDownload">
	                        			<i class="ti-reload"></i>
	                        		</div>
	                        	</a>
	                        	agentlogoDownload
	                    	</th>
	                        <td colspan="4">
	                        	<div class="progressWait">
									<span class="progressWaitText">
										Please wait ...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped 
									progress-bar-animated bg-success" role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center 
									d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-12 bg-charcoal">
			<div style="text-align:center;padding:15px 0;">
				<a class="startSynch synchAll
				roundButton hover bg-green">
					<div class="synchAll">
						<span class="smallCircleButton bg-white text-green"
						style="margin-right:5px;">
							<i class="ti-reload"></i>
						</span>
						Synch All
					</div>
				</a>
			</div>
		</div>
	</div>
	<!--
	<div class="row" style="margin-top:50px;margin-bottom:25px;">
	    <div class="col-12" >
	        <div class="table-responsive">
	            <table class="table">
	                <thead>
	                    <tr>
	                        <th scope="col"><h3>ARCHIVES</h3></th>
	                        <th scope="col">Old</th>
	                        <th scope="col">Cur</th>
	                        <th scole="col">Dif</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <tr class="remailflyersmaster synchCounts">
	                    	<th scope="row">RemailFlyers</th>
	                        <td>0</td>
	                        <td>0</td>
	                        <td>
	                        	<a class="startSynch hoverButton bg-green
	                        	synchOne">
	                        		<div class="remailflyersmaster">
	                        			Reset
	                        		</div>
	                        	</a>
	                    	</td>
	                    </tr>
	                    <tr class="remailflyersmaster synchProgress">
	                    	<th scope="row">RemailFlyers</th>
	                        <td colspan="2">
	                        	<div class="progressWait">
									<span class="spinner-border 
									spinner-border-sm"></span>
									<span class="progressWaitText">
										Please wait,Preparing...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                   	<tr class="remailphotosmaster synchCounts">
	                   		<th scope="row">RemailPhotos</th>
	                        <td>0</td>
	                        <td>0</td>
	                        <td>
	                        	<a class="startSynch hoverButton bg-green 
	                        	synchOne">
	                        		<div class="remailphotosmaster">
	                        			Reset
	                        		</div>
	                        	</a>
	                    	</td>
	                    </tr>
	                    <tr class="remailphotosmaster synchProgress">
	                    	<th scope="row">RemailPhotos</th>
	                        <td colspan="2">
	                        	<div class="progressWait">
									<span class="spinner-border 
									spinner-border-sm"></span>
									<span class="progressWaitText">
										Please wait,Preparing...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                    <tr class="remaildeliveriesmaster synchCounts">
	                        <th scope="row">PropDelivs</th>
	                        <td>{{$propdelivOld}}</td>
	                        <td>{{$propdelivCur}}</td>
	                        <td>
	                        	<a class="startSynch hoverButton bg-green
	                        	synchOne">
	                        		<div class="remaildeliveriesmaster">
	                        			Reset
	                        		</div>
	                        	</a>
	                    	</td>
	                    </tr>
	                    <tr class="remaildeliveriesmaster synchProgress">
	                        <th scope="row">PropDelivs</th>
	                        <td colspan="2">
	                        	<div class="progressWait">
									<span class="spinner-border 
									spinner-border-sm"></span>
									<span class="progressWaitText">
										Please wait,Preparing...
									</span>
	                        	</div>
	                        	<div class="progress position-relative">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
									role="progressbar" 
									style="width: 50%;"></div>
									<small class="progressText justify-content-center d-flex position-absolute w-100"></small>
								</div>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
	-->
</div>