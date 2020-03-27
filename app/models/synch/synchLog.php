<?php
//currently NOT USED
//was a way to test for progress
//but didnt turn out to be faster
//might be good in the future to use as a log method
namespace App\models\synch;

class synchLog extends \App\Model
{
	protected $primaryKey   = 'synchID';
    protected $table        = 'remailsynch.synchLog';
    protected $dates        = [
    	'created_at','updated_at','synchStart','synchComplete',
    	'allOrderSynch','emailRemovalSynch','propagentSynch',
    	'propdelivSynch','propdelivnowSynch','propflyerSynch',
    	'propflyerstatSynch','propmappingSynch','propmetaSynch',
    	'propphotoSynch','propremarkSynch','propstyleSynch'
    ];

}
