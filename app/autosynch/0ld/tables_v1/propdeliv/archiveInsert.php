<?php

// GLOBAL transaction isolation level changed 
// to track number of records during insert
// reverted back to repeatable-read when completed
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
");

// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT IGNORE INTO $tableMains
    (
    propflyer_id,
    emSubject,
    emArea,
    emStart,
    emComplete,
    emRequest,
    cid,
    propagent_id,
    emArea_display,
    campLabel,
    totalEmails,
    lastEI,
    startRow,
    campCreated,
    template,
    priority,
    rush,
    rushDate,
    amtEmails,
    delay,
    resumeURL,
    emailsLeft,
    closingLine,
    removeLink,
    warp15,
    warp6,
    emAlt,
    suspend,
    authorized,
    camp_order,    
    aol_done,    
    cox_done,
    gmail_done,
    misc_done,
    msn_done,
    yahoo_done,
    emalt_msn,
    emalt_yahoo,
    emalt_cox,
    emalt_aol,
    admin_add,
    authNum,
    remCreds,
    server,
    free
    )
  SELECT
    ufid,
    emailSubject,
    emailarea,
    emailstarted,
    emailfinished,
    emailrequested,
    campaignid,
    umid,
    emailarea_display,
    camplabel,
    totalemails,
    lastei,
    sentsofar,
    campcreated,
    template,
    priority,
    rush,
    rushdate,
    amtemails,
    delay,
    resumeurl,
    emailsleft,
    closingline,
    removelink,
    warp15,
    warp6,
    emAlt,
    suspend,
    authorized,
    camp_order,
    aol_done,
    cox_done,    
    gmail_done,      
    misc_done,
    msn_done,
    yahoo_done,
    emalt_msn,
    emalt_yahoo,
    emalt_cox,
    emalt_aol,
    admin_add,
    authNum,
    remcreds,
    server,
    free
  FROM  remarchives.$tableArchive
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");

