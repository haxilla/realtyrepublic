
<?php

$config = new \PHRETS\Configuration;
$config->setLoginUrl($retsURL)
        ->setUsername($retsUname)
        ->setPassword($retsPswd)
        ->setRetsVersion($retsVersion);

$rets = new \PHRETS\Session($config);

$connect = $rets->Login();