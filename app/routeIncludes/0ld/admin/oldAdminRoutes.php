<?php
//admin synch old site
Route::get('/admin/synchOld',
   ['as'=>'synchOld', 'uses' => 'synchOldController@showSynch']);

//admin options
Route::post('/admin/adminAddAgentCheck',
   ['as'=>'adminAddAgentCheck', 'uses' => 'adminOptionController@addAgentCheck']);
Route::get('/admin/adminOptions',
   ['as'=>'adminOptions', 'uses' => 'adminOptionController@show']);
Route::get('/admin/addAgentReturn',
   ['as'=>'addAgentReturn', 'uses' => 'adminOptionController@return']);
Route::post('/admin/adminOptionsPost',
   ['as'=>'adminOptionsPost', 'uses' => 'adminOptionController@post']);
Route::post('/admin/adminAddAgentPost',
   ['as'=>'adminAddAgentPost', 'uses' => 'adminOptionController@addAgentPost']);
Route::post('/admin/addAdminPost',
   ['as'=>'addAdminPost', 'uses' => 'adminOptionController@addAdminPost']);
Route::post('/admin/adminProfilePost',
   ['as'=>'adminProfilePost', 'uses' => 'adminOptionController@adminProfilePost']);



//admin DevJournal
Route::post('/admin/changeVersion',
   ['as'=>'adminChangeVersion', 'uses' => 'devJournalController@versionChangePost']);
Route::get('/admin/devJournal',
   ['as'=>'devJournal', 'uses' => 'devJournalController@show']);
Route::post('/journal/taskPost',
   ['as'=>'newTaskPost', 'uses' => 'devJournalController@newTaskPost']);
Route::get('/journal/taskDelete',
   ['as'=>'taskDelete', 'uses' => 'taskFunctionController@delete']);
Route::get('/journal/taskComplete',
   ['as'=>'taskComplete', 'uses' => 'taskFunctionController@taskComplete']);
Route::get('/journal/markTip',
   ['as'=>'markTip', 'uses' => 'taskFunctionController@markTip']);
Route::get('/journal/makeExcuse',
   ['as'=>'makeExcuse', 'uses' => 'taskFunctionController@makeExcuse']);
Route::post('/journal/taskComment',
   ['as'=>'taskComment', 'uses' => 'taskFunctionController@taskComment']);


//change comment order on task
Route::get('/admin/commentSort',
   ['as'=>'adminCommentSort', 'uses' => 'devJournalController@adminCommentSort']);
//change comment order on task
Route::get('/admin/deleteTaskComment',
   ['as'=>'adminDeleteTaskComment', 'uses' => 'devJournalController@adminDeleteTaskComment']);


//admin showDevTask
Route::get('/admin/showDevTask',
   ['as' => 'adminShowDevTaks',
      'uses' => 'taskFunctionController@showDevTask']);

//admin
Route::get('/admin/admSendEmailForm/{id}', ['as' => 'adminSendCopy', 'uses' => 'adminEmailController@admSendEmailForm']);
Route::post('/admin/submitEmailCopy/{id}','adminEmailController@admSubmitEmailCopy');
Route::get('/aLogin/{umid}','adminMemberController@aLogin');
Route::get('/admin/schedule/{campType}','adminController@campaigns');
Route::get('/admin/adminShowFlyer/{id}',
   ['as'=>'adminShowFlyer', 'uses' => 'adminController@showFlyer']);
Route::get('/admin/admEditHeadline/{id}','adminController@admEditHeadline');
Route::get('/admin/admEditText/{id}','adminController@admEditText');
Route::get('/admin/admAddPhotos/{id}','adminController@admAddPhotos');
Route::get('/admin/admArrangePhotos/{id}','adminController@admArrangePhotos');
Route::get('/admin/admEditStyle/{id}','adminController@admEditStyle');
Route::get('/admin/admEditColors/{id}','adminController@admEditColors');
Route::get('/admin/admDontDisplayAgt/{id}','adminController@admDontDisplayAgt');
Route::get('/admin/admAuth/{id}','adminController@admAuth');
Route::get('/admin/admEditAgent/{id}/{idMem}','adminController@admEditAgent');
Route::get('/admin/searchResultAgent/{id}','adminController@searchResultAgent');
Route::get('/admin/authFlyer/{id}','adminController@authFlyer');
Route::get('/admin/unauthFlyer/{id}','adminController@unauthFlyer');
Route::get('/admin/authCamp/{cid}','adminController@authCamp');
Route::post('/admin/admEditEmSubject/{id}','adminController@admEditEmSubject');
Route::post('/admin/searchBox','adminController@searchBox');
Route::get('/admin/searchBox','adminController@searchBox');//for pagination
Route::post('/admin/admHeadlinePost/{id}','adminController@admHeadlinePost');

//adminTestCamp
Route::get('/addTestCamp/{cid}','adminCampController@addTestCamp');
Route::get('/admin/sendTestCamp/{cid}',
   ['as'=>'admSendTestCamp', 'uses' => 'adminCampController@sendTestCamp']);

//admin message center
Route::get('/admin/membermsg','adminMsgController@showMsg');
Route::get('/admin/msgApprove/{msgid}/{umid}/{id}','adminMsgController@approveMsg');

//admin Email Distribution Test List
Route::get('/admin/testEmails',
   ['as'=>'adminTestEmail', 'uses' => 'distributionTestController@showList']);
Route::post('/admin/postTestEmail','distributionTestController@postTestEmail');
Route::get('/admin/startTestList','distributionTestController@startTestList');
Route::get('/admin/distributionTest/{id}/{startRow}/{delay}/{amt}','distributionTestController@distributionTest');
//END OF ADMIN
