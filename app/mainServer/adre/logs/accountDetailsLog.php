<?php
//set metaIds
$metaIds=[
   'propagent_id'    => $thisID,
   'remailAgentID'   => $thisRemailAgentID,
];
//indivual account details
$dupLoop['allAccounts'][$thisID]['details']['agtFullName']   = $thisAgtFullName;
$dupLoop['allAccounts'][$thisID]['details']['accountType']   = $thisAccountType;
$dupLoop['allAccounts'][$thisID]['details']['accountStatus'] = $thisAccountStatus;
$dupLoop['allAccounts'][$thisID]['details']['startDate']     = $thisStartDate;
$dupLoop['allAccounts'][$thisID]['details']['expireDate']    = $thisExpireDate;
$dupLoop['allAccounts'][$thisID]['details']['remCreds']      = $thisRemCreds;
$dupLoop['allAccounts'][$thisID]['details']['pCreds']        = $thisPcreds;
$dupLoop['allAccounts'][$thisID]['details']['agtEmail']      = $thisAgtEmail;
$dupLoop['allAccounts'][$thisID]['details']['xxAgtUname']    = $thisXxAgtUname;
$dupLoop['allAccounts'][$thisID]['details']['imagesOK']      = $imagesOK;
$dupLoop['allAccounts'][$thisID]['details']['flyerCount']    = $thisFlyerCount;
$dupLoop['allAccounts'][$thisID]['details']['flyerQuery']    = $getFlyers;
$dupLoop['allAccounts'][$thisID]['details']['main']          = 0;
$dupLoop['allAccounts'][$thisID]['details']['LicNumber']     = $LicNumber;
$dupLoop['allAccounts'][$thisID]['details']['metaIds']       = $metaIds;
