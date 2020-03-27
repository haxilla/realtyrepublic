<?php
if($next=='new'){
	include('synchNew.php');
}else if($next=='propagent'){
	include(app_path().'/synch/resets/agent/resetAgent.php');
}else if($next=='agtoffice'){
	include(app_path().'/synch/resets/agent/resetAgtOffice.php');
}else{
	dd('error');
}