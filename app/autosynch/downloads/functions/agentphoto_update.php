<?php

Use App\autosynch\models\propagent\propagentOld;

propagentOld::where('umid','=',$thisAgent)
->update([
	'agtPhotoCheck'=>\Carbon\Carbon::now(),
]);
