<?php

//taskController
   //index
   Route::get('/dev/index',[
      'as'=>'dev.index',
      'uses' => 'dev\taskController@index']);
   //task ajax functions
   Route::post('/dev/taskAjax',[
      'as'=>'dev.taskAjax',
      'uses' => 'dev\taskController@taskAjax']);
   //task ajax functions
   Route::get('/dev/taskResultLink',[
      'as'=>'dev.taskResultLink',
      'uses' => 'dev\taskController@taskResultLink']);

//commentController
   //comments
   Route::post('/dev/commentAjax',[
      'as'=>'dev.commentAjax',
      'uses' => 'dev\commentController@commentAjax']);
   //links
   Route::post('/dev/linkAjax',[
      'as'=>'dev.linkAjax',
      'uses' => 'dev\commentController@linkAjax']);
   //flag & unflag comment
   Route::get('/dev/commentFlag',[
      'as'=>'dev.commentFlag',
      'uses' => 'dev\commentController@commentFlag']);


//autosuggestController
   //search
   Route::get('/dev/autoSuggest',[
      'as'=>'dev.autoSuggest',
      'uses' => 'dev\autosuggestController@search']);


