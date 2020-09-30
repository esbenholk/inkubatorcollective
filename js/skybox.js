import * as THREE from '/wp-content/themes/inkubatorcollective/three/build/three.module.js';
import { OrbitControls } from "/wp-content/themes/inkubatorcollective/three/examples/jsm/controls/OrbitControls.js";
import { DeviceOrientationControls } from "/wp-content/themes/inkubatorcollective/three/examples/jsm/controls/DeviceOrientationControls.js";



var camera, scene, renderer, controls, device, sky;
let collidableObjects = [];
let canvas = document.getElementById("canvas");

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
        controls.enableDamping = true; // an animation loop is required when either damping or auto-rotation are enabled
				controls.dampingFactor = 0.05;

				controls.screenSpacePanning = false;

				controls.minDistance = 100;
				controls.maxDistance = 500;
 
    }
    controls.noPan = true;
    controls.maxDistance = controls.minDistance = 10;  
    controls.noKeys = true;
    controls.noRotate = true;
    controls.noZoom = true;
    
   
    if(canvas.children.length>0){
        canvas.removeChild(canvas.firstChild);
    }
    renderer = new THREE.WebGLRenderer( { antialias: true,  alpha: true } );
    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setSize( window.innerWidth, window.innerHeight );
    canvas.appendChild( renderer.domElement );

    window.addEventListener("resize", onWindowResize, false);
    createAtmosphere();
}

function createAtmosphere(){
    let texture = document.getElementById('sky');
    var atmosphere = new THREE.SphereGeometry(900,32,32);
    var atmosphereMaterial = new THREE.MeshBasicMaterial({
        map: new THREE.TextureLoader().load(texture.src),
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
    render();
}

 
function render() {

    renderer.render( scene, camera );

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
        init("orbitcontrol");
        animate();
    } else{
        device = "mobile";
        controls = new DeviceOrientationControls( camera );
    }
    
 };

document.getElementById("desktopToggle").onclick = function() {
        buttons.style.display="none";
        device = "desktop";

};



