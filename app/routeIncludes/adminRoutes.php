<?php

//below is example of laravel way to group routes by prefix
//and avoid redundancy - also shows how to keep controller in diff folder
Route::prefix('admin')->group(function() {
   Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.loginForm');
   Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
   Route::get('/', 'admin\adminIndexController@adminIndex')->name('admin.index');
   Route::get('/logout','admin\adminIndexController@logout')->name('admin.logout');
});

//autoSynchController
  //agtPswdFix
  Route::get('/synch/agtPswdFix',[
    'as'    => 'synch.agtPswdFix',
    'uses'  => 'admin\autoSynchController@agtPswdFix']);
  //sk1Fix
  Route::get('/synch/sk1Fix',[
     'as'    => 'synch.sk1Fix',
     'uses'  => 'admin\autoSynchController@sk1Fix']);

//logs
Route::get('logs', '\Melihovv\LaravelLogViewer\LaravelLogViewerController@index');

//adminProfile
   Route::post('/admin/profileUpdate',[
      'as'=>'admin.profileUpdate',
      'uses' => 'admin\adminProfileController@profileUpdate']);
   Route::post('/admin/addProfilePhoto',[
      'as'=>'admin.addProfilePhoto',
      'uses' => 'admin\adminProfileController@addProfilePhoto']);
   Route::get('/admin/deleteProfilePhoto',[
      'as'=>'admin.deleteProfilePhoto',
      'uses' => 'admin\adminProfileController@deleteProfilePhoto']);

//adminAjaxFlyerEdit
   Route::post('/admin/ajaxFlyerEdit',[
      'as'=>'admin.ajaxFlyerEdit',
      'uses' => 'admin\adminAjaxFlyerEditController@formPost']);

//adminAutoSuggestController
   Route::get('/admin/autoSuggest',[
      'as'=>'admin.autoSuggest',
      'uses' => 'admin\adminAutoSuggestController@search']);

//adreController
   //index
   Route::get('/admin/adre',[
      'as'=>'admin.adre',
      'uses' => 'adre\adreController@index']);
   //new file upload
   Route::post('/admin/adre/fileUpload',[
      'as'=>'admin.adre.fileUpload',
      'uses' => 'adre\adreController@fileUpload']);
   //new file upload
   Route::post('/admin/adre/fileUpload',[
      'as'=>'admin.adre.fileUpload',
      'uses' => 'adre\adreController@fileUpload']);
   //puppeteer
   Route::get('/admin/adre/puppeteer',[
      'as'=>'admin.adre.puppeteer',
      'uses' => 'adre\adreController@puppeteer']);


//overlayController
   Route::get('/admin/populateOverlay',[
      'as'=>'admin.populateOverlay',
      'uses' => 'admin\adminOverlayController@index']);

//adminClickSynchController
   //progress
   Route::get('/synch/synchProgress',[
      'as'    => 'synch.progress',
      'uses'  => 'admin\autoSynchController@synchProgress']);
   //Agent - synchStart
   Route::get('/synch/synchStart',[
      'as'    => 'synch.synchStart',
      'uses'  => 'admin\autoSynchController@synchStart']);
   //Agent - synchStart
   Route::get('/synch/synchDownloads',[
      'as'    => 'synch.synchDownloads',
      'uses'  => 'admin\autoSynchController@synchDownloads']);

//bounceController
   //bounce auto
   //aka bounceIndex
   Route::get('/admin/bounceAuto',[
      'as'    => 'admin.bounceAuto',
      'uses'  => 'admin\bounceController@bounceAuto']);
   //bounceIndex Display
   Route::get('/admin/bounceIndexDisplay',[
      'as'    => 'admin.bounceIndexDisplay',
      'uses'  => 'admin\bounceController@bounceIndexDisplay']);
      //bounce delete
   Route::get('/admin/bounceDelete',[
      'as'    => 'admin.bounceDelete',
      'uses'  => 'admin\bounceController@bounceDelete']);

//bounceReviewController
  //bounce review
  Route::get('/admin/bounceReviewIndex',[
    'as'    => 'admin.bounceReviewIndex',
    'uses'  => 'admin\bounceReviewController@index']);

  //bounce review
  Route::get('/admin/bounceReviewDisplay',[
    'as'    => 'admin.bounceReviewDisplay',
    'uses'  => 'admin\bounceReviewController@display']);
