<?php

use App\models\core\propstyle;
include(app_path().'/flyerVariables/existingFlyerCheck.php');

$getStyle=propstyle::where('propflyer_id','=',"$idFly")->first();

$graphic_words       = $getStyle['graphic_words'];
$graphic_style       = $getStyle['graphic_style'];
$flyer_background    = $getStyle['flyer_background'];
$template            = $getStyle['template'];
$headline_bar_bg     = $getStyle['headline_bar_bg'];
$headline_bar_text   = $getStyle['headline_bar_text'];
$graphic_textcolor   = $getStyle['graphic_textcolor'];
$accent_bars         = $getStyle['accentbars'];
$noDark              = 0;
$noLight             = 1;

//***********************************************************
// **********************   BACKGROUND  *********************
//***********************************************************

if($section=='b'){

   if($color == '996600' or $color == '990000'
   or $color == '999999' or $color == '000066'
   or $color == '000000' or $color == '333333'){

      $accent_text         = $color;
      $noDark              = 1;
      $noLight             = 0;
      $graphic_textcolor   = 'ffffff';
      $headline_bar_bg     = 'eeeeee';
      $headline_bar_text   = $color;
      $accent_bars         = $color;
      $headline_text       = 'ffffff';
      $flyer_background    = $color;

      propstyle::where('propflyer_id','=',"$idFly")
      ->update([
         'graphic_textcolor'  =>'ffffff',
         'headline_bar_bg'    =>'eeeeee',
         'headline_bar_text'  =>$accent_text,
         'accentbars'         =>$accent_bars,
         'headline_text'      =>'ffffff',
         'flyer_background'   =>$color
      ]);

   }

   if($color=='cccccc' or $color == 'eeeeee'){

      $noLight=1;
      $linkColor=$headline_bar_bg;

      if($color == 'eeeeee' || $color=='cccccc'){
         $graphic_textcolor='333333';
         $accent_text='333333';
      }elseif($color=='999999'){
         $graphic_textcolor='ffffff';
         $accent_text='333333';
      }else{
         $graphic_textcolor='333333';
         $accent_text='333333';
      }

      propstyle::where('propflyer_id','=',"$idFly")
      ->update([
         'flyer_background'   => $color,
         'headline_bar_bg'    => '333333',
         'headline_bar_text'  => 'ffffff',
         'headline_text'      => '333333',
         'accentbars'         => '333333',
         'graphic_textcolor'  => $graphic_textcolor,
      ]);

      $graphic_textcolor   = $graphic_textcolor;
      $headline_bar_bg     = '333333';
      $headline_bar_text   = 'ffffff';
      $accent_bars          = '333333';
      $headline_text       = '333333';
      $flyer_background    = $color;
   }
}

if($section=='t'){

   $graphic_textcolor   = $color;
   $accent_bars         = $color;

   if($template !=='s1pc'&& $template !== '1pc'){
      $accent_text         = $color;
      $headline_bar_bg     = $color;
      $headline_bar_text   = 'ffffff';
   }else{
      $accent_text         = '333333';
   }

   $headline_text       = '333333';

   //headline text is address on style 1
   //doesnt look right on other styles
   if($color==='990000'||$color==='000066'){
      if($template==='s1pc'||$template==='1pc'){
         $headline_text=$color;
      }
   }

   //if yellow / text grey
   if($color==='ffc60b'){
      $headline_bar_text='666666';
      $accent_text='666666';
   }

   if($color==="ffc60b"){
      $accent_text="666666";
   }

   if($color==="ffffcc"||$color==="eeeeee"||$color==="ffffff"){

      $noDark=1;
      $noLight=0;
      $headline_text="ffffff";

      if($template !== 's1pc' && $template !=='1pc'){
         $accent_text=$flyer_background;
         $accent_bars=$flyer_background;
         $headline_bar_text=$flyer_background;
         $graphic_textcolor='ffffff';
      }else{
         $accent_bars=$flyer_background;
         $graphic_textcolor='ffffff';
      }
   }

   propstyle::where('propflyer_id','=',"$idFly")
   ->update([
      'headline_bar_bg'    => $headline_bar_bg,
      'headline_bar_text'  => $headline_bar_text,
      'headline_text'      => $headline_text,
      'graphic_textcolor'  => $graphic_textcolor,
      'accentbars'         => $accent_bars
   ]);
}

$hlGraphic="$graphic_words"."_"."$graphic_textcolor"."_"."$graphic_style".'x.png';

$idArray = array(
 "status"            => 'success',
 "flyer_background"  => $flyer_background,
 "headline_text"     => $headline_text,
 "headline_bar_bg"   => $headline_bar_bg,
 "headline_bar_text" => $headline_bar_text,
 "graphic_textcolor" => $graphic_textcolor,
 "graphic_words"     => $graphic_words,
 "graphic_style"     => $graphic_style,
 "accent_bars"       => $accent_bars,
 "template"          => $template,
 "hlGraphic"         => $hlGraphic,
 "accent_text"       => $accent_text,
 "noDark"            => $noDark,
 "noLight"           => $noLight,
);

echo json_encode($idArray);
exit();
