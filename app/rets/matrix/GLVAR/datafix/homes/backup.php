<?php

//GLVAR_HOMES_backup
//backup

\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY PhotoModificationTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY TStatusDate timestamp;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY StatusChangeTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY ProviderModificationTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY PriceChangeTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY PriceChgDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY OriginalEntryTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY NODDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_backup
  MODIFY MatrixModifiedDT datetime null;
");
