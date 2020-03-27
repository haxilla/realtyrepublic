<?php

use App\propstyle;

$getStyle=propstyle::where('propflyer_id','=',"$id")->first();

$headline_bar_bg     = $getStyle['headline_bar_bg'];
$headline_bar_text   = $getStyle['headline_bar_text'];
$headline_text       = $getStyle['headline_text'];
$flyer_background    = $getStyle['flyer_background'];
$graphic_words       = $getStyle['graphic_words'];
$graphic_style       = $getStyle['graphic_style'];
$accentbars          = $getStyle['accentbars'];
$template            = $getStyle['template'];

if($section=='b'){

   if($color == '996600' or $color == '990000'
   or $color == '999999' or $color == '000066'
   or $color == '000000' or $color == '333333'){
      propstyle::where('propflyer_id','=',"$id")
      ->update([
         'graphic_textcolor'  =>'ffffff',
         'headline_bar_bg'    =>'eeeeee',
         'headline_bar_text'  =>$color,
         'accentbars'         =>$color,
         'headline_text'      =>'ffffff',
         'flyer_background'   =>$color
      ]);

      $graphic_textcolor   = 'ffffff';
      $headline_bar_bg     = 'eeeeee';
      $headline_bar_text   = $color;
      $accentbars          = $color;
      $headline_text       = 'ffffff';
      $flyer_background    = $color;

   }

   if($color=='cccccc' or $color == 'eeeeee' or $color == 'ffffcc'){

      if($color == 'eeeeee'){
         $graphic_textcolor='333333';
      }elseif($color == 'cccccc'){
         $graphic_textcolor='ffffff';
      }else{
         $graphic_textcolor='333333';
      }

      propstyle::where('propflyer_id','=',"$id")
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
      $accentbars          = '333333';
      $headline_text       = '333333';
      $flyer_background    = $color;
   }
}

if($section=='t'){

   $graphic_textcolor=$color;

   if($color !=='ffffff'){
      $headline_bar_bg = $color;
   }

   if($color !== 'ffffcc' and $color !== '000066'
   and $color !='990000' and $color !== '000000'
   and $color !='99600'){
      $headline_bar_text = 'ffffff';
   }

   if($color=='ffffff' or $color=='eeeeee' or $color=='ffffcc'){
      $headline_bar_text = $flyer_background;
   }

   propstyle::where('propflyer_id','=',"$id")
   ->update([
      'headline_bar_bg'    => $headline_bar_bg,
      'headline_bar_text'  => $headline_bar_text,
      'graphic_textcolor'  => $graphic_textcolor,
      'accentbars'         => $flyer_background
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
 "accentbars"        => $accentbars,
 "template"          => $template,
 "hlGraphic"         => $hlGraphic
);

echo json_encode($idArray);
exit();
