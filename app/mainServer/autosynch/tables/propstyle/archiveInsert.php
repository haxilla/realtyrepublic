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
    propflyer_id,
    propagent_id,
    template,
    flyer_background,
    graphic_textcolor,
    graphic_words,
    graphic_style,
    accentbars,
    headline_bar_text,
    headline_text,
    headline_bar_bg,
    template_chosen,
    photos_chosen,
    headline_chosen,
    colors_chosen,
    text_chosen
  )
SELECT
  ufid,
  umid,
  template,
  flyer_background,
  graphic_textcolor,
  graphic_words,
  graphic_style,
  accentbars,
  headline_bar_text,
  headline_text,
  headline_bar_bg,
  template_chosen,
  photos_chosen,
  headline_chosen,
  colors_chosen,
  text_chosen
FROM remarchives.$tableArchive
"));

//revert back to default
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;
");