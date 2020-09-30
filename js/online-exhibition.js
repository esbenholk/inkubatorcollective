
import * as THREE from '/wp-content/themes/inkubatorcollective/three/build/three.module.js';
import { PointerLockControls } from '/wp-content/themes/inkubatorcollective/three/examples/jsm/controls/PointerLockControls.js';

var camera, scene, renderer, controls, group;

var objects = [];
let movingtext = [];

var raycaster;

var moveForward = false;
var moveBackward = false;
var moveLeft = false;
var moveRight = false;
var canJump = false;

var prevTime = performance.now();
var velocity = new THREE.Vector3();
var direction = new THREE.Vector3();
var vertex = new THREE.Vector3();
var color = new THREE.Color();



let context = document.getElementById('threeDfrontpage')
let images= context.getElementsByTagName('img')


init();
animate();

function init() {
    const textureLoader = new THREE.TextureLoader();
    textureLoader.crossOrigin = "Anonymous";

    camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 1000 );
    camera.position.y = 10;
    scene = new THREE.Scene();
    scene.fog = new THREE.Fog(0x000000, 270, 400);
    var light = new THREE.HemisphereLight( 0xeeeeff, 0xffffff, 0.75 );
    light.position.set( 0.5, 1, 0.75 );
    scene.add( light );

    controls = new PointerLockControls( camera, document.body );

    var instructions = document.getElementById( 'buttons' );

    instructions.addEventListener( 'click', function () {
        controls.lock();
    }, false );

    controls.addEventListener( 'lock', function () {
        instructions.style.display = 'none';
    } );

    controls.addEventListener( 'unlock', function () {
        instructions.style.display = '';
   
    } );

    scene.add( controls.getObject() );

    var onKeyDown = function ( event ) {

        switch ( event.keyCode ) {

            case 38: // up
            case 87: // w
                moveForward = true;
                break;

            case 37: // left
            case 65: // a
                moveLeft = true;
                break;

            case 40: // down
            case 83: // s
                moveBackward = true;
                break;

            case 39: // right
            case 68: // d
                moveRight = true;
                break;

            case 32: // space
                if ( canJump === true ) velocity.y += 350;
                canJump = false;
                break;

        }

    };

    var onKeyUp = function ( event ) {

        switch ( event.keyCode ) {

            case 38: // up
            case 87: // w
                moveForward = false;
                break;

            case 37: // left
            case 65: // a
                moveLeft = false;
                break;

            case 40: // down
            case 83: // s
                moveBackward = false;
                break;

            case 39: // right
            case 68: // d
                moveRight = false;
                break;

        }

    };

    document.addEventListener( 'keydown', onKeyDown, false );
    document.addEventListener( 'keyup', onKeyUp, false );



    // floor
    function createfloor() {
      let ground = new THREE.PlaneGeometry(1000, 1000, 100, 100);
      ground.rotateX(-Math.PI / 2);
      var texture = new THREE.Texture(generateTexture());
      texture.needsUpdate = true; // important!
      var material = new THREE.MeshBasicMaterial({
        map: texture,
        overdraw: 0.5,
        opacity: 0.5
      });
      let floor = new THREE.Mesh(ground, material);
      floor.receiveShadow = true;
      scene.add(floor);
      function generateTexture() {
        var size = 20;
        let floorcolor = document.createElement("canvas");
        floorcolor.width = size;
        floorcolor.height = size;
        // get context
        var context = floorcolor.getContext("2d");
        // draw gradient
        context.rect(0, 0, size, size);
        var gradient = context.createLinearGradient(0, 0, size, size);
        gradient.addColorStop(0, "#ffffff");
        gradient.addColorStop(0.3, "#000000"); // light blue
        gradient.addColorStop(0.6, "#898989"); // dark blue
        gradient.addColorStop(0.8, "#ffffff"); // dark blue

        context.fillStyle = gradient;
        context.fill();

        return floorcolor;
      }
    }
    createfloor();

    var boxGeometry = new THREE.BoxGeometry(100, 100, 100);

    for (let i = 0; i < images.length; i++) {

        let boxImage, boxMaterial;
        boxImage = textureLoader.load(images[i].src);
        boxMaterial = new THREE.MeshBasicMaterial({
            map: boxImage
        });

        var box = new THREE.Mesh(boxGeometry, boxMaterial);

        box.position.x = Math.floor(Math.random() * 20 - 10) * 50;
        // box.position.y = Math.floor(Math.random() * 20) * 2;
        box.position.y = 45;
        box.position.z =  Math.floor(Math.random() * 20 - 10) * 50;
        box.castShadow = true;
        box.receiveShadow = true;
        // objects.push(box);
        box.rotateX = Math.floor(Math.random() * 20 - 10);
        objects.push(box);
        scene.add(box);
    }

    createCrystals(10, 20 );
    createCrystals(2, 100);
    function createCrystals(size, amount){
        var crystalGeometry = new THREE.OctahedronBufferGeometry( size, 1 );
        for (var i = 0; i < amount; i++) {
            let crystalImage, crystalMaterial;
            crystalImage = textureLoader.load("https://media.istockphoto.com/photos/hight-resolution-emerald-texture-picture-id157992082?k=6&m=157992082&s=170667a&w=0&h=3_xqJMTAt-DBTaeBXZVZfzdMJbtTWrz4AGc7WMYjDlM=");
            crystalMaterial = new THREE.MeshBasicMaterial({
              map: crystalImage, opacity: 0.1
            });

            var crystal = new THREE.Mesh(crystalGeometry, crystalMaterial);
            crystal.position.x = Math.floor(Math.random() * 20 - 10) * 50;
            // box.position.y = Math.floor(Math.random() * 20) * 2;
            crystal.position.y = 0;
            crystal.position.z = Math.floor(Math.random() * 20 - 10)*50;
            objects.push(crystal);
            scene.add(crystal);
        }
    }


    function createPNGplanes(sizex, sizey,  texture){
        var texture = new THREE.TextureLoader().load( texture);
        var geometry = new THREE.PlaneGeometry(sizex, sizey);
        var material = new THREE.MeshPhongMaterial({map: texture, color: 0xFFFFFF, });
        material.emissive.set(0x333333);
        material.shininess = 60;
        material.transparent = true
        var ldp = new THREE.Mesh(geometry, material);
        ldp.position.x = Math.floor(Math.random() * 20 - 10) * 50;
        ldp.position.y = 10;
        ldp.position.z =  ldp.position.x + Math.floor(Math.random() * 20 - 10);
        scene.add(ldp);
    }

    // createOtherShapes(12, 3, 50, "https://houseofkillingwebsite.s3.amazonaws.com/aniston/tarotreading.jpg")
    // createOtherShapes(50, 3, 150, "https://houseofkillingwebsite.s3.amazonaws.com/aniston/tarotreading.jpg")
    function createOtherShapes(size, amount, height, texture){
        var crystalGeometry = new THREE.OctahedronBufferGeometry( size, 4 );
        for (var i = 0; i < amount; i++) {
            let crystalImage, crystalMaterial;
            crystalImage = textureLoader.load(texture);
            crystalMaterial = new THREE.MeshBasicMaterial({
              map: crystalImage, opacity: 1
            });
            var crystal = new THREE.Mesh(crystalGeometry, crystalMaterial);
            crystal.position.x = Math.floor(Math.random() * 20 - 10) * 50;
            // box.position.y = Math.floor(Math.random() * 20) * 2;
            crystal.position.y = height;
            crystal.position.z = Math.floor(Math.random() * 20 - 10)*50;
            objects.push(crystal);
            scene.add(crystal);
        }
    }




   

    //


    renderer = new THREE.WebGLRenderer({
      antialias: true,
      alpha: true
    });
    let canvas = document.getElementById("canvas");
    renderer.setSize( window.innerWidth, window.innerHeight );

    renderer.setPixelRatio( window.devicePixelRatio );

    canvas.appendChild( renderer.domElement );

    //

    window.addEventListener( 'resize', onWindowResize, false );
    window.addEventListener( "mousemove", onDocumentMouseMove, false );
    group = new THREE.Group();
    scene.add( group );

}

function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight);

}

function animate() {

    requestAnimationFrame( animate );

    if ( controls.isLocked === true ) {

        raycaster.ray.origin.copy( controls.getObject().position );
        raycaster.ray.origin.y -= 10;

        var intersections = raycaster.intersectObjects( objects );

        var onObject = intersections.length > 0;

        var time = performance.now();
        var delta = ( time - prevTime ) / 1000;

        velocity.x -= velocity.x * 10.0 * delta;
        velocity.z -= velocity.z * 10.0 * delta;

        velocity.y -= 9.8 * 100.0 * delta; // 100.0 = mass

        direction.z = Number( moveForward ) - Number( moveBackward );
        direction.x = Number( moveRight ) - Number( moveLeft );
        direction.normalize(); // this ensures consistent movements in all directions

        if ( moveForward || moveBackward ) velocity.z -= direction.z * 400.0 * delta;
        if ( moveLeft || moveRight ) velocity.x -= direction.x * 400.0 * delta;

        if ( onObject === true ) {

            velocity.y = Math.max( 0, velocity.y );
            canJump = true;

        }

        controls.moveRight( - velocity.x * delta );
        controls.moveForward( - velocity.z * delta );

        controls.getObject().position.y += ( velocity.y * delta ); // new behavior

        if ( controls.getObject().position.y < 10 ) {

            velocity.y = 0;
            controls.getObject().position.y = 10;

            canJump = true;

        }

        prevTime = time;

    }

    renderer.render( scene, camera );

    for (var i = 0; i < objects.length; i++) {
      // boxes[i].rotation.y += 0.005;
      objects[i].rotation.y += 0.003;
      objects[i].position.y += 0.000003;
      objects[i].scale.y += 0.00001;
      objects[i].scale.x += 0.00001;
        objects[i].scale.z += 0.00001;
    }

    for (var i = 0; i < movingtext.length; i++) {
        movingtext[i].rotation.y += 0.003;
    }
}

var selectedObject = null;
function onDocumentMouseMove( event ) {
    event.preventDefault();
    if ( selectedObject ) {
        // selectedObject.material.color.set( '#69f' );
        console.log("object", selectedObject);
        selectedObject = null;
    }

    var intersects = getIntersects( event.layerX, event.layerY );
    if ( intersects.length > 0 ) {
        var res = intersects.filter( function ( res ) {
            return res && res.object;
        } )[ 0 ];

        if ( res && res.object ) {
            selectedObject = res.object;
            // selectedObject.material.color.set( '#f00' );
            console.log("object", selectedObject);
        }

    }

}
var raycaster = new THREE.Raycaster();
var mouseVector = new THREE.Vector3();
// raycaster = new THREE.Raycaster( new THREE.Vector3(), new THREE.Vector3( 0, - 1, 0 ), 0, 10 );

function getIntersects( x, y ) {

    x = ( x / window.innerWidth ) * 2 - 1;
    y = - ( y / window.innerHeight ) * 2 + 1;

    mouseVector.set( x, y, 0.5 );
    raycaster.setFromCamera( mouseVector, camera );

    return raycaster.intersectObject( group, true );

}