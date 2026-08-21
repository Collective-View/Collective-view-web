@echo off
set GIT="C:\Program Files\Git\cmd\git.exe"
set LOG=C:\xampp\htdocs\deploy-log.txt

cd /d C:\xampp\htdocs\dist

echo ===== %date% %time% ===== > "%LOG%"
echo Directorio actual: >> "%LOG%"
cd >> "%LOG%"

%GIT% init >> "%LOG%" 2>&1
%GIT% remote remove origin >> "%LOG%" 2>&1
%GIT% remote add origin https://github.com/Collective-View/Repositorio-Collective-view-web.git >> "%LOG%" 2>&1
%GIT% branch -M main >> "%LOG%" 2>&1
%GIT% add . >> "%LOG%" 2>&1
%GIT% commit -m "export automatico %date% %time%" >> "%LOG%" 2>&1
%GIT% push -u origin main --force >> "%LOG%" 2>&1

exit /b 0