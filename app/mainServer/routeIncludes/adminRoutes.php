<?php

//adminClickSynchController
   //progress
   Route::get('/synch/agtPswdFix',[
      'as'    => 'synch.agtPswdFix',
      'uses'  => 'admin\autoSynchController@agtPswdFix']);
