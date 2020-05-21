<?php
//emailQcontroller
  //passwordReset
  Route::get('/member/email/resetPassword',[
    'as' => 'member.email.resetPassword',
    'uses' => 'member\emailQcontroller@passwordReset']);
  Route::get('/member/email/failedJobs',[
    'as' => 'member.email.failedJobs',
    'uses' => 'member\emailQcontroller@failedJobs']);
