<?php

//template
if(isset($_GET['showTemplate'])){
  if($_GET['showTemplate']==1){
    $showTemplate=1;
  }else{
    $showTemplate=0;
  }
}else{
  $showTemplate=0;
}

//headline form
global $showHL;
if(isset($_GET['showHL'])){
  if($_GET['showHL']==1){
    $showHL=1;
  }else{
    $showHL=0;
  }
}else{
    $showHL=0;
}

//colors form
global $showColors;
if(isset($_GET['showColors'])){
  if($_GET['showColors']==1){
    $showColors=1;
  }else{
    $showColors=0;
  }
}else{
    $showColors=0;
}



