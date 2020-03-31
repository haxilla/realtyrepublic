<?php

\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PhotoModificationTimestamp timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY TStatusDate timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY StatusChangeTimestamp timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY ProviderModificationTimestamp timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PriceChangeTimestamp timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PriceChgDate timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY OriginalEntryTimestamp timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY NODDate timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY MatrixModifiedDT timestamp;
");


\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY PhotoModificationTimestamp datetime null;
");
