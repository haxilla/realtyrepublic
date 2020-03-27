@extends('layouts.simple')

@section('theHeader')
  @include('mdbxPublic.headersFooters.pubHeader')
@endsection

@section('pubNav')
  @include('mdbxPublic.navigation.pubNavTopWhite')
@endsection

@section('simpleContent')
  <div class="row" style="padding-top:100px;">
    <div class="col-12">
      @include('mdbxPublic.includes.elements.slides.slideSearch')
    </div>
  </div>
@endsection

@section('simpleContent2')
   <div class="row">
      <div class="col-12">
        @include('mainInclude.errorsAndMessages')
        @include('mdbxPublic.includes.elements.slides.slideshowlist')
      </div>
   </div>
@endsection

@section('pubScripts')
   @include('mdbxPublic.scripts.pubScripts')
@endsection
