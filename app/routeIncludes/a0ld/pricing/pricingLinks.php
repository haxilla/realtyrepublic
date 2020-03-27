<?php

//mdbxPriceController
   //pricing
   Route::get('/pricing', [
      'as'=>'public.pricing',
      'uses'=>'mdbxPublic\mdbxPriceController@pricing']);
   //az
   Route::get('/azPrice', [
      'as'=>'public.azPrice',
      'uses'=>'mdbxPublic\mdbxPriceController@azpricing']);
   //nv
   Route::get('/nvPrice', [
      'as'=>'public.nvPrice',
      'uses'=>'mdbxPublic\mdbxPriceController@nvpricing']);