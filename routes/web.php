<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//deploy git
Route::any('deploy', 'deployController@deploy');

//website routes
//admin
include(app_path().'/routeIncludes/adminRoutes.php');
//dev Routes
include(app_path().'/routeIncludes/devRoutes.php');
//dev Routes
include(app_path().'/routeIncludes/retsRoutes.php');
//mdbxMemberRoutes
include(app_path().'/routeIncludes/memberRoutes.php');
//public routes
include(app_path().'/routeIncludes/mdbxPublicRoutes.php');
