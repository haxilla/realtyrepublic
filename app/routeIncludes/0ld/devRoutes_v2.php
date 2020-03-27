<?php

//devTaskController
   //tasks
   Route::get('/dev/index',[
      'as'=>'dev.index',
      'uses' => 'dev\taskController@index']);
   Route::post('/dev/taskAjax',[
      'as'=>'dev.index',
      'uses' => 'dev\taskController@taskAjax']);
   Route::get('/dev/taskFlag',[
      'as'=>'dev.index',
      'uses' => 'dev\taskController@taskFlag']);

//devCommentController
   //comments
   Route::post('/dev/commentAjax',[
      'as'=>'dev.commentAjax',
      'uses' => 'dev\commentController@commentAjax']);
   //flag comment
   Route::get('/dev/commentFlag',[
      'as'=>'dev.commentFlag',
      'uses' => 'dev\commentController@commentFlag']);


//devTaskController
   //taskComplete
   Route::get('/dev/taskComplete',[
      'as'=>'dev.taskComplete',
      'uses' => 'mdbxDev\mdbxDevTaskController@taskComplete']);
   //markTip
   Route::get('/dev/markTip',[
      'as'=>'dev.markTip',
      'uses' => 'mdbxDev\mdbxDevTaskController@markTip']);
   //makeExcuse
   Route::get('/dev/makeExcuse',[
      'as'=>'dev.makeExcuse',
      'uses' => 'mdbxDev\mdbxDevTaskController@makeExcuse']);
   //taskDelete
   Route::get('/dev/taskDelete',[
      'as'=>'dev.taskDelete',
      'uses' => 'mdbxDev\mdbxDevTaskController@taskDelete']);
   //taskComment
   Route::post('/dev/taskCommentPost',[
      'as'=>'dev.taskDelete',
      'uses' => 'mdbxDev\mdbxDevTaskController@taskCommentPost']);
   //deleteTaskComment
   Route::get('/dev/deleteTaskComment',[
      'as'=>'dev.deleteTaskComment',
      'uses' => 'mdbxDev\mdbxDevTaskController@deleteTaskComment']);

//autosuggest
Route::get('/dev/devAutoComplete',
   ['as' => 'dev.autoComplete',
      'uses' => 'mdbxDev\mdbxDevAutoCompleteController@autoComplete']);

//autoSaveController
   //autoSaveTask
   Route::post('/dev/autoSaveTask',[
      'as'=>'dev.deleteTaskComment',
      'uses' => 'mdbxDev\mdbxDevAutoSaveController@autoSaveTask']);
   //autoSaveComment
   Route::post('/dev/autoSaveComment',[
      'as'=>'dev.deleteTaskComment',
      'uses' => 'mdbxDev\mdbxDevAutoSaveController@autoSaveComment']);
   //autoSaveTaskType
   Route::post('/dev/autoSaveTaskType',[
      'as'=>'dev.autoSaveTaskType',
      'uses' => 'mdbxDev\mdbxDevAutoSaveController@autoSaveTaskType']);
   //autoSaveWizard
   Route::post('/dev/autoSaveWizard',[
      'as'=>'dev.autoSaveWizard',
      'uses' => 'mdbxDev\mdbxDevAutoSaveController@autoSaveWizard']);
   //autoSavePriority
   Route::get('/dev/autoSavePriority',[
      'as'=>'dev.autoSavePriority',
      'uses' => 'mdbxDev\mdbxDevAutoSaveController@autoSavePriority']);

//Git Functions
   //gitPUSH
   Route::get('/dev/markGitPush',[
      'as'=>'markGitPush',
      'uses' => 'mdbxDev\mdbxDevGitController@markGitPush']);
   //gitPULL
   Route::get('/dev/markGitPull',[
      'as'=>'markGitPull',
      'uses' => 'mdbxDev\mdbxDevGitController@markGitPull']);
