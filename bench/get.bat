@echo off
set  url=http://sm.fimik.com/
echo get %url%
echo.
ab -n 1000 -c 100 %url% > %~n0.txt
echo.
pause