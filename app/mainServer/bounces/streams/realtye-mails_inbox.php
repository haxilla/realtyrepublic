<?php

//stream
$mbox = imap_open ("{mail.realtye-mails.com:110/pop3}INBOX", 
	"members@realtye-mails.com", 
	"d4vidb0wi3!");

$MC = imap_check($mbox);
$num_msg=$MC->Nmsgs;