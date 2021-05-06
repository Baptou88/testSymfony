
import * as THREE from 'three';
import {OrbitControls} from  'three/examples/jsm/controls/OrbitControls'

console.log("testsTree.js chargé")




const scene = new THREE.Scene();

const threeNode = document.getElementById("three");
const data = document.getElementById("data").innerText;
const dataparse = JSON.parse(data);
console.log(dataparse);
dataparse.forEach(element =>  {
    console.log(element);
    const el = document.getElementById("liste")
    const li = el.innerText += element['Name']

    element['Faces'].forEach(face => {
        const points = [];
        face['Vertices'].forEach(Vertice => {
            points.push( new THREE.Vector3( Vertice['coord']['X']*100, Vertice['coord']['Y']*100, Vertice['coord']['Z']*100 ) );
        })
        const geometry = new THREE.BufferGeometry().setFromPoints( points );
        const line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0xf000ff } ) );
        scene.add(line)
    })
})


const renderer = new THREE.WebGLRenderer();
renderer.setSize( threeNode.clientWidth , threeNode.clientHeight );
threeNode.appendChild(renderer.domElement);
console.log(threeNode);

const camera = new THREE.PerspectiveCamera( 45, threeNode.clientWidth / threeNode.clientHeight, 1, 500 );
camera.position.set( 50, -10, 50 );

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

scene.add(new THREE.AxesHelper(1));
//scene.add(new THREE.GridHelper(10,10))
//scene.add(cube);
//scene.add(helperxy);
// scene.add(planexz)
// scene.add(planeyz)

const dir = new THREE.Vector3( 1, 2, 0 );

//normalize the direction vector (convert to vector of length 1)
dir.normalize();




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


//
//
// scene.add( line );
renderer.render( scene, camera );

