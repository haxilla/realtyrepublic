<?php

//below is example of laravel way to group routes by prefix
//and avoid redundancy - also shows how to keep controller in diff folder
Route::prefix('admin')->group(function() {
   Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
   Route::get('/', 'admin\adminIndexController@adminIndex')->name('admin.index');
   Route::get('/logout','admin\adminIndexController@logout')->name('admin.logout');
});

//logs
Route::get('logs', '\Melihovv\LaravelLogViewer\LaravelLogViewerController@index');

//adminClickSynchController
   //progress
   Route::get('/synch/progress',[
      'as'    => 'synch.progress',
      'uses'  => 'admin\adminClickSynchController@synchProgress']);
   //Agent - synchStart
   Route::get('/admin/synchStart',[
      'as'    => 'admin.synchStart',
      'uses'  => 'admin\adminClickSynchController@synchStart']);
   //AgtOffices
   Route::get('/synch/flyer/resetOffice',[
      'as'    => 'admin.resetOffice',
      'uses'  => 'admin\adminClickSynchController@resetOffice']);
   //Flyer
   // ** flyer group **
   Route::get('/synch/flyer/resetFlyer',[
      'as'    => 'admin.resetFlyer',
      'uses'  => 'admin\adminClickSynchController@resetFlyer']);
   //Meta
   Route::get('/synch/flyer/resetFlyerMeta',[
      'as'    => 'admin.resetFlyerMeta',
      'uses'  => 'admin\adminClickSynchController@resetFlyerMeta']);
   //Mapping
   Route::get('/synch/flyer/resetFlyerMapping',[
      'as'    => 'admin.resetFlyerMapping',
      'uses'  => 'admin\adminClickSynchController@resetFlyerMapping']);
   //Stats
   Route::get('/synch/flyer/resetFlyerStat',[
      'as'    => 'admin.resetFlyerStat',
      'uses'  => 'admin\adminClickSynchController@resetFlyerStat']);
   //Remarks
   Route::get('/synch/flyer/resetFlyerRemarks',[
      'as'    =>'admin.resetFlyerRemarks',
      'uses'  => 'admin\adminClickSynchController@resetFlyerRemarks']);
   //** end flyer group **

   //Style
   Route::get('/synch/style/resetStyle',[
      'as'    =>'admin.resetStyle',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetStyle']);
   //Photo
   Route::get('/synch/photo/resetPhoto',[
      'as'    =>'admin.resetPhoto',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetPhoto']);
   //Deliv
   Route::get('/synch/deliv/resetDeliv',[
      'as'    =>'admin.resetDeliv',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetDeliv']);
   //DelivNow
   Route::get('/synch/delivNow/resetDelivNow',[
      'as'    =>'admin.resetDelivNow',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetDelivNow']);
   //allOrders
   Route::get('/synch/order/resetOrder',[
      'as'    =>'admin.resetOrder',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetOrder']);
   //emailRemovals
   Route::get('/synch/emailRemoval/resetEmailRemoval',[
      'as'    =>'admin.resetEmailRemoval',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetEmailRemoval']);
   //etrack2018
   Route::get('/synch/etrack/etrack2018',[
      'as'    =>'admin.etrack2018',
      'uses'  => 'mdbxAdmin\adminClickSynchController@updateEtrack2018']);

//adminIndexController

//adminProfile
   Route::get('/admin/profile',[
      'as'=>'admin.profile',
      'uses' => 'admin\adminProfileController@adminProfilePage']);

//adminAjaxFlyerEdit
   Route::post('/admin/ajaxFlyerEdit',[
      'as'=>'admin.ajaxFlyerEdit',
      'uses' => 'admin\adminAjaxFlyerEditController@formPost']);

//adminAutoSuggestController
   Route::get('/admin/autoSuggest',[
      'as'=>'admin.autoSuggest',
      'uses' => 'admin\adminAutoSuggestController@search']);

//adreController
   Route::get('/admin/adre',[
      'as'=>'admin.adre',
      'uses' => 'admin\adreController@index']);

//overlayController
   Route::get('/admin/populateOverlay',[
      'as'=>'admin.populateOverlay',
      'uses' => 'admin\adminOverlayController@index']);


//rets
   //testing
   Route::get('/admin/phrets',[
      'as'=>'admin.phrets',
      'uses' => 'mdbxAdmin\adminRetsController@phrets']);
   //phrets make sql
   Route::get('/admin/phretsql_prop',[
      'as'=>'admin.phretsql_prop',
      'uses' => 'mdbxAdmin\adminRetsController@phretsql_prop']);
   Route::get('/admin/phretsql_agent',[
      'as'=>'admin.phretsql_agent',
      'uses' => 'mdbxAdmin\adminRetsController@phretsql_agent']);
   Route::get('/admin/phretsql_office',[
      'as'=>'admin.phretsql_office',
      'uses' => 'mdbxAdmin\adminRetsController@phretsql_office']);
   //search
   Route::get('/admin/getAgents_all',[
      'as'=>'admin.rets_getAgents_all',
      'uses' => 'mdbxAdmin\adminRetsController@getAgents_all']);
   Route::get('/admin/getProperty_all',[
      'as'=>'admin.rets_getProperty_all',
      'uses' => 'mdbxAdmin\adminRetsController@getProperty_all']);
   Route::get('/admin/getOffice_all',[
      'as'=>'admin.rets_getOffice_all',
      'uses' => 'mdbxAdmin\adminRetsController@getOffice_all']);
   //queries
   Route::get('/admin/rets_queries',[
      'as'=>'admin.rets_queries',
      'uses' => 'mdbxAdmin\adminRetsController@rets_queries']);



//multiUploadController
   //index
   Route::get('/admin/uploadTest',[
      'as'=>'admin.uploadTest',
      'uses' => 'mdbxAdmin\multiUploadController@index']);
      //index
   Route::post('/admin/uploadBlob',[
      'as'=>'admin.uploadBlob',
      'uses' => 'mdbxAdmin\multiUploadController@blob']);
   //admin
   Route::post('/admin/uploadProcess',[
      'as'=>'admin.uploadProcess',
      'uses' => 'mdbxAdmin\multiUploadController@process']);
//mdbxAdminMsgController
   //delete message
   Route::get('/admin/adminDeleteMsg',[
      'as'=>'admin.deleteMsg',
      'uses' => 'mdbxAdmin\mdbxAdminMsgController@adminDeleteMsg']);
   //approve message
   Route::get('/admin/adminApproveMsg',[
      'as'=>'admin.approveMsg',
      'uses' => 'mdbxAdmin\mdbxAdminMsgController@adminApproveMsg']);

//mdbxScheduleController
   //show schedule
   Route::get('/admin/schedule',[
      'as'=>'admin.schedule',
      'uses' => 'mdbxAdmin\mdbxScheduleController@show']);

//flyerEdit
   //show
   Route::get('/admin/flyerEdit',[
      'as'     => 'admin.flyerEdit',
      'uses'   => 'admin\flyerEditController@show']);

//flyerEditing
   //colorChoices
   Route::get('/admin/colorChoice/{id}/{section}/{color}',[
      'as'     => 'admin.colorChoice',
      'uses'   =>'mdbxAdmin\mdbxAdminColorsController@store']);
   //styleChoice
   Route::get('/admin/chooseStyle/{style}/{id}',[
      'as'     => 'admin.chooseStyle',
      'uses'   => 'mdbxAdmin\mdbxAdminStyleController@store']);
   //saveStyle
   Route::get('/admin/saveStyle',[
      'as'     => 'admin.saveStyle',
      'uses'   => 'mdbxAdmin\mdbxAdminStyleController@saveStyle']);
   //saveHeadline
   Route::any('/admin/saveHeadline',[
      'as'     => 'admin.saveHeadline',
      'uses'   => 'mdbxAdmin\mdbxAdminHeadlineController@saveHeadline']);
   //saveCaption
   Route::post('/admin/hlCaption',[
      'as'     => 'admin.HLcaption',
      'uses'   => 'mdbxAdmin\mdbxAdminHeadlineController@hlCaption']);

//mdbxAdminCampaignController
   //deleteCamp
   Route::get('/admin/deleteCamp',[
      'as'     => 'admin.deleteCamp',
      'uses'   => 'mdbxAdmin\mdbxAdminCampaignController@deleteCamp']);
   //changeEmSubject
   Route::post('/admin/changeEmSubject',[
      'as'     => 'admin.changeEmSubject',
      'uses'   => 'mdbxAdmin\mdbxAdminCampaignController@changeEmSubject']);
   //addCampaignArea
   Route::post('/admin/addCampaignArea',[
      'as'     => 'admin.addCampaignArea',
      'uses'   => 'mdbxAdmin\mdbxAdminCampaignController@addCampaignArea']);

//adminEditFlyerController
   //editFlyerDetails
   Route::post('/admin/editFlyerDetails',[
      'as'     => 'admin.editDetailsPost',
      'uses'   => 'mdbxAdmin\mdbxAdminEditFlyerController@editDetailsPost']);

//adminOptionsController
   //adminAddAgentCheck
   Route::post('/admin/adminAddAgentCheck',[
      'as'   => 'admin.addAgentCheck',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@addAgentCheck']);
   //adminOptions
   Route::get('/admin/adminOptions',[
      'as'   => 'admin.adminOptions',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@show']);
   //return after post route
   Route::get('/admin/addAgentReturn',[
      'as'   => 'admin.addAgentReturn',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@return']);
   //adminOptions Post
   Route::post('/admin/adminOptionsPost',[
      'as'   => 'admin.adminOptionsPost',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@post']);
   //adminAddAgentPost
   Route::post('/admin/adminAddAgentPost',[
      'as'   => 'admin.addAgentPost',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@addAgentPost']);
   //addAdminPost
   Route::post('/admin/addAdminPost',[
      'as'   => 'admin.addAdminPost',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@addAdminPost']);
   //adminProfilePost
   Route::post('/admin/adminProfilePost',[
      'as'   => 'admin.profilePost',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@adminProfilePost']);
   //loginAsAgent
   Route::get('/admin/loginAsAgent',[
      'as'=>'admin.loginAsAgent',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@loginAsAgent']);
   //testPurchaseDelete
   Route::get('/admin/testPurchaseDelete',[
      'as'   => 'admin.testPurchaseDelete',
      'uses' => 'mdbxAdmin\mdbxAdminOptionController@testPurchaseDelete']);

//adminTrialRequestController
   //show
   Route::get('/admin/showNewTrials',[
      'as'=>'admin.showNewTrials',
      'uses' => 'mdbxAdmin\mdbxAdminTrialRequestController@show']);
   //post
   Route::post('/admin/trialRequestPost',[
      'as'=>'admin.trialRequestPost',
      'uses' => 'mdbxAdmin\mdbxAdminTrialRequestController@post']);
   //approve
   Route::get('/admin/trialAccountApproved',[
      'as'=>'admin.trialAccountApproved',
      'uses' => 'mdbxAdmin\mdbxAdminTrialRequestController@trialAccountApproved']);
   //delete
   Route::get('/admin/trialDelete',[
      'as'=>'admin.trialDelete',
      'uses' => 'mdbxAdmin\mdbxAdminTrialRequestController@trialDelete']);
   //Send Welcome
   Route::get('/admin/sendTrialWelcome',[
      'as'=>'admin.sendTrialWelcome',
      'uses' => 'mdbxAdmin\mdbxAdminTrialRequestController@sendTrialWelcome']);

//admin Synch Controller
   //localPhotos_w1000
   Route::get('/admin/resizePhoto_w1000',[
      'as'=>'admin.resizePhotos_w1000',
      'uses' => 'mdbxAdmin\adminSynchController@resizePhoto_w1000']);
   //assignSK1
   Route::get('/admin/assignSK1',[
      'as'=>'admin.assignSK1',
      'uses' => 'mdbxAdmin\adminSynchController@assignSK1']);
   //createPassHash
   Route::get('/admin/createPassHash',[
      'as'=>'admin.createPassHash',
      'uses' => 'mdbxAdmin\adminSynchController@createPassHash']);
   //flyerOfficeIDgen
   Route::get('/admin/flyer_officeID',[
      'as'=>'admin.flyer_officeID',
      'uses' => 'mdbxAdmin\adminSynchController@flyer_officeID']);
   //defaultPhotoFix
   Route::get('/admin/defaultPhotoFix',[
      'as'=>'admin.defaultPhotoFix',
      'uses' => 'mdbxAdmin\adminSynchController@defaultPhotoFix']);
   //officeDirectoryFix
   Route::get('/admin/officeDirectoryFix',[
      'as'=>'admin.officeDirectoryFix',
      'uses' => 'mdbxAdmin\adminSynchController@officeDirectoryFix']);
   //archivePhotoCheck
   Route::get('/admin/archivePhotoCheck',[
      'as'=>'admin.archivePhotoCheck',
      'uses' => 'mdbxAdmin\adminSynchController@archivePhotoCheck']);
   //getNewPhotos
   Route::get('/admin/flyer_getNewPhotos',[
      'as'=>'admin.flyer_getNewPhotos',
      'uses' => 'mdbxAdmin\adminSynchController@flyer_getNewPhotos']);
   //xFieldsFix
   Route::get('/admin/xFieldsFix',[
      'as'=>'admin.xFieldsFix',
      'uses' => 'mdbxAdmin\adminSynchController@xFieldsFix']);
   //entityFix
   Route::get('/admin/entityFix',[
      'as'=>'admin.entityFix',
      'uses' => 'mdbxAdmin\adminSynchController@entityFix']);
   //setAgtURL
   Route::get('/admin/setAgtURL',[
      'as'=>'admin.setAgtURL',
      'uses' => 'mdbxAdmin\adminSynchController@setAgtURL']);

//adminArchiveController
   //flyerPhotoArchive
   Route::get('/admin/archive/archiveFlyerPhoto',[
   'as'=>'admin.archiveFlyerPhoto',
   'uses' => 'mdbxAdmin\adminArchiveController@archiveFlyerPhoto']);

//adminSynchInsertController
   //synchResetAgent
   Route::get('/admin/synchResetAgent',[
      'as'=>'admin.synchResetAgent',
      'uses' => 'mdbxAdmin\adminSynchInsertController@synchResetAgent']);
   //synchResetFlyer
   Route::get('/admin/synchResetFlyer',[
      'as'=>'admin.synchResetFlyer',
      'uses' => 'mdbxAdmin\adminSynchInsertController@synchResetFlyer']);
   //synchResetPhoto
   Route::get('/admin/synchResetPhoto',[
      'as'=>'admin.synchResetPhoto',
      'uses' => 'mdbxAdmin\adminSynchInsertController@synchResetPhoto']);
   //synchResetStyle
   Route::get('/admin/synchResetStyle',[
      'as'=>'admin.synchResetStyle',
      'uses' => 'mdbxAdmin\adminSynchInsertController@synchResetStyle']);
   //synchResetDeliv
   Route::get('/admin/synchResetDeliv',[
      'as'=>'admin.synchResetDeliv',
      'uses' => 'mdbxAdmin\adminSynchInsertController@synchResetDeliv']);
   //synchResetDelivNow
   Route::get('/admin/synchResetDelivNow',[
      'as'=>'admin.synchResetFlyer',
      'uses' => 'mdbxAdmin\adminSynchInsertController@synchResetDelivNow']);

//adminClickSynchController
   //Agent - synchStart
   Route::get('/admin/synchStart',[
      'as'    =>'admin.synchStart',
      'uses'  => 'mdbxAdmin\adminClickSynchController@synchStart']);
   //AgtOffices
   Route::get('/synch/flyer/resetOffice',[
      'as'    =>'admin.resetOffice',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetOffice']);
   //Flyer
   // ** flyer group **
   Route::get('/synch/flyer/resetFlyer',[
      'as'    =>'admin.resetFlyer',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetFlyer']);
   //Meta
   Route::get('/synch/flyer/resetFlyerMeta',[
      'as'    =>'admin.resetFlyerMeta',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetFlyerMeta']);
   //Mapping
   Route::get('/synch/flyer/resetFlyerMapping',[
      'as'    =>'admin.resetFlyerMapping',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetFlyerMapping']);
   //Stats
   Route::get('/synch/flyer/resetFlyerStat',[
      'as'    =>'admin.resetFlyerStat',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetFlyerStat']);
   //Remarks
   Route::get('/synch/flyer/resetFlyerRemarks',[
      'as'    =>'admin.resetFlyerRemarks',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetFlyerRemarks']);
   //** end flyer group **

   //Style
   Route::get('/synch/style/resetStyle',[
      'as'    =>'admin.resetStyle',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetStyle']);
   //Photo
   Route::get('/synch/photo/resetPhoto',[
      'as'    =>'admin.resetPhoto',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetPhoto']);
   //Deliv
   Route::get('/synch/deliv/resetDeliv',[
      'as'    =>'admin.resetDeliv',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetDeliv']);
   //DelivNow
   Route::get('/synch/delivNow/resetDelivNow',[
      'as'    =>'admin.resetDelivNow',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetDelivNow']);
   //allOrders
   Route::get('/synch/order/resetOrder',[
      'as'    =>'admin.resetOrder',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetOrder']);
   //emailRemovals
   Route::get('/synch/emailRemoval/resetEmailRemoval',[
      'as'    =>'admin.resetEmailRemoval',
      'uses'  => 'mdbxAdmin\adminClickSynchController@resetEmailRemoval']);
   //etrack2018
   Route::get('/synch/etrack/etrack2018',[
      'as'    =>'admin.etrack2018',
      'uses'  => 'mdbxAdmin\adminClickSynchController@updateEtrack2018']);

//adminAjaxPhotoSynchController
   //ajaxGetPhotos_w1000
   Route::get('/admin/ajaxGetPhotos_w1000',[
      'as'    =>'admin.ajaxGetPhotos_w1000',
      'uses'  => 'mdbxAdmin\adminAjaxPhotoSynchController@ajaxGetPhotos_w1000']);
    //createNew_agentPhoto
   Route::get('/admin/synch/createNew_agentPhoto',[
      'as'    =>'admin.createNew_agentPhoto',
      'uses'  => 'mdbxAdmin\adminAjaxPhotoSynchController@createNew_agentPhoto']);
    //createNew_agentLogo
   Route::get('/admin/synch/createNew_agentLogo',[
      'as'    =>'admin.createNew_agentLogo',
      'uses'  => 'mdbxAdmin\adminAjaxPhotoSynchController@createNew_agentLogo']);

//uniqueOfficeIDController
   //uniqueOfficeID
   Route::get('/admin/uniqueOfficeID',[
      'as'=>'admin.uniqueOfficeID',
      'uses' => 'mdbxAdmin\uniqueOfficeIDController@uniqueOfficeID']);
   //officeFirstSelect
   Route::get('/admin/officeFirstSelect',[
      'as'=>'admin.officeFirstSelect',
      'uses' => 'mdbxAdmin\uniqueOfficeIDController@officeFirstSelect']);
   //officeFirstSelect
   Route::get('/admin/checkOfficeID',[
      'as'=>'admin.checkOfficeID',
      'uses' => 'mdbxAdmin\uniqueOfficeIDController@checkOfficeID']);

//officeRosterController
   //index
   Route::get('/admin/officeRoster',[
      'as'=>'admin.officeRoster',
      'uses' => 'mdbxAdmin\officeRosterController@index']);
   //showOfficeAgents
   Route::get('/admin/modalOfficeAgents',[
      'as'=>'admin.modalOfficeAgents',
      'uses' => 'mdbxAdmin\officeRosterController@modalOfficeAgents']);
   //officeMatch
   Route::get('/admin/roster/officeMatch',[
      'as'=>'admin.officeMatch',
      'uses' => 'mdbxAdmin\officeRosterController@officeMatch']);

//officeRosterEditController
   //officeEditPost
   Route::post('/admin/officeRoster/officeEditPost',[
      'as'=>'admin.officeEditPost',
      'uses' => 'mdbxAdmin\officeRosterEditController@officeEditPost']);

//officeRosterFunctionController
   //showOfficeNotes
   Route::get('/admin/roster/officeShowNote',[
      'as'=>'adminRoster.officeShowNote',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeShowNote']);
   //officeAddNote
   Route::post('/admin/roster/officeAddNote',[
      'as'=>'adminRoster.officeAddNote',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeAddNote']);
   //agentClear
   Route::get('/admin/roster/officeClear',[
      'as'=>'adminRoster.officeClear',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeClear']);
   //agentUnclear
   Route::get('/admin/roster/officeUnclear',[
      'as'=>'adminRoster.officeUnclear',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeUnclear']);
   //officeConfirmDelete
   Route::get('/admin/roster/officeConfirmDelete',[
      'as'=>'adminRoster.officeConfirmDelete',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeConfirmDelete']);
   //officeFlag
   Route::get('/admin/roster/officeFlag',[
      'as'=>'admin.officeFlag',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeFlag']);
   //officeUnFlag
   Route::get('/admin/roster/officeUnFlag',[
      'as'=>'admin.officeUnFlag',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@officeUnFlag']);
   //agentClear
   Route::get('/admin/roster/agentClear',[
      'as'=>'adminRoster.agentClear',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentClear']);
   //agentUnclear
   Route::get('/admin/roster/agentUnclear',[
      'as'=>'adminRoster.agentUnclear',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentUnclear']);
   //agentFlag
   Route::get('/admin/roster/agentFlag',[
      'as'=>'adminRoster.agentFlag',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentFlag']);
   //agentUnflag
   Route::get('/admin/roster/agentUnFlag',[
      'as'=>'adminRoster.agentUnFlag',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentUnFlag']);
   //agentConfirmDelete
   Route::get('/admin/roster/agentConfirmDelete',[
      'as'=>'adminRoster.agentConfirmDelete',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentConfirmDelete']);
   //agentUndelete
   Route::get('/admin/roster/agentUnDelete',[
      'as'=>'adminRoster.agentUndelete',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentUndelete']);
   //agentAddNote
   Route::post('/admin/roster/agentAddNote',[
      'as'=>'adminRoster.agentAddNote',
      'uses' => 'mdbxAdmin\officeRosterFunctionController@agentAddNote']);

//agentRecordController
   //agentSingleRecord
   Route::get('/admin/roster/agentSingleRecord',[
      'as'=>'adminRoster.agentSingleRecord',
      'uses' => 'mdbxAdmin\agentRecordController@agentSingleRecord']);
   //agentFlagCounts
   Route::get('/admin/roster/agentFlagCounts',[
      'as'=>'adminRoster.agentFlagCounts',
      'uses' => 'mdbxAdmin\agentRecordController@agentFlagCounts']);
   //agentIdMatch
   Route::get('/admin/roster/agentIdMatch',[
      'as'=>'adminRoster.agentIdMatch',
      'uses' => 'mdbxAdmin\agentRecordController@agentIdMatch']);
   //agentEditPost
   Route::post('/admin/roster/agentEditPost',[
      'as'=>'adminRoster.agentEditPost',
      'uses' => 'mdbxAdmin\agentRecordController@agentEditPost']);


//officeRosterSearchController
   //rosterSearch
   Route::get('/admin/roster/rosterSearch',[
      'as'=>'adminRoster.rosterSearch',
      'uses' => 'mdbxAdmin\rosterSearchController@rosterSearch']);
   //adreResult
   Route::get('/admin/roster/adreAgentResult',[
      'as'=>'adminRoster.adreAgentResult',
      'uses' => 'mdbxAdmin\rosterSearchController@adreAgentResult']);
   //theCheckMark
   Route::get('/admin/roster/theCheckmark',[
      'as'=>'adminRoster.theCheckmark',
      'uses' => 'mdbxAdmin\rosterSearchController@theCheckmark']);
   //theCheckMark
   Route::get('/admin/roster/nextRecord',[
      'as'=>'adminRoster.nextRecord',
      'uses' => 'mdbxAdmin\rosterSearchController@nextRecord']);
   //theChoice
   Route::get('/admin/roster/theChoice',[
      'as'=>'adminRoster.theChoice',
      'uses' => 'mdbxAdmin\rosterSearchController@theChoice']);
   //adreNoMatch
   Route::get('/admin/roster/adreNoMatch',[
   'as'=>'adminRoster.adreNoMatch',
   'uses' => 'mdbxAdmin\rosterSearchController@adreNoMatch']);

   //showJsonTree
   Route::get('/admin/roster/showJsonTree',[
      'as'=>'adminRoster.showJsonTree',
      'uses' => 'mdbxAdmin\rosterSearchController@showJsonTree']);

//agentAutoSearchController
   //on keypress (formVal)
   Route::get('/admin/autosearch/propagent',[
      'as'=>'admin.agentAutoSearch',
      'uses' => 'mdbxAdmin\agentAutoSearchController@formVal']);



/* outdated links

   //adreMerge
   Route::get('/admin/roster/adreMerge',[
      'as'=>'adminRoster.adreMerge',
      'uses' => 'mdbxAdmin\rosterSearchController@adreMerge']);
   Route::get('/admin/roster/mergeChoice',[
      'as'=>'adminRoster.mergeChoice',
      'uses' => 'mdbxAdmin\rosterSearchController@mergeChoice']);
*/
