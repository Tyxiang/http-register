@echo off
set  url=http://sm.fimik.com/test/
echo post %url%
echo.
ab -n 1000 -c 100 -p data.json %url% > %~n0.txt
echo.
pause