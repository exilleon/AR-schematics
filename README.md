# AR Schematics — AR Construction Schematic Simulator

A browser-based augmented reality (AR) prototype for viewing 3D construction plans. Users can upload a 3D model in `.glb` or `.gltf` format and launch a camera-based scene to preview the model.

## Features

- **3D model upload:** Select a local `.glb` or `.gltf` file from your device.
- **Browser-based 3D rendering:** Uses [A-Frame](https://aframe.io/) to display the model in a 3D scene.
- **Camera-enabled AR scene:** Uses [AR.js](https://ar-js-org.github.io/AR.js-Docs/) to provide camera-based AR functionality.
- **Grid reference:** Includes a wireframe grid to help visualize the scene.
- **Fullscreen view:** Attempts to enter fullscreen when the simulation starts.
- **Simple model animation:** Rotates the model container to provide a basic preview effect.

## Technologies Used

- HTML5
- CSS3
- JavaScript
- [A-Frame 1.4.0](https://aframe.io/)
- [AR.js](https://github.com/AR-js-org/AR.js)

The A-Frame and AR.js libraries are loaded from external URLs in `index.html`, so an internet connection is required for those dependencies.

## Project Structure

```text
AR-schematics/
├── index.html
├── artstation_challenge_-_untamed_-_cat_duelist.glb
└── package-lock.json
```

- **`index.html`** — Contains the page interface, styles, AR scene, and JavaScript logic.
- **`artstation_challenge_-_untamed_-_cat_duelist.glb`** — A sample 3D model asset included in the repository.
- **`package-lock.json`** — Lockfile present in the repository; the current project page does not require an npm build step.

## Getting Started

### Option 1: Run locally

1. Clone or download this repository:

   ```bash
   git clone https://github.com/exilleon/AR-schematics.git
   cd AR-schematics
   ```

2. Serve the project through a local HTTP server. For example, if Python is installed:

   ```bash
   python -m http.server 8000
   ```

3. Open [http://localhost:8000](http://localhost:8000) in your browser.
4. Select a `.glb` or `.gltf` model.
5. Click **Start AR Simulation** to open the scene.

A local server is recommended instead of opening the HTML file directly, because camera access and browser features may be restricted when a page is opened using a `file://` URL.

### Option 2: Deploy as a static website

You can host the HTML project using a static web host, such as GitHub Pages.

1. Open the repository's **Settings** on GitHub.
2. Find **Pages**.
3. Configure deployment from the branch containing `index.html` (typically `main`) and the repository root.
4. Save the settings and wait for GitHub Pages to publish the site.

For camera access, use the published HTTPS website and grant the browser camera permission when prompted. Device and browser compatibility may vary.

## How to Use

1. Open the simulator.
2. Choose **Select 3D Plan File**.
3. Select a local `.glb` or `.gltf` model.
4. Once the model is selected, click **Start AR Simulation**.
5. Allow camera access if requested and view the scene.

The included sample asset is a cat-duelist 3D model, not a construction plan; you can upload a suitable construction model to test the intended workflow.

## Current Limitations

- **Surface placement is not implemented yet.** The current code displays the model at a preset scene position; it does not perform real-world surface detection or WebXR hit testing.
- The AR experience depends on camera permissions, browser support, and the externally hosted libraries.
- The selected local model is loaded for the current browser session; the page does not upload it to a server or save it as a project.
- The model container uses a fixed scale and position, so different models may need adjustment.
- Fullscreen may be unavailable in some browsers or contexts.

## Future Improvements

- Add WebXR hit testing and real-world surface placement.
- Add controls for model position, rotation, and scale.
- Add loading and error feedback for unsupported or invalid model files.
- Provide a reset or re-upload option.
- Improve mobile layout and test across supported devices.
- Add construction-specific model examples and usage guidance.

## Contributing

1. Fork the repository.
2. Create a branch for your changes.
3. Make and test your updates.
4. Submit a pull request describing the changes.

## License

No license is currently specified in this repository. Unless a license is added, do not assume the project is available for unrestricted reuse or redistribution.
