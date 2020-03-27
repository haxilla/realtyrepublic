<?php

namespace App\models\mdbxArchive;

class archiveFlyerPhotoModel extends \App\Model
{
  protected $table='mdbxArchive.archiveFlyerPhotos';
  protected $primaryKey = 'photoID';
  protected $dates = ['existCheck','photoDate'];
}
