<?php

//models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtaskcomment;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devexcuse;

//set term
$term = request('tasksearch');

//union these
$query1 = devtaskcomment::select('taskComment as taskDesc','taskID','listRef')
->where('taskComment','like','%'.$term.'%');
$query2 = devtip::select('tipDesc as taskDesc','taskID','listRef')
->where('tipDesc','like','%'.$term.'%');
$query3 = devexcuse::select('excuseDesc as taskDesc','taskID','listRef')
->where('excuseDesc','like','%'.$term.'%');

//main query
$tasksearch = devtask::select('taskDesc','taskID','listRef')
->where('taskDesc','like','%'.$term.'%')
->union($query1)
->union($query2)
->union($query3)
->take(15)
->get();