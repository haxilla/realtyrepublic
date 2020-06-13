<?php

$imap_body=imap_body($mbox,$uid,FT_UID);
$imap_fetchbody=imap_body($mbox,$uid,FT_UID);
$imap_header=imap_header($mbox,$uid,FT_UID);
$msg_header=imap_fetchbody($mbox,$uid,0,FT_UID);
$body_header=$msg_header;