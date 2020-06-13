<?php
// Insert
DB::select( DB::raw("
INSERT IGNORE INTO propstyles
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
FROM maindata.remailstyles
"));
