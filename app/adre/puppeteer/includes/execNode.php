<?php

// version in OLD folder is a fix
// sudo -u sitemaster option changes user
// without above code it runs on root

// built in chrome with puppeteer
// throws error if running headless
// without adding options to puppeteer.launch()
// example in OLD folder

// to run exec on node file
// first change directory; 
// change user to sitemaster
// then run node files with 2>&1

$nodeRan=1;
//Individuals.zip
$file1 = exec("cd $nodeDir; sudo -u sitemaster node Individuals.js 2>&1", $out1, $err1);
//Entities.zip
$file2 = exec("cd $nodeDir; sudo -u sitemaster node Entities.js 2>&1", $out2, $err2);
