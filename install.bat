@echo off
echo Installing Astrodia dependencies...

REM Check if Node.js is installed
where node >nul 2>nul
if %errorlevel% neq 0 (
    echo Node.js is not installed. Please install Node.js first.
    exit /b 1
)

REM Check if npm is installed
where npm >nul 2>nul
if %errorlevel% neq 0 (
    echo npm is not installed. Please install npm first.
    exit /b 1
)

REM Install dependencies
echo Installing npm packages...
call npm install

REM Build Tailwind CSS
echo Building Tailwind CSS...
call npm run build

REM Create necessary directories if they don't exist
if not exist "src\css" mkdir "src\css"
if not exist "assets\css" mkdir "assets\css"

echo Installation completed successfully!
echo.
echo To start development:
echo npm run dev    - Watch for CSS changes
echo npm run serve  - Start PHP development server
echo.
pause 