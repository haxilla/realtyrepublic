<?php

$validator = \Validator::make($request::all(), [
   'adminFirst'      => 'min:3|required',
   'adminLast'       => 'min:3|required',
   'adminHandle'     => 'min:3|max:15|required',
   'adminEmail'      => 'email|required',
   'authLevel'       => 'required',
]);
