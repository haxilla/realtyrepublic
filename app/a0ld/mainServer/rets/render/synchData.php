<?php


//return html
$html=\View::make('rets.overlays.synchData')
->with([
	'responseOverlayTitle'	 => 'RETS',
	'responseOverlaySubtitle'=> "$retsSystem - $mlsName",

])->render();

//echo
echo $html;
//exit
exit();