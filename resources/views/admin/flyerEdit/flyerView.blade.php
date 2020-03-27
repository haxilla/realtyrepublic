@extends('layouts.mdbxAdminLayout2')

@section('mdbxBasicHeader')
  @include('mdbxAdmin.headersFooters.basicAdminHeader')
  <link rel="stylesheet" type="text/css" href="/mycss/flyers/flyerPreviews.css">
  <link rel="stylesheet" type="text/css" href="/mycss/flyers/styles1pc.css">
  <link rel="stylesheet" type="text/css" href="/mycss/flyers/styles2pb.css">
  <link rel="stylesheet" type="text/css" href="/mycss/flyers/styles3pt.css">
  <link rel="stylesheet" type="text/css" href="/mycss/flyers/styles4sp.css">
  <link rel="stylesheet" type="text/css" href="/mycss/flyers/styles5pt.css">
@endsection

@section('navigation')
    @include('mdbxAdmin.navigation.adminTopNav')
    @include('mdbxAdmin.modals.adminConfirmCampDelete')
@endsection

@section('mainSection')
  <section class="intro-2 rgba-gradient">
    <input type="hidden" name="theID2" value="{{$id}}">
    <div class="full-bg-img text-white"
    style="padding-top:75px;">
        <div class="row m-0 p-0">
            <div class="col-xl-8">
              <div style="background-color:rgba(0,0,0,.2);border:1px solid #999;">
                <div class="row m-0 p-0">
                  <div class="col-xl-6 col-lg-7 col-md-12 col-sm-12 col-12">
                    <div style="max-width:600px;">
                      <div class="adminEditMenu adminEditStyleMenu">
                        <div style="background-color:#fff;color:#0e4749;">
                          @include('mdbxAdmin.editMenus.editStyleTopNav')
                        </div>
                      </div>
                      <div class="adminEditMenu adminEditHeadlineMenu">
                        @include('mdbxAdmin.editMenus.editHeadlineTopNav')
                      </div>
                      <div class="adminEditMenu adminEditColorsMenu">
                        <div style="background-color:#fff;">
                          @include('mdbxAdmin.editMenus.editColorsTopNav')
                        </div>
                      </div>
                    </div>

                    <!-- editing menu -->
                    <div class="adminFlyerEditMenusDiv">
                      <div class="adminSelectMenu" style="float:left;">
                        <select class="browser-default adminFlyerEdit px-2"
                        style="padding:10px;border-radius:5px;">
                          <option value="theAddress">{{$theAddress}}</option>
                          <option>Style</option>
                          <option>Headline</option>
                          <option>Colors</option>
                          <option>Details</option>
                          <option>Agent</option>
                        </select>
                      </div>
                      <div class="adminSelectMenu" style="float:right;">
                        <a target="_blank"
                        href="/admin/loginAsAgent?umid={{$umid}}&id={{$id}}"
                        class="btn btn-grey btn-sm">
                          Login As Agent
                        </a>
                      </div>
                      <div style="clear:both;">
                      </div>
                    </div>
                    <div class="mainFlyerPane">
                      <!-- flyer templates -->
                      <div class="styleDefault styleDiv">
                        @if($theTemplate=='1pc'||$theTemplate=='s1pc')
                          @include('mdbxFlyers.s1pc')
                        @elseif($theTemplate=='2pb'||$theTemplate=='s2pb')
                          @include('mdbxFlyers.s2pb')
                        @elseif($theTemplate=='3pt'||$theTemplate=='s3pt')
                          @include('mdbxFlyers.s3pt')
                        @elseif($theTemplate=='4sp'||$theTemplate=='s4sp')
                          @include('mdbxFlyers.s4sp')
                        @elseif($theTemplate=='5pt'||$theTemplate=='s5pt')
                          @include('mdbxFlyers.s5pt')
                        @endif
                      </div>
                      <div class="styleDiv" id="style1_div">
                        @include('mdbxFlyers.s1pc')
                      </div>
                      <div class="styleDiv" id="style2_div">
                        @include('mdbxFlyers.s2pb')
                      </div>
                      <div class="styleDiv" id="style3_div">
                        @include('mdbxFlyers.s3pt')
                      </div>
                      <div class="styleDiv" id="style4_div">
                        @include('mdbxFlyers.s4sp')
                      </div>
                      <div class="styleDiv" id="style5_div">
                        @include('mdbxFlyers.s5pt')
                      </div>
                      <!-- -->
                      <div class="adminFlyerEditDetails"
                      style="background-color:rgba(0,0,0,.5);padding:15px;">
                        <form method="post" action="/admin/editFlyerDetails?id=">
                          {{csrf_field()}}
                          @include('mdbxMember.includes.flyerEdit.flyerDetailsFormFields')
                        </form>
                      </div>
                    </div>
                    <!-- end of width 600 -->
                    <hr>
                  </div>
                  <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-12"
                  style="font-size:10pt;">

                    <form method="post" style="margin:0;padding:0;"
                    action="/admin/changeEmSubject?id=">
                      {{csrf_field()}}
                      <div class="row m-0 p-0">
                          <div class="col-xl-10 col-9" style="margin:0;
                          padding:15px;padding-left:0;">
                            <input type="text"
                            class="form-control"
                            name="emSubject"
                            value="">
                          </div>
                          <div class="col-xl-2 col-3"
                          style="padding:0;padding-top:15px;margin:0;">
                            <input type="submit" class="form-control">
                          </div>
                      </div>
                    </form>
                    @include('mainInclude.errorsAndMessages')
                    <!-- Current Campaigns -->
                    <div style="border:1px solid #fff;padding:15px;
                    background-color:rgba(0,0,0,.4);z-index:1000">
                      <div>
                        Current Campaigns
                      </div>
                      <hr>
                      <div>
                        @include('mdbxAdmin.campaigns.currentFlyerCamps')
                        <!-- Email Areas Add Form Div below -->
                        <div style="margin: 0 auto;text-align:center;padding-top:5px;">
                          <form style="margin:0;padding:0;"
                          method="post" action="/admin/addCampaignArea?propflyer_id=">
                            {{csrf_field()}}
                            <div style="display:inline-block;width:75%;">
                              <select class="browser-default form-control pt-0 pb-0"
                              name="campEmArea">
                                <option>Select</option>
                                <option>AzPhxMetro</option>
                                <option>AzPhxNE</option>
                                <option>AzPhxSE</option>
                                <option>AzPhxWV</option>
                                <option>AzNaz</option>
                                <option>AzSaz</option>
                                <option>GLVAR</option>
                              </select>
                            </div>
                            <div style="display:inline-block;width:20%;">
                              <input type="submit" class="form-control">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- if complete camps -->
                    <div style="border:1px solid #fff;padding:15px;
                    background-color:rgba(0,0,0,.4);z-index:1000;margin-top:15px;">
                      <div>
                        Completed Campaigns
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class="col-xl-4">
              <div>
                @include('mdbxAdmin.panels.memberMessages')
                <hr>
                @include('mdbxAdmin.panels.scheduleCounts')
                <hr>
                @include('mdbxDev.panels.journalCounts')
                <hr>
                @include('mdbxAdmin.panels.adminFunctions')
                <hr>
              </div>
            </div>
        </div>
    </div>
  </section>
@endsection

@section('coreScripts')
  @include('mdbxAdmin.headersFooters.adminCoreScripts')
  <script type="text/javascript" src="/myjs/mdbx/mdbxColorPreviews.js"></script>
  <script type="text/javascript" src="/myjs/admin/adminCreationPane.js"></script>
  <script type="text/javascript" src="/myjs/mdbx/mdbxThumbs.js"></script>
@endsection

</html>
