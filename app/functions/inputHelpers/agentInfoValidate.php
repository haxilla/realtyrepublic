<?php

$validator = \Validator::make($request::all(), [
   'agtFirst'        => 'bail|required|min:3',
   'agtLast'         => 'bail|required|min:3',
   'agtEmail'        => 'bail|required|email',
   'agtMainPhone'    => 'bail|required|max:15',
   'officeName'      => 'bail|required|min:3',
   'officeAddress1'  => 'bail|required|min:3',
   'officeCity'      => 'bail|required|min:3',
   'officeState'     => 'bail|required|size:2',
   'officeZip'       => 'bail|required|digits:5',
   'agtWebsite'      => 'nullable|url',
   'g-recaptcha-response' => 'required',
]);
