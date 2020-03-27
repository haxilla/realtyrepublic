<div class="autoResultsRender">
   @if($propagents->count()>0)
      <div style="background:rgba(0,0,0,.1);padding:5px 10px;
      margin-bottom:5px;margin-right:15px;">
         MEMBERS
      </div>
      <div style="margin-bottom:15px;">
         @foreach($propagents->sortBy('agtFullName') as $the)
            <div class="white-hover" style="padding:0 15px;
            @if($the->theAgentCleanup['accountType']!=='main')
               opacity:.5
            @endif">
               <div style="float:left;width:50px;white-space:nowrap;
               overflow:hidden;text-overflow:ellipsis;
               margin-right:15px;">
                  @if($the->theAgentCleanup['accountType'])
                     {{$the->theAgentCleanup['accountType']}}
                  @else
                     check
                  @endif
               </div>
               <div style="float:left;width:50px;white-space:nowrap;
               overflow:hidden;text-overflow:ellipsis;
               margin-right:15px;">
                  {{$the->id}}
               </div>
               <div style="float:left;width:225px;white-space:nowrap;
               overflow:hidden;text-overflow:ellipsis;
               margin-right:15px;">
                  {{$the->agtFullName}}
               </div>
               <div style="float:left;">
                  <a href="/admin/roster/adreAgentResult?LicNumber={{$the->LicNumber}}"
                  style="color:#fff;">
                     {{$the->theAgtOffice['officeName']}}
                  </a>
               </div>
               <div style="clear:both;">
               </div>
            </div>
         @endforeach
      </div>
   @endif
   @if($adreAgents->count()>0)
      <div style="background:rgba(0,0,0,.1);
      padding:5px 10px;margin-bottom:5px;margin-right:15px;">
         ADRE
      </div>
      @foreach($adreAgents->sortBy('LicStatus') as $the)
         <div class="white-hover" style="padding:0 15px;">
            <div style="float:left;width:100px;">
               {{$the->OriginalDate}}
            </div>
            <div style="float:left;width:100px;">
               {{$the->LicStatus}}
            </div>
            <div style="float:left;width:200px;">
               {{$the->FirstName}} {{$the->MiddleName}} {{$the->LastName}}
            </div>
            <div style="float:left;">
               <a href="/admin/roster/adreAgentResult?LicNumber={{$the->LicNumber}}"
               style="color:#fff;">
                  {{$the->EmployerDBAName}} - {{$the->LicNumber}}
               </a>
            </div>
            <div style="clear:both;">
            </div>
         </div>
      @endforeach
   @endif
   @if($glvarAgents->count()>0)
      <div style="background:rgba(0,0,0,.1);padding:5px 10px;
      margin-top:10px;margin-bottom:5px;margin-right:15px;">
         GLVAR
      </div>
      @foreach($glvarAgents->sortBy('AgentStatus') as $the)
         <div class="white-hover" style="padding:0 15px;">
            <div style="float:left;width:100px;white-space: nowrap;overflow: hidden;
            text-overflow: ellipsis;margin-right:15px;">
               {{$the->AgentStatus}}
            </div>
            <div style="float:left;width:200px;">
               {{$the->FirstName}} {{$the->LastName}}
            </div>
            <div style="float:left;">
               <a href="/admin/roster/adreAgentResult?LicNumber={{$the->LicNumber}}"
               style="color:#fff;">
                  {{$the->LicenseNumber}}
               </a>
            </div>
            <div style="clear:both;">
            </div>
         </div>
      @endforeach
   @endif
</div>