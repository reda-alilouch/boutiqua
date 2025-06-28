#!/bin/bash

echo "Installing Astrodia dependencies..."

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "Node.js is not installed. Please install Node.js first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "npm is not installed. Please install npm first."
    exit 1
fi

# Install dependencies
echo "Installing npm packages..."
npm install

# Build Tailwind CSS
echo "Building Tailwind CSS..."
npm run build

# Create necessary directories
mkdir -p src/css
mkdir -p assets/css

echo "Installation completed successfully!"
echo
echo "To start development:"
echo "npm run dev    - Watch for CSS changes"
echo "npm run serve  - Start PHP development server"
echo 