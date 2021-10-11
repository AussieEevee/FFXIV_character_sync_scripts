@echo off
echo This will copy your UI to all your characters.
pause

if exist _baseui\HOTBAR.DAT (
	echo HOTBAR.DAT is present. This will override your hotbar settings. Do you still wish to continue?
	pause
)

if exist _baseui\GEARSET.DAT del _baseui\GEARSET.DAT
if exist _baseui\ITEMFDR.DAT del _baseui\ITEMFDR.DAT
if exist _baseui\ITEMODR.DAT del _baseui\ITEMODR.DAT
echo. 
FOR /D %%G in ("FFXIV*") DO CALL :DoCopy %%~nxG
pause
exit 

:DoCopy
if exist %~1\_character.txt (
	set /p name=<%~1\_character.txt
) else (
	set name=No character file
)


echo Copying files to %name% (%~1)...
copy /V /Y _baseui\*.* %~1\*.* > nul
IF NOT EXIST "%~1\HOTBAR.DAT" COPY _baseui\HOTBAR.DAT.source %~1\HOTBAR.DAT
if exist %~1\HOTBAR.DAT.source del %~1\HOTBAR.DAT.source
echo Done!
echo. 
exit /b 0



