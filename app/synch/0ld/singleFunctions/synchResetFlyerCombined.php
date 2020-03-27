<?php
// ** BEGIN INSERT
// Insert
DB::select( DB::raw("
  INSERT IGNORE INTO propflyers
    (
    creationDate,
    id,
    propagent_id,
    xMlsNum,
    xMlsNumOrig,
    xListPrice,
    xxBeds,
    xxBaths,
    xxSqft,
    xFullStreet,
    xCity,
    xState,
    xxZip,
    xCountyName,
    xxHeadline,
    xxYrBuilt,
    xxPoolPvt,
    xParking,
    xxRV,
    xFireplace,
    xMlsLink,
    xxVirtualTour,
    officeID
    )
  SELECT
    creation,
    ufid,
    umid,
    e_MlsNum,
    e_MlsNum_Orig,
    e_ListPrice,
    e_Beds,
    e_Baths,
    e_Sqft,
    e_address,
    e_City,
    e_State,
    e_Zip,
    e_county,
    headline,
    e_YrBuilt,
    e_PoolPvt,
    e_Parking,
    e_RV,
    e_Fireplace,
    MlsLink,
    e_Virt_Tour,
    officeID
  FROM maindata.remailflyers
"));
