<?php

namespace App\models\federated;

class emailagents_federated extends \App\Model
{
    protected $dates = ['startDate','expireDate','trialDate'];
    protected $primaryKey = 'id';
    protected $table='emailagents_federated';

}
