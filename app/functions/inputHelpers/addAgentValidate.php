<?php

$validator = \Validator::make($request::all(), [
   'agtMlsID'  => 'required|min:5',
   'officeID'  => 'required|min:5',
   'agtBoard'  => 'required|min:5',
   'agtCounty' => 'required|min:5',
   'areaList'  => 'required|min:5',
]);
