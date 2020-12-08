import * as THREE from '/wp-content/themes/house_of_killing/three/build/three.module.js';
import { OrbitControls } from '/wp-content/themes/house_of_killing/three/examples/jsm/controls/OrbitControls.js';
import { Reflector } from '/wp-content/themes/inkubatorcollective/three/examples/jsm/objects/Reflector.js';




let canvas = document.getElementById("canvas");
var audio = document.getElementById("audio");

let container = document.getElementById("audio-container");
container.append(audio)

const manager = new THREE.LoadingManager();

manager.onLoad = function ( ) {

    console.log( 'Loading complete!');
    document.getElementById('loading-screen').remove()

};


manager.onProgress = function ( url, itemsLoaded, itemsTotal ) {

};

manager.onError = function ( url ) {

    console.log( 'There was an error loading ' + url );
    document.getElementById('loading-status').innerHTML = "<div class='missing-content'><img src='/wp-content/themes/house_of_killing/icons/ghosticon.png'/><p>missing content</p></div>"

};

var loader = new THREE.TextureLoader(manager);

let count = 0, cubeCamera1, cubeCamera2, cubeRenderTarget1, cubeRenderTarget2;

let light1, light2, light3, light4, light5, light6, flashlight;

let theta = 0;
let radius = 17;

let start = document.getElementById("startbutton")
start.addEventListener('click', function(ev) { play(); });



//initialise simplex noise instance
var noise = new SimplexNoise();
  
function play() {
    var context = new AudioContext();
    var src = context.createMediaElementSource(audio);
    var analyser = context.createAnalyser();
    src.connect(analyser);
    analyser.connect(context.destination);
    analyser.fftSize = 512;
    var bufferLength = analyser.frequencyBinCount;
    var dataArray = new Uint8Array(bufferLength);

    //here comes the webgl
    var scene = new THREE.Scene();
    var group = new THREE.Group();
    var camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0,0,100);
    camera.lookAt(scene.position);
    scene.add(camera);

    scene.background = new THREE.Color(0x000000)
    scene.fog = new THREE.FogExp2( 0x000000, 0.0025 );
    var renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);


    cubeRenderTarget1 = new THREE.WebGLCubeRenderTarget( 256, {
        format: THREE.RGBFormat,
        generateMipmaps: true,
        minFilter: THREE.LinearMipmapLinearFilter,
        encoding: THREE.sRGBEncoding // temporary -- to prevent the material's shader from recompiling every frame
    } );

    cubeCamera1 = new THREE.CubeCamera( 1, 1000, cubeRenderTarget1 );

    cubeRenderTarget2 = new THREE.WebGLCubeRenderTarget( 256, {
        format: THREE.RGBFormat,
        generateMipmaps: true,
        minFilter: THREE.LinearMipmapLinearFilter,
        encoding: THREE.sRGBEncoding
    } );

    cubeCamera2 = new THREE.CubeCamera( 1, 1000, cubeRenderTarget2 );

    //
    var material = new THREE.MeshBasicMaterial( {
        envMap: cubeRenderTarget2.texture,
        combine: THREE.MultiplyOperation,
        reflectivity: 1
    } );

  


    const skytexture = loader.load( "/wp-content/themes/house_of_killing/images/sky.png" );
    const groundtexture = loader.load( "/wp-content/themes/house_of_killing/images/ground.png" );


    var planeGeometry = new THREE.PlaneGeometry(400, 400, 20, 20);
    var skyplaneMaterial = new THREE.MeshPhongMaterial({
            color:     0xFFFFFF, 
            specular:  0x050505,
            shininess: 100,
            map: skytexture,
            vertexColors: THREE.VertexColors, 
            side: THREE.DoubleSide
        }) 
    var groundplaneMaterial = new THREE.MeshPhongMaterial({
            color:     0xFFFFFF, 
            specular:  0x050505,
            shininess: 100,
            map: groundtexture,
            vertexColors: THREE.VertexColors, 
            side: THREE.DoubleSide
        })

    
    var plane = new THREE.Mesh(planeGeometry, skyplaneMaterial);
    plane.rotation.x = -0.50 * Math.PI;
    plane.position.set(0, 30, 0);
    group.add(plane);
    
    var plane2 = new THREE.Mesh(planeGeometry, groundplaneMaterial);
    plane2.rotation.x = -0.50 * Math.PI;
    plane2.position.set(0, -30, 0);
    group.add(plane2);

    var icosahedronGeometry = new THREE.IcosahedronGeometry(10, 20);



    var lambertMaterial = new THREE.MeshPhongMaterial({
        color:     0x996633, 
        specular:  0x050505,
        shininess: 10,
        map: skytexture,
        vertexColors: THREE.VertexColors, 
        side: THREE.DoubleSide
    })

   

    // var lambertMaterial = new THREE.MeshLambertMaterial({
    //     color: 0xff00ee,
    //     wireframe: true
    // });

    var ball = new THREE.Mesh(icosahedronGeometry, material);
    ball.position.set(0, 0, 0);
    scene.add(ball);

    var ambientLight = new THREE.AmbientLight(0xff89f9);
    scene.add(ambientLight);


    // var orbitControls = new OrbitControls(camera, renderer.domElement);
    // orbitControls.autoRotate = true;
    

    const sphere = new THREE.SphereBufferGeometry( 0.001, 16, 8 );
    let spherematerial =  new THREE.MeshBasicMaterial( { color: 0xff0040, transparent: true } )
    spherematerial.opacity = 0;

    light1 = new THREE.PointLight( 0xff0040, 1, 30 );
    light1.add( new THREE.Mesh( sphere, spherematerial ) );
    scene.add( light1 );

    light2 = new THREE.PointLight( 0x0040ff, 3, 200 );
    light2.add( new THREE.Mesh( sphere, spherematerial));
    scene.add( light2 );

    light3 = new THREE.PointLight( 0x2CFC0A, 0.5, 300 );
    light3.add( new THREE.Mesh( sphere, spherematerial ) );
    scene.add( light3 );

    light4 = new THREE.PointLight( 0xffaa00, 0.1, 500 );
    light4.add( new THREE.Mesh( sphere, spherematerial ) );
    scene.add( light4 );

    light5 = new THREE.PointLight( 0xff0040, 3, 100 );
    light5.add( new THREE.Mesh( sphere, spherematerial ) );
    scene.add( light5 );

    light6 = new THREE.PointLight( 0x2CFC0A, 1, 700 );
    light6.add( new THREE.Mesh( sphere, spherematerial ) );
    scene.add( light6 );




    scene.add(group);

    canvas.appendChild(renderer.domElement);

    window.addEventListener('resize', onWindowResize, false);

    render();

    function render() {

        analyser.getByteFrequencyData(dataArray);

        var lowerHalfArray = dataArray.slice(0, (dataArray.length/2) - 1);
        var upperHalfArray = dataArray.slice((dataArray.length/2) - 1, dataArray.length - 1);

        var overallAvg = avg(dataArray);
        var lowerMax = max(lowerHalfArray);
        var lowerAvg = avg(lowerHalfArray);
        var upperMax = max(upperHalfArray);
        var upperAvg = avg(upperHalfArray);

        var lowerMaxFr = lowerMax / lowerHalfArray.length;
        var lowerAvgFr = lowerAvg / lowerHalfArray.length;
        var upperMaxFr = upperMax / upperHalfArray.length;
        var upperAvgFr = upperAvg / upperHalfArray.length;

        makeRoughGround(plane, modulate(upperAvgFr, 0, 1, 0.5, 4));
        makeRoughGround(plane2, modulate(lowerMaxFr, 0, 1, 0.5, 4));
        
        makeRoughBall(ball, modulate(Math.pow(lowerMaxFr, 0.8), 0, 1, 0, 8), modulate(upperAvgFr, 0, 1, 0, 4));

        group.rotation.y += 0.005;
        renderer.render(scene, camera);
        requestAnimationFrame(render);


        if ( count % 2 === 0 ) {

        cubeCamera1.update( renderer, scene );
        material.envMap = cubeRenderTarget1.texture;
            
        } else {

            cubeCamera2.update( renderer, scene );
            material.envMap = cubeRenderTarget2.texture;

        }

        count ++;

        const time = Date.now() * 0.00025;
        const d = 0.5;


        light1.position.x = Math.sin( time * 0.7 ) * 15;
        light1.position.y = Math.cos( time * 0.5 ) * 22;
        light1.position.z = Math.cos( time * 0.3 ) * 20;
      
        light2.position.x = Math.cos( time * 0.3 ) * 30;
        light2.position.y = Math.sin( time * 0.5 ) * 40;
        light2.position.z = Math.sin( time * 0.7 ) * 30;
      
        light3.position.x = Math.sin( time * 0.7 ) * 30;
        light3.position.y = Math.cos( time * 0.3 ) * 40;
        light3.position.z = Math.sin( time * 0.5 ) * 30;
      
        light4.position.x = Math.sin( time * 0.3 ) * 30;
        light4.position.y = Math.cos( time * 0.7 ) * 40;
        light4.position.z = Math.sin( time * 0.5 ) * 30;
        
        light5.position.x = Math.sin( time * 0.3 ) * 20;
        light5.position.y = Math.cos( time * 0.7 ) * 20;
        light5.position.z = Math.sin( time * 0.5 ) * 20;
        
        light6.position.x = Math.sin( time * 0.3 ) * 30;
        light6.position.y = Math.cos( time * 0.7 ) * 40;
        light6.position.z = Math.sin( time * 0.5 ) * 30;


    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    function makeRoughBall(mesh, bassFr, treFr) {
        mesh.geometry.vertices.forEach(function (vertex, i) {
            var offset = mesh.geometry.parameters.radius;
            var amp = 0.7;
            var time = window.performance.now();
            vertex.normalize();
            var rf = 0.1;
            var distance = (offset + bassFr ) + noise.noise3D(vertex.x + time *rf*7, vertex.y +  time*rf*8, vertex.z + time*rf*9) * amp * treFr;
            vertex.multiplyScalar(distance);
        });
        mesh.geometry.verticesNeedUpdate = true;
        mesh.geometry.normalsNeedUpdate = true;
        mesh.geometry.computeVertexNormals();
        mesh.geometry.computeFaceNormals();
    }

    function makeRoughGround(mesh, distortionFr) {
        mesh.geometry.vertices.forEach(function (vertex, i) {
            var amp = 3;
            var time = Date.now()/5;
            var distance = (noise.noise2D(vertex.x + time * 0.0003, vertex.y + time * 0.0001) + 0) * distortionFr * amp;
            vertex.z = distance;
        });
        mesh.geometry.verticesNeedUpdate = true;
        mesh.geometry.normalsNeedUpdate = true;
        mesh.geometry.computeVertexNormals();
        mesh.geometry.computeFaceNormals();
    }

  

    window.addEventListener( 'resize', onWindowResize, false );

    audio.play();
    audio.style.display = 'block';
};





//some helper functions here
function fractionate(val, minVal, maxVal) {
    return (val - minVal)/(maxVal - minVal);
}

function modulate(val, minVal, maxVal, outMin, outMax) {
    var fr = fractionate(val, minVal, maxVal);
    var delta = outMax - outMin;
    return outMin + (fr * delta);
}

function avg(arr){
    var total = arr.reduce(function(sum, b) { return sum + b; });
    return (total / arr.length);
}

function max(arr){
    return arr.reduce(function(a, b){ return Math.max(a, b); })
}


function onWindowResize() {

  

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
  
    renderer.setSize( window.innerWidth, window.innerHeight );
  
  }