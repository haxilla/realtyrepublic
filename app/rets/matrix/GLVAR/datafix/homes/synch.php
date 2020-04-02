<?php

//GLVAR_Homes_synch

\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY PhotoModificationTimestamp datetimeselec null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY TStatusDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY StatusChangeTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY ProviderModificationTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY PriceChangeTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY PriceChgDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY OriginalEntryTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY NODDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes_synch
  MODIFY MatrixModifiedDT datetime null;
");
