<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AR Schematics · Construction Simulator</title>
    <meta name="description" content="Preview GLB and glTF 3D construction plans in a browser-based augmented reality scene.">
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
    <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <main class="app-shell">
        <header class="topbar">
            <a class="brand" href="{{ route('ar.home') }}"><span class="brand-mark">AR</span><span>SCHEMATICS<small>CONSTRUCTION VIEWER</small></span></a>
            <span class="status"><i></i> LOCAL SESSION</span>
        </header>

        <section class="hero">
            <p class="eyebrow">3D PLAN VISUALIZATION / 01</p>
            <h1>Bring your plans<br><span>into the real world.</span></h1>
            <p class="intro">Load a 3D model, enter the camera view, and inspect your schematic in an immersive scene.</p>
        </section>

        <section class="workspace" aria-label="AR simulator controls">
            <div class="upload-card" id="upload-panel">
                <div class="upload-icon">↥</div>
                <p class="eyebrow">YOUR MODEL</p>
                <h2>Load a 3D plan</h2>
                <p class="muted">Choose a model from your device. Supported formats: .GLB and .GLTF.</p>
                <input id="file-upload" type="file" accept=".glb,.gltf,model/gltf-binary,model/gltf+json">
                <label for="file-upload" class="button button-primary">Select 3D file <span>↗</span></label>
                <p class="file-name" id="file-name">No model selected</p>
                <button id="start-ar" class="button button-green" disabled>Start AR simulation <span>→</span></button>
                <p class="fine-print">Your selected model stays in this browser session; it is not uploaded to a server.</p>
            </div>
            <div class="preview-card">
                <div class="preview-header"><span>VIEWPORT / 3D</span><span id="viewport-state">AWAITING MODEL</span></div>
                <div class="preview-art" id="preview-art">
                    <div class="wire-cube"><span></span></div>
                    <div class="preview-caption">YOUR DESIGN, IN SPACE.</div>
                </div>
                <div class="preview-footer"><span>AR SCHEMATICS ENGINE</span><span>GLB · GLTF</span></div>
            </div>
        </section>

        <section class="controls" id="scene-controls" hidden>
            <div><p class="eyebrow">SCENE CONTROLS</p><h2>Adjust your model</h2></div>
            <label>Scale <input id="scale-control" type="range" min="0.1" max="3" step="0.1" value="0.5"><output id="scale-value">0.5×</output></label>
            <label>Height <input id="height-control" type="range" min="-3" max="3" step="0.1" value="0"><output id="height-value">0.0</output></label>
            <button id="reset-scene" class="button button-secondary">Reset view</button>
            <button id="exit-ar" class="button button-secondary">Exit camera</button>
        </section>

        <section class="notice" id="notice" role="status" aria-live="polite">Select a 3D model to begin.</section>

        <footer class="footer"><span>AR SCHEMATICS</span><span>DESIGNED FOR PLAN REVIEW</span></footer>
    </main>

    <section id="ar-stage" class="ar-stage" hidden>
        <div class="stage-toolbar"><strong>AR / LIVE VIEW</strong><button id="close-stage" class="button button-secondary">Close view ✕</button></div>
        <a-scene id="ar-scene" embedded arjs="sourceType: webcam; debugUIEnabled: false;" renderer="alpha: true; antialias: true" vr-mode-ui="enabled: false" loading-screen="enabled: false">
            <a-entity id="model-container" position="0 0 -3" scale="0.5 0.5 0.5"></a-entity>
            <a-grid id="grid" geometry="primitive: plane; width: 100; height: 100" material="color: #5da9ff; opacity: 0.25; wireframe: true" position="0 -2 -10" rotation="-90 0 0"></a-grid>
            <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>
        </a-scene>
        <div class="stage-hint">Move your device slowly. Camera access requires HTTPS or localhost.</div>
    </section>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>