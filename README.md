# AR Schematics — Laravel 13

Laravel 13 conversion of the AR Construction Schematic Simulator. The UI uses Blade, with A-Frame and AR.js for 3D rendering and camera preview.

## Requirements
- PHP 8.3+
- Composer 2
- A WebGL-capable browser and camera permission
- Internet access for A-Frame and AR.js CDN assets

## Setup
```bash
git clone https://github.com/exilleon/AR-schematics.git
cd AR-schematics
git switch laravel-13-conversion
composer install
```

On Windows PowerShell:
```powershell
Copy-Item .env.example .env
New-Item -ItemType File -Force database/database.sqlite
php artisan key:generate
php artisan serve
```

On macOS/Linux:
```bash
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan serve
```

Open http://127.0.0.1:8000. If Composer reports a PHP constraint, install the PHP version required by Laravel 13 and its dependencies.

## Use
1. Select a local `.glb` or `.gltf` file.
2. Click **Start AR simulation** and allow camera access.
3. Adjust model scale and height, then close the camera view to return.

The selected model is loaded locally in the browser and is not uploaded to Laravel. Camera access generally requires HTTPS except on localhost. The current prototype does not implement WebXR surface detection or persistent model uploads.

## Key files
- `routes/web.php` — homepage and health routes
- `resources/views/ar-simulator.blade.php` — Blade interface and AR scene
- `public/css/app.css` — responsive styling
- `public/js/app.js` — model selection and scene controls
- `bootstrap/app.php` — Laravel 13 bootstrap

The original `index.html` and existing model assets are retained for reference. Run this app through Laravel, not as a static HTML site.
