(() => {
    const fileInput = document.getElementById('file-upload');
    const fileName = document.getElementById('file-name');
    const startButton = document.getElementById('start-ar');
    const notice = document.getElementById('notice');
    const viewportState = document.getElementById('viewport-state');
    const stage = document.getElementById('ar-stage');
    const scene = document.getElementById('ar-scene');
    const modelContainer = document.getElementById('model-container');
    const controls = document.getElementById('scene-controls');
    const scaleInput = document.getElementById('scale-control');
    const heightInput = document.getElementById('height-control');
    const scaleValue = document.getElementById('scale-value');
    const heightValue = document.getElementById('height-value');
    let modelUrl = null;
    let modelEntity = null;

    const announce = (message) => { notice.textContent = message; };

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files && event.target.files[0];
        if (!file) return;
        if (!/\.(glb|gltf)$/i.test(file.name)) {
            announce('Unsupported file. Please select a .glb or .gltf model.');
            fileInput.value = '';
            return;
        }
        if (modelUrl) URL.revokeObjectURL(modelUrl);
        modelUrl = URL.createObjectURL(file);
        fileName.textContent = file.name;
        startButton.disabled = false;
        startButton.innerHTML = 'Start AR simulation <span>→</span>';
        viewportState.textContent = 'MODEL READY';
        announce('Model selected. Start the AR simulation when you are ready.');
    });

    function applyTransform() {
        const scale = Number(scaleInput.value);
        const height = Number(heightInput.value);
        modelContainer.setAttribute('scale', {x: scale, y: scale, z: scale});
        modelContainer.setAttribute('position', {x: 0, y: height, z: -3});
        scaleValue.textContent = scale.toFixed(1) + '×';
        heightValue.textContent = height.toFixed(1);
    }

    async function startExperience() {
        if (!modelUrl) return;
        stage.hidden = false;
        controls.hidden = false;
        viewportState.textContent = 'CAMERA VIEW ACTIVE';
        announce('AR view started. If asked, allow camera access in your browser.');
        modelContainer.innerHTML = '';
        modelEntity = document.createElement('a-entity');
        modelEntity.setAttribute('gltf-model', modelUrl);
        modelEntity.setAttribute('rotation', '0 0 0');
        modelEntity.setAttribute('animation', 'property: rotation; to: 0 360 0; loop: true; dur: 20000; easing: linear');
        modelEntity.addEventListener('model-error', () => announce('The model could not be loaded. Check that the GLB/glTF file is valid and try again.'));
        modelContainer.appendChild(modelEntity);
        applyTransform();
        if (scene.hasLoaded) {
            scene.play();
        } else {
            scene.addEventListener('loaded', () => scene.play(), {once: true});
        }
        try {
            if (document.documentElement.requestFullscreen) await document.documentElement.requestFullscreen();
        } catch (_) {
            // Fullscreen is optional and may be denied by the browser.
        }
    }

    function closeExperience() {
        stage.hidden = true;
        controls.hidden = true;
        try { if (document.fullscreenElement) document.exitFullscreen(); } catch (_) {}
        if (scene.pause) scene.pause();
        viewportState.textContent = modelUrl ? 'MODEL READY' : 'AWAITING MODEL';
        announce('Camera view closed. Your selected model is still ready.');
    }

    startButton.addEventListener('click', startExperience);
    document.getElementById('close-stage').addEventListener('click', closeExperience);
    document.getElementById('exit-ar').addEventListener('click', closeExperience);
    document.getElementById('reset-scene').addEventListener('click', () => {
        scaleInput.value = '0.5';
        heightInput.value = '0';
        applyTransform();
        if (modelEntity) modelEntity.setAttribute('rotation', '0 0 0');
    });
    scaleInput.addEventListener('input', applyTransform);
    heightInput.addEventListener('input', applyTransform);
    window.addEventListener('beforeunload', () => {
        if (modelUrl) URL.revokeObjectURL(modelUrl);
    });
})();