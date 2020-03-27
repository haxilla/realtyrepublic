
<?php

$config = new \PHRETS\Configuration;
$config->setLoginUrl('http://rets.las.mlsmatrix.com/rets/login.ashx')
        ->setUsername('reagentprod')
        ->setPassword('glv147')
        ->setRetsVersion('1.5');

$rets = new \PHRETS\Session($config);

$connect = $rets->Login();