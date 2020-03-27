<?php
//currently NOT USED
//was a way to test for progress
//but didnt turn out to be faster
//might be good in the future to use as a log method
namespace App\models\synch;

class synchProgress extends \App\Model
{
    protected $dates        = ['propagentTime','created_at','updated_at'];
    protected $primaryKey   = 'id';
    protected $table        = 'synchProgress';

}
