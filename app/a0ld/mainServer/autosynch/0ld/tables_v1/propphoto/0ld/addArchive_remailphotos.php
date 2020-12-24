<?php

DB::select( DB::raw("
INSERT IGNORE INTO propphotos
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
FROM maindata.remailphotos
"));
