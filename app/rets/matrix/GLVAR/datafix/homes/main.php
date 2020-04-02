<?php

//GLVAR_HOMES
//main
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PhotoModificationTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY TStatusDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY StatusChangeTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY ProviderModificationTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PriceChangeTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY PriceChgDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY OriginalEntryTimestamp datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY NODDate datetime null;
");
\DB::connection('rets')
->statement("
  ALTER TABLE GLVAR_Homes
  MODIFY MatrixModifiedDT datetime null;
");
