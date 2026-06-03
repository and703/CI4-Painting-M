@ECHO OFF
mode con:cols=25 lines=5
:begin
    php .\sql_server.php
    rem Wait 1000
    echo:
goto begin
