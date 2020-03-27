<?php

Use App\autosynch\models\propagent\propagentOld;

propagentOld::where('umid','=',$thisAgent)
->update([
	'agtlogoCheck'=>\Carbon\Carbon::now(),
]);
