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
INSERT INTO $tableMains
  (
    existCheck,
    photoDate,
    photoID,
    propflyer_id,
    propagent_id,
    photoName,
    resized,
    def,
    width,
    height,
    orient,
    oldFileName,
    oldFileSize,
    newFileSize,
    ord,
    xxChosen,
    notFound,
    localFound,
    remoteFound
  )
SELECT
  exist_check,
  photodate,
  photoID,
  ufid,
  umid,
  locname,
  resized,
  def,
  width,
  height,
  orient,
  origname,
  filesize,
  filesize2,
  ord,
  chosen,
  notFound,
  localFound,
  remoteFound
FROM remarchives.$tableArchive
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");