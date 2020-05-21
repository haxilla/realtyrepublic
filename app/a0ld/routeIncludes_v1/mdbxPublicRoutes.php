<?php
//mdbxPublicLoginController

  //OverlayController
    //publicAgentInfo
    Route::get('/agentWall',[
      'as'     => 'public.agentWall',
      'uses'   => 'thePublic\overlayController@agentWall']);
    Route::get('/joinNow',[
      'as'     => 'public.joinNow',
      'uses'   => 'thePublic\overlayController@joinNow']);
    Route::get('/emailUs',[
      'as'     => 'public.joinNow',
      'uses'   => 'thePublic\overlayController@emailUs']);
    Route::get('/pubSubscribe',[
      'as'     => 'public.pubSubscribe',
      'uses'   => 'thePublic\overlayController@pubSubscribe']);
    Route::get('/privacyPolicy',[
      'as'     => 'public.privacyPolicy',
      'uses'   => 'thePublic\overlayController@privacyPolicy']);

   //member login ** do not delete **
   Route::get('/login', [
      'as'     => 'login',
      'uses'   => 'mdbxPublic\mdbxPublicLoginController@login']);
   //member login
   Route::any('/member/login', [
      'as'     => 'member.login',
      'uses'   => 'mdbxPublic\mdbxPublicLoginController@login']);
      //login
   Route::get('/member/logout', [
      'as'     => 'member.logout',
      'uses'   => 'mdbxPublic\mdbxPublicLoginController@logout']);

//publicEmailAgentController
   //emailAgentPost
   Route::post('/emailAgentPost',[
      'as'     => 'public.emailAgentPost',
      'uses'   => 'mdbxPublic\publicEmailAgentController@emailAgentPost']);
   Route::get('/emailAgentForm',[
      'as'     => 'public.emailAgentForm',
      'uses'   => 'mdbxPublic\publicEmailAgentController@emailAgentForm']);
   Route::post('/postEmailAgentModal',[
      'as'     => 'public.postEmailAgentModal',
      'uses'   => 'mdbxPublic\publicEmailAgentController@postEmailAgentModal']);

//searchController
   Route::post('/flyerSearch',[
      'as'     => 'public.flyerSearch',
      'uses'   => 'mdbxPublic\searchController@flyerSearch']);
   Route::post('/featureSearch',[
      'as'     => 'public.featureSearch',
      'uses'   => 'mdbxPublic\searchController@featureSearch']);

//indexController
   //index
   Route::get('/', [
      'as'=>'public.index',
      'uses'=>'thePublic\indexController@index']);
   //propInfo
   Route::get('/propInfo', [
      'as'=>'public.propInfo',
      'uses' => 'mdbxPublic\mdbxPropFlyerController@propInfo']);
   //moreInfo
   Route::get('/moreInfo', [
      'as'=>'public.moreInfo',
      'uses' => 'mdbxPublic\mdbxPropFlyerController@moreInfo']);
   //faq
   Route::get('/faq', [
      'as'=>'public.faq',
      'uses' => 'mdbxPublic\mdbxPropFlyerController@faq']);

   //contactUsBanner
   Route::post('/contactUsPost', [
      'as'=>'public.contactUsPost',
      'uses' => 'mdbxPublic\mdbxPropFlyerController@contactUsPost']);

   //propprint
   Route::get('/propPrint', [
      'as'=>'public.propPrint',
      'uses' => 'mdbxPublic\mdbxPropFlyerController@propPrint']);
   //propSlides
   Route::get('/slides', [
      'as'=>'public.propSlides',
      'uses' => 'mdbxPublic\mdbxPropFlyerController@propSlides']);

//mdbxPaypalIPNcontroller
   //paypal IPN dont change route without changing middleware
   //its set up in middleware to exclude csrf check
   Route::any('/mdbx/paypalIPN',[
      'as'=>'public.paypalIPN',
      'uses' => 'mdbxPublic\mdbxPaypalIPNcontroller@ipnListen']);
//mdbxPaypalReturnController
   //success
   Route::any('/mdbx/paypalSuccess',[
      'as'=>'public.paypalSuccess',
      'uses' => 'mdbxPublic\mdbxPaypalReturnController@success']);

//passwordController
   //passwordRequest Post
   Route::post('/passwordRequest',[
      'as'=>'public.passwordRequest',
      'uses' => 'thePublic\passwordController@passwordRequest']);
   //passwordResetLink
   Route::get('/passwordResetLink',[
      'as'=>'public.passwordResetLink',
      'uses' => 'thePublic\passwordController@passwordResetLink']);
   //passwordResetLink
   Route::get('/passwordResetForm',[
      'as'=>'public.passwordResetForm',
      'uses' => 'thePublic\passwordController@passwordResetForm']);
   //passwordChange Post
   Route::post('/passwordChange',[
      'as'=>'public.passwordChange',
      'uses' => 'thePublic\passwordController@passwordChange']);

//mdbxCreditsController
   //newPurchase
   Route::post('/mdbx/mdbxNewPurchase',[
      'as'=>'public.mdbxNewPurchase',
      'uses' => 'mdbxPublic\mdbxCreditsController@mdbxNewPurchase']);
   //newPurchaseConfirm
   Route::get('/mdbx/newPurchaseConfirm',[
      'as'=>'public.newPurchaseConfirm',
      'uses' => 'mdbxPublic\mdbxCreditsController@mdbxPurchaseConfirm']);

//mdbxTrialRequestController
   //show
   Route::get('/mdbx/newTrialRequest',[
      'as'=>'public.newTrialRequest',
      'uses' => 'mdbxPublic\mdbxTrialRequestController@show']);
   //Post
   Route::post('/mdbx/newTrialRequestPost',[
      'as'=>'public.newTrialRequestPost',
      'uses' => 'mdbxPublic\mdbxTrialRequestController@post']);
   //EmailConfirm
   Route::get('/mdbx/trialRequestEmailConfirm',[
      'as'=>'public.trialRequestEmailConfirm',
      'uses' => 'mdbxPublic\mdbxTrialRequestController@trialRequestEmailConfirm']);
   //pendingTrialAddress
   Route::post('/pendingTrialAddress',[
      'as'=>'public.pendingTrialAddress',
      'uses' => 'mdbxPublic\mdbxTrialRequestController@pendingTrialAddress']);

//trialAccountController
   //trialCheck
   Route::post('/trialAccount',[
      'as'=>'public.trialAccountPost',
      'uses' => 'mdbxPublic\mdbxTrialCheckController@trialCheck']);
   Route::post('/importableTrialCheck',[
      'as'=>'public.importableTrialCheck',
      'uses' => 'mdbxPublic\mdbxTrialCheckController@importableTrialCheck']);
   Route::get('/startImport',[
      'as'=>'public.startImport',
      'uses' => 'mdbxPublic\mdbxTrialCheckController@startImport']);

//flyertrackController
   //pubPhotos
   Route::get('/pubShowAllPhotos',[
      'as'=>'public.pubShowAllPhotos',
      'uses' => 'mdbxPublic\flyertrackController@pubShowAllPhotos']);
   //pubMlsLink
   Route::get('/pubMlsLink',[
      'as'=>'public.pubMlsLink',
      'uses' => 'mdbxPublic\flyertrackController@pubMlsLink']);
   //pubVtour
   Route::get('/pubVtour',[
      'as'=>'public.pubVtour',
      'uses' => 'mdbxPublic\flyertrackController@pubVtour']);
   //pubMoreInfo
   Route::get('/pubMoreInfo',[
      'as'=>'public.pubMoreInfo',
      'uses' => 'mdbxPublic\flyertrackController@pubMoreInfo']);
   //pubEmailMe
   Route::get('/pubEmailMe',[
      'as'=>'public.pubEmailMe',
      'uses' => 'mdbxPublic\flyertrackController@pubEmailMe']);
   //pubShowPhoto
   Route::get('/pubShowThePhoto',[
      'as'=>'public.pubShowThePhoto',
      'uses' => 'mdbxPublic\flyertrackController@pubShowThePhoto']);
