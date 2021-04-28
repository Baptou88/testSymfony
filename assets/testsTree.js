import * as THREE from 'three';
import {OrbitControls} from  'three/examples/jsm/controls/OrbitControls'

console.log("testsTree.js chargé")
let data = JSON.parse(document.getElementById("data").innerText)
console.log("data: " + data)
for (const property in data){
    console.log(property)
}
const scene = new THREE.Scene();

const threeNode = document.getElementById("three")
const renderer = new THREE.WebGLRenderer({
    antialias: true,
});
renderer.setSize( threeNode.clientWidth , threeNode.clientHeight );
//renderer.setPixelRatio()
threeNode.appendChild(renderer.domElement);
console.log(threeNode);


const camera = new THREE.PerspectiveCamera( 75, threeNode.clientWidth / threeNode.clientHeight, 1, 500 );
camera.position.set( 5, 5, 5 );
camera.lookAt( 0, 0, 0 );



const material = new THREE.LineBasicMaterial( { color: 0x0000ff } );


const points = [];
points.push( new THREE.Vector3( - 10, 0, 0 ) );
points.push( new THREE.Vector3( 0, 10, 0 ) );
points.push( new THREE.Vector3( 10, 0, 0 ) );
points.push(new THREE.Vector3(10,0,40))

const geometry = new THREE.BufferGeometry().setFromPoints( points );

const cube = new THREE.Mesh(
    new THREE.BoxBufferGeometry(1,1,1),
    new THREE.MeshNormalMaterial()
)

const line = new THREE.Line( geometry, material );
const planexy = new THREE.Mesh(
    new THREE.PlaneGeometry(2,1,1),
    new THREE.MeshBasicMaterial({
        color : 0x0000ff,
        side: THREE.DoubleSide
    }))
const planexz = new THREE.Mesh(
    new THREE.PlaneGeometry(2,1,1),
    new THREE.MeshNormalMaterial({
        side: THREE.DoubleSide
    }))
planexz.rotateX(1.5707)

const planeyz = new THREE.Mesh(
    new THREE.PlaneGeometry(2,1,1),
    new THREE.MeshNormalMaterial({
        side: THREE.DoubleSide
    }))
planeyz.rotateY(1.5707)

const planexyhelper = new THREE.Plane( new THREE.Vector3( -10, 0, 0 ), 3 );
const helperxy = new THREE.PlaneHelper( planexyhelper, 10, 0xfffa00 );

const controls = new OrbitControls( camera, renderer.domElement );

//scene.add(camera);
scene.add( line );
scene.add(new THREE.AxesHelper(1));
scene.add(new THREE.GridHelper(10,10))
//scene.add(cube);
 scene.add(helperxy);
// scene.add(planexz)
// scene.add(planeyz)

const dir = new THREE.Vector3( 1, 2, 0 );

//normalize the direction vector (convert to vector of length 1)
dir.normalize();

const origin = new THREE.Vector3( 0, 0, 0 );
const length = 1;
const hex = 0xffff00;

const arrowHelper = new THREE.ArrowHelper( dir, origin, length, hex );
scene.add( arrowHelper );

function tick() {
    renderer.render( scene, camera );
    // camera.position.x += .1;
    // camera.lookAt(0,0,0)
    controls.update();
    requestAnimationFrame(tick);
}
tick();
// window.addEventListener('resize',()=> {
//     camera.aspect = threeNode.clientWidth / threeNode.clientHeight
//     camera.updateProjectionMatrix()
//     renderer.setSize(threeNode.clientWidth / threeNode.clientHeight)
// })