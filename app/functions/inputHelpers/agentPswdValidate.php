<?php

$validator = \Validator::make($request::all(), [
   'agtPassword' => 'required|min:6|confirmed',
]);
