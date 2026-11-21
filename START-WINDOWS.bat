@echo off
setlocal
cd /d "%~dp0"
where php >nul 2>nul
if errorlevel 1 if exist "C:\xampp\php\php.exe" set "PATH=C:\xampp\php;%PATH%"
if not exist "vendor\autoload.php" goto missing
if not exist ".env" goto missing
echo Open http://127.0.0.1:8000 in your browser. Keep this window open.
php artisan serve --host=127.0.0.1 --port=8000
pause
exit /b
:missing
echo Run INSTALL-WINDOWS.bat first.
pause
exit /b 1
