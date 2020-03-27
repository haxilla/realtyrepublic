<?php

//paypalOrderReviewController
   //orderReview
   Route::get('/mdbxMember/paypalOrderReview',[
      'as' => 'member.paypalOrderReview',
      'uses' => 'mdbxMember\paypalOrderReviewController@show']);

//mdbxAccountController
   //show
   Route::get('/mdbxMember/accountInfo',[
      'as'=>'member.accountInfo',
      'uses' => 'mdbxMember\mdbxAccountController@show']);

//mdbxSearch AutoSuggest
   /*
Route::get('/mdbx/autocomplete',['as' => 'mdbxAutoComplete',
   'uses' => 'autoCompleteController@autoComplete']);
   */

//mdbxSearch AutoSuggest
Route::get('/mdbxMember/flyerSearchAutoComplete',[
   'as'     => 'member.flyerSearchAutoComplete',
   'uses'   => 'mdbxMember\mdbxMemberAutoCompleteController@memberFlyerSearch']);

//memberProfileController
   //ADD
   //addAgentPhoto
   Route::post('/member/addAgentPhoto',[
      'as'=>'member.addAgentPhoto',
      'uses' => 'member\memberProfileController@addAgentPhoto']);
   //addAgentLogo
   Route::post('/member/addAgentLogo',[
      'as'=>'member.addAgentLogo',
      'uses' => 'member\memberProfileController@addAgentLogo']);

   //DELETE
   //deleteAgentPhoto
   Route::get('/member/deleteAgentPhoto',[
      'as'=>'member.deleteAgentPhoto',
      'uses' => 'member\memberProfileController@deleteAgentPhoto']);
   //deleteAgentLogo
   Route::get('/member/deleteAgentLogo',[
      'as'=>'member.deleteAgentLogo',
      'uses' => 'member\memberProfileController@deleteAgentLogo']);

   //UPDATE
   //updateProfile
   Route::post('/member/updateProfile',[
      'as'=>'member.updateProfile',
      'uses' => 'member\memberProfileController@updateProfile']);

//mdbxAgtProfilePhotoLogoController
   //changeAgtPhotoPost
   Route::post('/mdbxMember/changeAgtPhotoPost',[
      'as'=>'member.changeAgtPhotoPost',
      'uses' => 'mdbxMember\mdbxAgtProfilePhotoLogoController@changeAgtPhotoPost']);
      //changeAgtPhotoPost
   Route::post('/mdbxMember/changeAgtLogoPost',[
      'as'=>'member.changeAgtLogoPost',
      'uses' => 'mdbxMember\mdbxAgtProfilePhotoLogoController@changeAgtLogoPost']);
   //deleteAgtPhoto
   Route::get('/mdbxMember/deleteAgtPhoto',[
      'as'=>'member.deleteAgtPhoto',
      'uses' => 'mdbxMember\mdbxAgtProfilePhotoLogoController@deleteAgtPhoto']);
   //deleteAgtLogo
   Route::get('/mdbxMember/deleteAgtLogo',[
      'as'=>'member.deleteAgtLogo',
      'uses' => 'mdbxMember\mdbxAgtProfilePhotoLogoController@deleteAgtLogo']);

//memberNewFlyerController
   //postNewMLS
   Route::post('/mdbxMember/postNewMLS',[
      'as'=>'member.postNewMLS',
      'uses' => 'mdbxMember\memberNewFlyerController@postNewMLS']);
   //create
   Route::any('/mdbxMember/createNewFlyer',[
      'as' => 'member.createNewFlyer',
      'uses' => 'mdbxMember\memberNewFlyerController@createNewFlyer']);
   //mdbxFlyerStarter
   Route::get('/mdbxMember/flyerStarter',[
      'as' => 'member.flyerStarter',
      'uses' => 'mdbxMember\memberNewFlyerController@flyerStarter']);

//memberNewFlyerAjaxController
   //ajaxSaveStep
   Route::post('/mdbxMember/ajaxSaveStep',[
      'as' => 'member.ajaxSaveStep',
      'uses' => 'mdbxMember\memberNewFlyerAjaxController@ajaxSaveStep']);
   Route::post('/mdbxMember/ajaxSaveMls',[
      'as' => 'member.ajaxSaveMls',
      'uses' => 'mdbxMember\memberNewFlyerAjaxController@ajaxSaveMls']);

//dropZoneNewPhotoController
   //mdbxUpload
   Route::post('/mdbxMember/newPhotoUpload',[
      'as' => 'member.newPhotoUpload',
      'uses' => 'mdbxMember\newPhotoController@newPhotoUpload']);

//mdbxFlyerBranch
   //flyerBranch
   Route::get('/mdbxMember/flyerBranch',[
      'as' => 'member.flyerBranch',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@show']);
   //print
   Route::get('/mdbxMember/flyerPrint',[
      'as' => 'member.flyerPrint',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@print']);
   //share
   Route::get('/mdbxMember/flyerShare',[
      'as' => 'member.flyerShare',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@share']);
   //edit
   Route::get('/mdbxMember/flyerEdit',[
      'as' => 'member.flyerEdit',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@edit']);
   //launch
   Route::get('/mdbxMember/campaignLaunch', [
      'as' => 'member.launchCampaign',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@launch']);
   //Delete Flyer
   Route::get('/mdbxMember/flyerBranch/delete', [
      'as' => 'member.flyerBranchDelete',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@delete']);
   //Delete Campaign
   Route::get('/mdbxMember/flyerBranch/deleteCamp', [
      'as' => 'member.flyerBranchDeleteCamp',
      'uses' => 'mdbxMember\mdbxFlyerBranchController@deleteCamp']);

//mdbxEditController
   //editFlyerDetails
   Route::get('/mdbxMember/editFlyerDetails',[
      'as' => 'member.editFlyerDetails',
      'uses' => 'mdbxMember\mdbxEditController@editFlyerDetails']);
   //editAgentDetails
   Route::get('/mdbxMember/editAgentDetails',[
      'as' => 'member.editAgentDetails',
      'uses' => 'mdbxMember\mdbxEditController@editAgentDetails']);
   //editFlyerLinks
   Route::get('/mdbxMember/editFlyerLinks',[
      'as' => 'member.editFlyerLinks',
      'uses' => 'mdbxMember\mdbxEditController@editFlyerLinks']);
   //flyerDetailsPost
   Route::post('/mdbxMember/flyerDetailsPost',[
      'as' => 'member.flyerDetailsPost',
      'uses' => 'mdbxMember\mdbxEditController@flyerDetailsPost']);
   //agentDetailsPost
   Route::post('/mdbxMember/agentDetailsPost',[
      'as' => 'member.agentDetailsPost',
      'uses' => 'mdbxMember\mdbxEditController@agentDetailsPost']);

//colorChoices
   Route::get('/mdbxMember/colorChoice/{id}/{section}/{color}',[
      'as'=>'member.colorChoice',
      'uses' =>'mdbxMember\colorsController@store']);

//mdbxAjaxController
   //Save Template
   //click submissions
   Route::get('/mdbxMember/chooseFlyerStyle', [
      'as' => 'member.chooseFlyerStyle',
      'uses' => 'mdbxMember\mdbxAjaxController@chooseFlyerStyle']);
   //Save Template
   Route::get('/mdbxMember/chooseFlyerHeadline', [
      'as' => 'member.chooseFlyerHeadline',
      'uses' => 'mdbxMember\mdbxAjaxController@chooseFlyerHeadline']);
   //Save Template
   Route::get('/mdbxMember/chooseFlyerColor', [
      'as' => 'member.chooseFlyerColor',
      'uses' => 'mdbxMember\mdbxAjaxController@chooseFlyerColor']);
   //Save Virtual Tour
   Route::post('/mdbxMember/chooseVirtualTour', [
      'as' => 'member.chooseVirtualTour',
      'uses' => 'mdbxMember\mdbxAjaxController@chooseVirtualTour']);
   //Save MLS Link
   Route::post('/mdbxMember/chooseMlsLink', [
      'as' => 'member.chooseMlsLink',
      'uses' => 'mdbxMember\mdbxAjaxController@chooseMlsLink']);
   //autoSaves
   //Save Headline
   Route::post('/mdbxMember/autoSaveHeadline', [
      'as' => 'member.autoSaveHeadline',
      'uses' => 'mdbxMember\mdbxAjaxController@autoSaveHeadline']);
   //Save Captions
   Route::post('/mdbxMember/hlCaption', [
      'as' => 'member.HLCaption',
      'uses' => 'mdbxMember\mdbxAjaxController@mdbxHLCaption']);
   //ajaxSaveMls
   Route::post('/mdbxMember/autoSaveMls', [
      'as' => 'member.autoSaveMls',
      'uses' => 'mdbxMember\mdbxAjaxController@autoSaveMLS']);

//mdbxFlyerPhotoController
   //photoFunctions
   Route::get('/mdbxMember/photoFunctions', [
      'as'     => 'member.photoFunctions',
      'uses'   => 'mdbxMember\mdbxFlyerPhotoController@photoFunctions']);
   //flyerPhotoSortOrder
   Route::post('/mdbxMember/flyerPhotoSortOrder', [
      'as'     => 'member.flyerPhotoSortOrder',
      'uses'   => 'mdbxMember\mdbxFlyerPhotoController@flyerPhotoSortOrder']);
   //addFlyerPhotos
   Route::post('/mdbxMember/addFlyerPhotos', [
      'as'     => 'member.addFlyerPhotos',
      'uses'   => 'mdbxMember\mdbxFlyerPhotoController@addFlyerPhotos']);
   //resizeFlyerPhotos
   Route::get('/mdbxMember/resizeFlyerPhotos', [
      'as'     => 'member.resizeFlyerPhotos',
      'uses'   => 'mdbxMember\mdbxFlyerPhotoController@resizeFlyerPhotos']);
   //deleteFlyerPhoto
   Route::get('/mdbxMember/deleteFlyerPhoto', [
      'as'     => 'member.deleteFlyerPhoto',
      'uses'   => 'mdbxMember\mdbxFlyerPhotoController@deleteFlyerPhoto']);

//memberEmailFlyerCopy
   Route::post('/mdbxMember/emailFlyerCopy', [
      'as'     => 'member.emailFlyerCopy',
      'uses'   => 'mdbxMember\memberSendEmailController@emailFlyerCopy']);

//mdbxPostCampaign
   Route::post('/mdbx/mdbxPostCampaign',['as' => 'mdbxPostCampaign',
      'uses' => 'mdbxMember\mdbxCampaignController@post']);

//mdbxMemberPurchase
   Route::get('/mdbxMember/mdbxPurchase', [
      'as'     => 'member.mdbxPurchase',
      'uses'   => 'mdbxMember\mdbxMemberPurchaseController@purchaseOptions']);



