<?php

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  

$tableName = "his_dc_production_data";
$tsql = "SELECT 
            MAT_SAP_CODE, HPS_SEQUENCE, PP_CODE, 
            MCH_CODE, MAT_VARIANT, 
            convert(varchar, PS_DATE, 120) AS PS_DATE,
            CNT_CODE, SHF_CODE, WM_CODE, CU_DOUBLE_CUT, 
            PS_MCH_SIDE, PS_DECLARE_MIN, PS_TEORICAL_MIN, 
            PS_QUANTITY, PS_SCRAP, PS_WORKMAN_SEQ, 
            PS_CORRECTION, PS_CURE_TIME, 
            convert(varchar, PS_END_PROD, 120) AS PS_END_PROD,
            PS_PIECE_COUNTER, PS_TOTAL_TIME, 
            PS_DECLARE_SEC, PS_THEOR_SEC_BY_LOGINS
        FROM his_dc_production_data
        WHERE PS_DATE >= CAST( GETDATE() AS Date )
            ORDER BY HPS_SEQUENCE DESC ";  

/* Execute the query. */