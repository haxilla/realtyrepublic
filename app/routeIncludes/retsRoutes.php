<?php

// ** RETS **//
//retsController
   //index
   /*
   Route::get('/rets',[
      'as'=>'rets.index',
      'uses' => 'rets\retsController@index']);
      */
   //addRets
   Route::post('/rets/retsAdd',[
      'as'=>'rets.retsAdd',
      'uses' => 'rets\retsController@retsAdd']);
   //retsDelete
   Route::post('/rets/retsDelete',[
      'as'=>'rets.retsDelete',
      'uses' => 'rets\retsController@retsDelete']);
   //retsDisplay
   Route::get('/rets/retsDisplay',[
      'as'=>'rets.retsDisplay',
      'uses' => 'rets\retsController@retsDisplay']);

//retsSynchController
   //retsCompare
   Route::get('/rets/retsCompare',[
      'as'=>'rets.retsCompare',
      'uses' => 'rets\retsSynchController@retsCompare']);
   //retsSynch
   Route::get('/rets/retsSynch',[
      'as'=>'rets.retsSynch',
      'uses' => 'rets\retsSynchController@retsSynch']);
   //retsProgress
   Route::get('/rets/retsProgress',[
      'as'=>'rets.retsProgress',
      'uses' => 'rets\retsSynchController@retsProgress']);
   //retsOverlay
   Route::get('/rets/retsOverlay',[
      'as'=>'rets.retsOverlay',
      'uses' => 'rets\retsSynchController@retsOverlay']);

   //crontest
   Route::get('/cron/crontest',[
      'as'=>'cron.crontest',
      'uses' => 'cron\cronController@crontest']);
