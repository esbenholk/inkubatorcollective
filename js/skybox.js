import * as THREE from '/wp-content/themes/krea/three/build/three.module.js';
import { PointerLockControls } from '/wp-content/themes/krea/three/examples/jsm/controls/PointerLockControls.js';
import { OrbitControls } from "/wp-content/themes/krea/three/examples/jsm/controls/OrbitControls.js";
import { Reflector } from '/wp-content/themes/krea/three/examples/jsm/objects/Reflector.js';
import { GLTFLoader } from '/wp-content/themes/krea/three/examples/jsm/loaders/GLTFLoader.js';
import { OBJLoader } from '/wp-content/themes/krea/three/examples/jsm/loaders/OBJLoader.js';

import { DeviceOrientationControls } from "/wp-content/themes/krea/three/examples/jsm/controls/DeviceOrientationControls.js";

var camera, scene, renderer, controls, device;
let collidableObjects = [];
let sky = document.getElementById('sky');

function init(controlSystem){
    const textureLoader = new THREE.TextureLoader();
    textureLoader.crossOrigin = "Anonymous";
    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        1,
        5000
    );
    camera.position.y = 75;
    camera.position.z = 500;

    scene = new THREE.Scene();
    if(controlSystem === "deviceorientation"){
        controls = new DeviceOrientationControls( camera );
    } else if(controlSystem === "orbitcontrol"){
        controls = new OrbitControls(camera, document.body);
        controls.update();

    }
    controls.noPan = true;
    controls.maxDistance = controls.minDistance = 10;  
    controls.noKeys = true;
    controls.noRotate = true;
    controls.noZoom = true;
    

    renderer = new THREE.WebGLRenderer({
                antialias: true,
                alpha: true
                });

    let canvas = document.getElementById("canvas");
    renderer.setSize( window.innerWidth, window.innerHeight );

    renderer.setPixelRatio( window.devicePixelRatio );
            
    canvas.appendChild( renderer.domElement );

    window.addEventListener("resize", onWindowResize, false);
    createAtmosphere(sky);
}

function createAtmosphere(background){
    console.log(background.src)
    var atmosphere = new THREE.SphereGeometry(900,32,32);
    var atmosphereMaterial = new THREE.MeshBasicMaterial({
        map: new THREE.TextureLoader().load(background.src),
        side: THREE.DoubleSide
    })
    sky = new THREE.Mesh(atmosphere, atmosphereMaterial)
    collidableObjects.push(sky);
    scene.add(sky);
}
function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}
function animate() {
    sky.rotation.y += 0.001;
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
    controls.update();
    }

    init("orbitcontrol");
    animate();


let buttons = document.getElementById('buttons');


document.getElementById("mobileToggle").onclick = function() {
    buttons.style.display="none";
    var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
    var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if (isSafari && iOS) {
        device = "desktop";
        decideEnvironment(device);
    } else{
        device = "mobile";
        decideEnvironment(device);
    }
    
 };

document.getElementById("desktopToggle").onclick = function() {
        device = "desktop";
        buttons.style.display="none";
        decideEnvironment(device);
};



function decideEnvironment(device){
    if(device === "desktop"){
        controls = new OrbitControls(camera, document.body);
        controls.update();
        }
    else if(device === "mobile"){
        controls = new DeviceOrientationControls( camera );
    }
    }