@extends('layouts.propDetails')

@section('theHeader')
  @include('mdbxPublic.headersFooters.pubHeader')
  <meta property="og:description"   content="{{$getFlyer[0]->xFullStreet}}  / Listed by {{$getFlyer[0]->theAgent->agtName}}"/>
  <meta property="og:url"           content="{{$fbURL}}" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="@if($getFlyer[0]->xxBeds){{$getFlyer[0]->xxBeds}}@else{{$getFlyer[0]->xBeds}}@endif bed,
                                             @if($getFlyer[0]->xxBaths){{$getFlyer[0]->xxBaths}}@else{{$getFlyer[0]->xBaths}}@endif bath Home For Sale in
                                             {{$getFlyer[0]->xCity}} - ${{number_format($getFlyer[0]->xListPrice)}}"/>
  <meta property="og:image"         content="http://www.RealtyEmails.com/hqphotos/{{$getFlyer[0]->theMeta->zipDir}}/{{$getFlyer[0]
                                            ->theMeta->mlsDir}}/{{$getFlyer[0]->thePhotos->where('def','=','1')->first()->photoName}}" />
  <meta property="og:image:width" content="450"/>
  <meta property="og:image:height" content="298"/>
  <!--
    //for v3
    <script src='https://www.google.com/recaptcha/api.js?render=6LfM_IgUAAAAAFIqdvdrrwglLrKyAWtqkgjyLzoL'></script>
  -->
  <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('pubNav')
  @include('mdbxPublic.navigation.pubNavTopWhite')
@endsection

@section('addressControls')
  @include('mdbxPublic.includes.elements.propInfo.addressControlStack')
@endsection

@section('slideShow')
  <div style="padding:0 30px;">
    @if($getFlyer->first()->thePhotos->first()->orient=='tall'
    && $getFlyer->first()->thePhotos->count()==1)
        @include('mdbxPublic.includes.elements.propInfo.fotoramaTall')
    @else
        @include('mdbxPublic.includes.elements.propInfo.fotorama')
    @endif
  </div>
@endsection

@section('coreHomeDetails')
  @include('mdbxPublic.includes.elements.propInfo.coreHomeDetails')
@endsection

@section('propHighlights')
  @include('mdbxPublic.includes.elements.propInfo.propHighlights')
@endsection

@section('googleMap')
  @include('mdbxPublic.includes.elements.propInfo.googlemap')
@endsection

@section('pubScripts')
  @include('mdbxPublic.scripts.pubScripts')
  <script src="/fr/fotorama.js"></script>    
  <!---
  //for v3 recaptcha
  <script>
    grecaptcha.ready(function() {
       // do request for recaptcha token
       // response is promise with passed token
       grecaptcha.execute('6LfM_IgUAAAAAFIqdvdrrwglLrKyAWtqkgjyLzoL', {action: 'validate_captcha'})
       .then(function(token) {
          // Verify the token on the server.
          document.getElementById('g-recaptcha-response').value = token;
       });
    });
  </script>
  --->
@endsection
