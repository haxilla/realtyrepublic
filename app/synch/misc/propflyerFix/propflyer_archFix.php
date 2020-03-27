<?php

// fixes an issue with adding archives 
// of old flyers to current propflyers table
// was unable to get accurate counts
// without deleting matching records from archive
// that were found in current propflyer

use App\models\maindata\maindataRemailFlyer;
use App\models\maindata\cleanRemailFlyer;
use App\models\oldsite\pushArchives;
use App\models\oldsite\pushArchivesCopy;

$pushArchives=maindataRemailFlyer::select('ufid')
->whereNull('created_at')
->get();

$pushArchivesCopy=pushArchivesCopy::select('ufid')
->whereNull('creation')
->get();

foreach($pushArchives as $the){
	$ufid=$the->ufid;
	pushArchives::create([
		'ufid'=>$ufid,
	]);
	maindataRemailFlyer::where('ufid','=',$ufid)
	->update([
		'created_at'=>\Carbon\Carbon::now(),
	]);
}

foreach($pushArchivesCopy as $the){
	$ufid=$the->ufid;
	cleanRemailFlyer::create([
		'ufid'=>$ufid,
	]);
	pushArchivesCopy::where('ufid','=',$ufid)
	->update([
		'creation'=>\Carbon\Carbon::now(),
	]);
}

/* ran this on remote server after all were moved 
/* removed archive records that were already 
/* in remailflyers table

/* 
delete from pusharchivesCopy
where pusharchivesCopy.ufid
in(select remailflyers.ufid from remailflyers);
*/

/* worksheet from remote server

select count(*) from maindata.remailflyers;

/* duplicates 1802

SELECT count(*)
FROM remailflyers
left join pusharchives 
on remailflyers.ufid=pusharchives.ufid
where pusharchives.ufid is not null;

/* non duplicates=2247
SELECT COUNT(*)
FROM remailflyers
LEFT JOIN pusharchives 
ON remailflyers.ufid=pusharchives.ufid 
WHERE pusharchives.ufid IS NULL;

/* 2247 + 1802 = 4049 

/* Total = 4049 

select count(*)
from remailflyers;

select count(*) 
from remailflyers where ufid 
not in (select ufid from pusharchives);

select count(*) 
from remailflyers where ufid 
in (select ufid from pusharchives);

select ufid from remailflyers order by ufid desc;

select count(*) from pusharchives;

create table pusharchivesCopy like pushArchives;

insert into pusharchivesCopy select * from pushArchives;

/* removed archives that are already in remailflyers 
delete from pusharchivesCopy
where pusharchivesCopy.ufid
in(select remailflyers.ufid from remailflyers);
*/