<?php
//member routes
//memberLoginFormController
  //loginform
  Route::get('/loginForm',[
    'as' => 'member.loginForm',
    'uses' => 'member\memberLoginFormController@loginForm']);
  //navbarLogin (ajax)
  Route::post('/member/navbarLogin',[
    'as' => 'member.navbarLogin',
    'uses' => 'member\memberLoginFormController@navbarLogin']);
  //loginSubmit
  Route::post('/member/loginSubmit',[
    'as' => 'member.loginSubmit',
    'uses' => 'member\memberLoginFormController@loginSubmit']);
  //ajaxLoginSubmit
  Route::post('/member/ajaxLoginSubmit',[
    'as' => 'member.ajaxLoginSubmit',
    'uses' => 'member\memberLoginFormController@ajaxLoginSubmit']);

//memberIndexController
  //login
  Route::any('/login',[
    'as' => 'login',
    'uses' => 'member\memberIndexController@memberIndex']);
  //dashboard
  Route::get('/member/dashboard',[
    'as' => 'member.dashboard',
    'uses' => 'member\memberIndexController@memberDashboard']);
  //logout
  Route::get('/member/logout',[
    'as' => 'member.logout',
    'uses' => 'member\memberIndexController@memberLogout']);

//passwordResetController **
  //formSubmit
  Route::post('/member/passwordRequest',[
    'as'    => 'member.passwordRequestSubmit',
    'uses'  => 'member\passwordRequestController@formSubmit']);
  //link clicked
  Route::get('/member/passwordRequestLink',[
    'as'    => 'member.passwordRequestLink',
    'uses'  => 'member\passwordRequestController@linkClick']);

//passwordChangeController
  //passwordChangeForm
  Route::get('/member/passwordChange',[
    'as'    => 'member.passwordChangeForm',
    'uses'  => 'member\passwordChangeController@passwordChangeForm']);
  Route::post('/member/passwordChange',[
    'as'    => 'member.passwordChangeSubmit',
    'uses'  => 'member\passwordChangeController@passwordChangeSubmit']);

//member overlayController
    //memberNav
    Route::get('/member/nav',[
      'as'    => 'member.nav',
      'uses'  => 'member\overlayController@memberNav']);

//member searchController
  //searchController
  Route::post('/member/flyerNavSearch',[
    'as'    => 'member.flyerNavSearch',
    'uses'  => 'member\searchController@flyerNavSearch']);

//profileController
  //profileUpload
  Route::post('/member/profileUpload',[
    'as'    => 'member.profileUpload',
    'uses'  => 'member\profileController@profileUpload']);
