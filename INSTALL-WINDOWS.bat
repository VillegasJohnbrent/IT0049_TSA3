@echo off
setlocal
cd /d "%~dp0"
where php >nul 2>nul
if errorlevel 1 if exist "C:\xampp\php\php.exe" set "PATH=C:\xampp\php;%PATH%"
where php >nul 2>nul
if errorlevel 1 goto missingphp
where composer >nul 2>nul
if errorlevel 1 goto missingcomposer
call composer install --no-interaction --prefer-dist
if errorlevel 1 goto failed
php artisan config:clear
if errorlevel 1 goto failed
php scripts/prepare.php
if errorlevel 1 goto failed
php artisan migrate --seed
if errorlevel 1 goto failed
php artisan test
if errorlevel 1 goto failed
echo.
echo Setup and tests completed. Run START-WINDOWS.bat to open the application.
pause
exit /b 0
:missingphp
echo PHP 8.2 or newer was not found. Install PHP or XAMPP and reopen this installer.
goto failed
:missingcomposer
echo Composer was not found. Install Composer from https://getcomposer.org/download/
echo Reopen this installer after installation.
goto failed
:failed
echo.
echo Setup stopped. Check the error above.
pause
exit /b 1
