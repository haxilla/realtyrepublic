<?php

$zip = new ZipArchive;
if ($zip->open(app_path().'/adre/upload/ziptest/Individuals.zip') === TRUE) {
    $zip->extractTo(app_path().'/adre/extract/ziptest');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}