<?php

//devJournalController
   //main page
   Route::get('/dev/index',[
      'as'=>'dev.index',
      'uses' => 'dev\devJournalController@index']);
   //task post
   Route::post('/dev/newTaskPost',[
      'as'=>'dev.newTaskPost',
      'uses' => 'dev\devJournalController@newTaskPost']);
   //commentSort
   Route::get('/dev/commentSort',[
      'as'=>'dev.commentSort',
      'uses' => 'dev\devJournalController@taskCommentSort']);
   //unflag single comment
   Route::get('/dev/unflagComment',[
      'as'=>'dev.unflagComment',
      'uses' => 'dev\devJournalController@unflagComment']);
   //unflag single comment
   Route::get('/dev/unflagAll',[
      'as'=>'dev.unflagAll',
      'uses' => 'dev\devJournalController@unflagAll']);
   Route::post('/dev/versionChangePost',[
      'as'=>'dev.versionChangePost',
      'uses' => 'dev\devJournalController@versionChangePost']);

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
