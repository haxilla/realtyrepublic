<?php

//autoSynchController
  //agtPswdFix
  Route::get('/synch/agtPswdFix',[
    'as'    => 'synch.agtPswdFix',
    'uses'  => 'admin\autoSynchController@agtPswdFix']);
  //sk1Fix
  Route::get('/synch/sk1Fix',[
     'as'    => 'synch.sk1Fix',
     'uses'  => 'admin\autoSynchController@sk1Fix']);
