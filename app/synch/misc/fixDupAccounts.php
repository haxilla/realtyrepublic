<?php

//query
SELECT COUNT(id) AS countUname, agtUname, xxAgtUname,remcreds,accounttype FROM propagents GROUP BY xxAgtUname ORDER BY countUname DESC;
