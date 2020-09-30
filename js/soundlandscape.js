
import * as THREE from '/wp-content/themes/inkubatorcollective/three/build/three.module.js';
import { PointerLockControls } from '/wp-content/themes/inkubatorcollective/three/examples/jsm/controls/PointerLockControls.js';
import { OrbitControls } from '/wp-content/themes/inkubatorcollective/three/examples/jsm/controls/OrbitControls.js';
import { PositionalAudioHelper } from '/wp-content/themes/inkubatorcollective/three/examples/jsm/helpers/PositionalAudioHelper.js';
import { GLTFLoader } from '/wp-content/themes/inkubatorcollective/three/examples/jsm/loaders/GLTFLoader.js';

        var scene, camera, renderer, controls;
        var raycaster = new THREE.Raycaster();

        var moveForward = false;
        var moveBackward = false;
        var moveLeft = false;
        var moveRight = false;
        var canJump = false;

        var objects = [];

        var prevTime = performance.now();
        var velocity = new THREE.Vector3();
        var direction = new THREE.Vector3();

       let counter = 0;
		var startButton = document.getElementById( 'buttons' );
		startButton.addEventListener( 'click', function(){
            if(counter<1){
                init();
            } else{
                controls.lock();
            }
            counter ++;
        });

		function init() {

			var container = document.getElementById( 'canvas' );

			//

			camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 100 );
            camera.position.set( 3, 0.2, 3 );
       

		
			scene = new THREE.Scene();
			scene.background = new THREE.Color( 0xa0a0a0 );
			scene.fog = new THREE.Fog( 0xa0a0a0, 2, 20 );

            //
            controls = new PointerLockControls( camera, document.body );

			var hemiLight = new THREE.HemisphereLight( 0xffffff, 0x444444 );
			hemiLight.position.set( 0, 20, 0 );
			scene.add( hemiLight );

			var dirLight = new THREE.DirectionalLight( 0xffffff );
			dirLight.position.set( 5, 5, 0 );
			dirLight.castShadow = true;
			dirLight.shadow.camera.top = 1;
			dirLight.shadow.camera.bottom = - 1;
			dirLight.shadow.camera.left = - 1;
			dirLight.shadow.camera.right = 1;
			dirLight.shadow.camera.near = 0.1;
			dirLight.shadow.camera.far = 20;
			scene.add( dirLight );

			// scene.add( new CameraHelper( dirLight.shadow.camera ) );

			//

			var mesh = new THREE.Mesh( new THREE.PlaneBufferGeometry( 50, 50 ), new THREE.MeshPhongMaterial( { color: 0x999999, depthWrite: false } ) );
			mesh.rotation.x = - Math.PI / 2;
			mesh.receiveShadow = true;
			scene.add( mesh );

			var grid = new THREE.GridHelper( 50, 50, 0x888888, 0x888888 );
            scene.add( grid );
            
             // ground

         

			//

			var listener = new THREE.AudioListener();
			camera.add( listener );

            function createBoomBox(id, x, y,z){
                var audioElement = document.getElementById( id);
                audioElement.play();

                var positionalAudio = new THREE.PositionalAudio( listener );
                positionalAudio.setMediaElementSource( audioElement );
                positionalAudio.setRefDistance( 1 );
                positionalAudio.setDirectionalCone( 180, 230, 0.1 );

                // var helper = new PositionalAudioHelper( positionalAudio, 0.1 );
                // positionalAudio.add( helper );

                //

                var gltfLoader = new GLTFLoader();
                gltfLoader.load( '/wp-content/themes/inkubatorcollective/BoomBox.glb', function ( gltf ) {

                    var boomBox = gltf.scene;
                    boomBox.position.set( x,y,z);
                    boomBox.scale.set( 20, 20, 20 );
                    boomBox.rotation.y = Math.random()*360;

                    boomBox.traverse( function ( object ) {

                        if ( object.isMesh ) {

                            object.geometry.rotateY( - Math.PI );
                            object.castShadow = true;

                        }

                    } );

                    boomBox.add( positionalAudio );
                    objects.push(boomBox)
                    scene.add( boomBox );
                

                } );

            }
			

            createBoomBoxes();
            async function createBoomBoxes(){
                await createBoomBox('music1',  0, 0.2, 0 )
                await createBoomBox('music2',  1, 0.2, -5 )
                await createBoomBox('music3',  5, 0.2, -10 )
                await createBoomBox('music4',  -10, 0.2, -7 )
                await createBoomBox('music5',  -2, 0.2, 5 )
                controls.lock();
                animate();

            }

           

            controls.addEventListener( 'lock', function () {
                startButton.style.display = 'none';
            } );

           
        
            controls.addEventListener( 'unlock', function () {
                startButton.style.display = '';
            } );





			//

			renderer = new THREE.WebGLRenderer( { antialias: true } );
			renderer.setSize( window.innerWidth, window.innerHeight );
			renderer.setPixelRatio( window.devicePixelRatio );
			renderer.outputEncoding = THREE.sRGBEncoding;
			renderer.shadowMap.enabled = true;
			container.appendChild( renderer.domElement );

			//

			// var controls = new OrbitControls( camera, renderer.domElement );
			// controls.target.set( 0, 0.1, 0 );
			// controls.update();
			// controls.minDistance = 0.5;
			// controls.maxDistance = 10;
			// controls.maxPolarAngle = 0.5 * Math.PI;

            //
            


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


			window.addEventListener( 'resize', onWindowResize, false );

		}

		function onWindowResize() {

			camera.aspect = window.innerWidth / window.innerHeight;
			camera.updateProjectionMatrix();

			renderer.setSize( window.innerWidth, window.innerHeight );

		}

		function animate() {

			requestAnimationFrame( animate );
            renderer.render( scene, camera );
            
            if ( controls.isLocked === true ) {

                raycaster.ray.origin.copy( controls.getObject().position );
                raycaster.ray.origin.y -= 10;
        
                var intersections = raycaster.intersectObjects( objects );
        
                var onObject = intersections.length > 0;

               
        
                var time = performance.now();
                var delta = ( time - prevTime ) / 1000;
        
                velocity.x -= velocity.x * 1.0 * delta;
                velocity.z -= velocity.z * 1.0 * delta;
        
                velocity.y -= delta; // 100.0 = mass
        
                direction.z = Number( moveForward ) - Number( moveBackward );
                direction.x = Number( moveRight ) - Number( moveLeft );
                direction.normalize(); // this ensures consistent movements in all directions

                if ( onObject === true ) {

                    velocity.y = Math.max( 0, velocity.y );
                    canJump = true;
        
                }
        
                if ( moveForward || moveBackward ) velocity.z -= direction.z * 1 * delta;
                if ( moveLeft || moveRight ) velocity.x -= direction.x * 1 * delta;
        
        
                controls.moveRight( - velocity.x * delta );
                controls.moveForward( - velocity.z * delta );
        
         
        
                prevTime = time;
        
            }

		}
