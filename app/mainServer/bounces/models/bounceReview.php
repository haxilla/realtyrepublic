<?php

namespace App\bounces\models;

class bounceReview extends \App\Model
{
	protected $table="rememaildb.bounceReview";
	protected $primaryKey='reviewID';
	protected $dates=['created_at','updated_at'];
}
