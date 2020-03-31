<?php

\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PhotoModificationTimestamp timestamp;
  ALTER TABLE GLVAR_Homes
  MODIFY PriceChangeTimestamp timestamp;
");

/*
//GLVAR_Homes changes
Schema::connection('rets')
->table('GLVAR_Homes', function (Blueprint $table) {
    $table->timestamp('MatrixModifiedDT')->change();
		$table->timestamp('PhotoModificationTimeStamp')->change();
		$table->timestamp('PriceChangeTimestamp')->change();
		$table->timestamp('PriceChgDate')->change();
		$table->timestamp('OriginalEntryTimestamp')->change();
		$table->timestamp('NODDate')->change();
});
Schema::connection('rets')
->table('GLVAR_Homes_backup', function (Blueprint $table) {
    $table->timestamp('MatrixModifiedDT')->change();
		$table->timestamp('PhotoModificationTimeStamp')->change();
		$table->timestamp('PriceChangeTimestamp')->change();
		$table->timestamp('PriceChgDate')->change();
		$table->timestamp('OriginalEntryTimestamp')->change();
		$table->timestamp('NODDate')->change();
});
Schema::connection('rets')
->table('GLVAR_Homes_synch', function (Blueprint $table) {
    $table->timestamp('MatrixModifiedDT')->change();
		$table->timestamp('PhotoModificationTimeStamp')->change();
		$table->timestamp('PriceChangeTimestamp')->change();
		$table->timestamp('PriceChgDate')->change();
		$table->timestamp('OriginalEntryTimestamp')->change();
		$table->timestamp('NODDate')->change();
});
*/
