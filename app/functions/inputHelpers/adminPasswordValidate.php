<?php

$validator = \Validator::make($request::all(), [
   'password'      => 'min:6|required',
]);
