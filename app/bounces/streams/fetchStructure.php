<?php

$s=imap_fetchstructure($mbox,$uid,FT_UID);
$prefix=1;
$partNum=0;
$plainmsg=null;
$htmlmsg=null;
$fileName=null;
$fileSubtype=null;
$inlineFiles=array();

if(isset($s->parts)&&count($s->parts)>0){

	foreach($s->parts as $part){
		$partNum++;
		$getPart=$prefix.'.'.$partNum;
		$encoding=$part->encoding;
		$type=$part->type;
		$subtype=$part->subtype;
		$ifdparameters=$part->ifdparameters;

		if($subtype=='PLAIN'){

			$plainmsg=imap_fetchbody($mbox,$uid,$partNum,FT_UID);
			if($encoding==3){
				$plainmsg=base64_decode($plainmsg);}
			if($encoding==4){
				$plainmsg=quoted_printable_decode($plainmsg);}
		
		}elseif($subtype=='HTML'){

			$htmlmsg=imap_fetchbody($mbox,$uid,$partNum,FT_UID);
			if($encoding==3){
				$htmlmsg=base64_decode($htmlmsg);}
			if($encoding==4){
				$htmlmsg=quoted_printable_decode($htmlmsg);}

		}elseif($type==3){

			//sets filename
			if($ifdparameters){
				foreach($part->dparameters as $param){
					if($param->attribute=='FILENAME'){
						$fileName=$param->value;
						$fileSubtype=$subtype;
					}
				}
			}
			//errors if none found
			if(!$fileName){
				dd('error-line65-inboxDisplay.php');}


		}elseif($subtype=='RFC822-HEADERS'||$subtype=='RFC822'
		||$subtype=='DELIVERY-STATUS'||$subtype=='RELATED'
		||$subtype=='ALTERNATIVE'){
			//default 
			$decimal=1;

			if($part->parts){
				foreach($part->parts as $p){
					$partDecimal=$partNum.'.'.$decimal;
					if($p->subtype=='PLAIN'){

						$plainmsg .= imap_fetchbody($mbox,$uid,$partDecimal);
						if($p->encoding==3){
							$plainmsg=base64_decode($plainmsg);}
						if($p->encoding==4){
							$plainmsg=quoted_printable_decode($plainmsg);}
					}
					if($p->subtype=='HTML'){
						$htmlmsg .= imap_fetchbody($mbox,$uid,$partDecimal);
						if($p->encoding==3){
							$htmlmsg=base64_decode($htmlmsg);}
						if($p->encoding==4){
							$htmlmsg=quoted_printable_decode($htmlmsg);}
					}

					$decimal++;
				}
			}

		}elseif($subtype=='JPEG'){

			if($part->disposition=="INLINE"){

				//sets filename
				if($part->ifdparameters){
					foreach($part->dparameters as $param){
						if($param->attribute=='FILENAME'){
							$fileName=$param->value;
							$fileType=$subtype;
							$inlineContent = imap_fetchbody($mbox,$uid,$partNum,FT_UID);

							/* decode later */

							$inlineFiles[]=[
								'fileName' 			=> $fileName,
								'fileType' 			=> $fileType,
								'encoding' 			=> $encoding,
								'inlineContent'		=> $inlineContent,
								'cid'				=> $part->id,
							];
						};
					};
				};

				//errors if none found
				if(!$inlineFiles){
					dd('error-line65-inboxDisplay.php');}

			}

		}else{
			dd($s,$subtype,'error-line62-bounces/streams/fetchStructure.php');}
	}
		
}else{
	
	//NO PARTS
	$subtype=$s->subtype;
	$encoding=$s->encoding;
	
	if($subtype=='PLAIN'){
		$plainmsg=imap_fetchbody($mbox,$uid,1,FT_UID);
		if($encoding==3){
			$plainmsg=base64_decode($plainmsg);}
		if($encoding==4){
			$plainmsg=quoted_printable_decode($plainmsg);
		}

	}elseif($subtype=='HTML'){
		$htmlmsg=imap_fetchbody($mbox,$uid,1,FT_UID);
		if($encoding==3){
			$htmlmsg=base64_decode($htmlmsg);}
		if($encoding==4){
			$htmlmsg=quoted_printable_decode($htmlmsg);}

	}else{
		dd('error-line91-inboxDisplay.php');}
}