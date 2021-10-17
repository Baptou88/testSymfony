
import * as THREE from 'three';
import {OrbitControls} from  'three/examples/jsm/controls/OrbitControls'
import {GUI} from "three/examples/jsm/libs/dat.gui.module";
import Stats from "three/examples/jsm/libs/stats.module";



console.log("testsTree.js chargé")




const scene = new THREE.Scene();
const raycaster = new THREE.Raycaster()
const mouse = new THREE.Vector2()
let stats;

function onMouseMove( event ) {

    // calculate mouse position in normalized device coordinates
    // (-1 to +1) for both components

    mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
    mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

}

const threeNode = document.getElementById("three");
const data = document.getElementById("data").innerText;
const dataparse = JSON.parse(data);
console.log(dataparse);
stats = new Stats();
threeNode.appendChild(stats.dom)
dataparse.forEach(element =>  {
    console.log(element);
    const el = document.getElementById("liste")
    const li = el.innerText += element['Name']

    element['Faces'].forEach(face => {
        const points = [];

        face['Vertices'].forEach(Vertice => {
            points.push( new THREE.Vector3( Vertice['coord']['X']*100, Vertice['coord']['Y']*100, Vertice['coord']['Z']*100 ) );

        })


         if (face['FacesSurfaceType'] == "Plane"){
             // const faceShape = new THREE.Shape(points)
             // const mesh = new THREE.Mesh(
             //     faceShape,
             //     new THREE.MeshBasicMaterial({color: 0x00ff00,opacity:0.5, transparent:true}))
             // //mesh.layers.set(1)
             // scene.add(mesh)
         }

        face['Edges'].forEach(Edge =>{
            const points2 = [];
            points2.push(new THREE.Vector3(Edge['StartVertexId']['coord']['X'] * 10, Edge['StartVertexId']['coord']['Y'] * 10, Edge['StartVertexId']['coord']['Z'] * 10));
            points2.push(new THREE.Vector3(Edge['EndVertexId']['coord']['X'] * 10, Edge['EndVertexId']['coord']['Y'] * 10, Edge['EndVertexId']['coord']['Z'] * 10));
            const line2 = new THREE.Line(
                new THREE.BufferGeometry().setFromPoints(points2),
                new THREE.LineBasicMaterial({color: 0xffaa00})
            )
            line2.layers.set(2)
            scene.add(line2)
        })

        const geometry = new THREE.BufferGeometry().setFromPoints( points );
        const line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0xf000ff } ) );
        line.layers.set(1)
        scene.add(line)

    })


    element['Edges'].forEach(Edge => {
        const points3 = [];
        points3.push(new THREE.Vector3(Edge['StartVertexId']['coord']['X'] * 1000, Edge['StartVertexId']['coord']['Y'] * 1000, Edge['StartVertexId']['coord']['Z'] * 1000));
        points3.push(new THREE.Vector3(Edge['EndVertexId']['coord']['X'] * 1000, Edge['EndVertexId']['coord']['Y'] * 1000, Edge['EndVertexId']['coord']['Z'] * 1000));
        let color = 0xbbdd00
        if (Edge['TypeCurve'] == "Circle"){
            color = 0xbbddbb
            const circle = new THREE.CubicBezierCurve3(
                new THREE.Vector3(Edge['StartVertexId']['coord']['X'] * 1000, Edge['StartVertexId']['coord']['Y'] * 1000, Edge['StartVertexId']['coord']['Z'] * 1000),
                new THREE.Vector3(Edge['P1']['X'] * 1000 , Edge['P1']['Y'] * 1000, Edge['P1']['Z'] * 1000),
                new THREE.Vector3(Edge['P2']['X'] * 1000 , Edge['P2']['Y'] * 1000, Edge['P2']['Z'] * 1000),
                new THREE.Vector3(Edge['EndVertexId']['coord']['X'] * 1000, Edge['EndVertexId']['coord']['Y'] * 1000, Edge['EndVertexId']['coord']['Z'] * 1000)
            )
            const geometryH = new THREE.BufferGeometry().setFromPoints(
                [new THREE.Vector3(Edge['P1']['X'] * 1000 , Edge['P1']['Y'] * 1000, Edge['P1']['Z'] * 1000),
                new THREE.Vector3(Edge['P2']['X'] * 1000 , Edge['P2']['Y'] * 1000, Edge['P2']['Z'] * 1000)]
            );
            const edgesH = new THREE.EdgesGeometry( geometryH );
            const lineH = new THREE.LineSegments( edgesH, new THREE.LineBasicMaterial( { color: 0xff22ff } ) );
            scene.add( lineH );
            const points = circle.getPoints(20)
            const lignes = new THREE.Line(
                new THREE.BufferGeometry().setFromPoints(points),
                new THREE.LineBasicMaterial({color: color})
            )
            scene.add(lignes)
        } else if(Edge['TypeCurve'] === "Line" ){
            const lignes = new THREE.Line(
                new THREE.BufferGeometry().setFromPoints(points3),
                new THREE.LineBasicMaterial({color: color})
            )
            scene.add(lignes)
        } else {
            console.log(Edge['TypeCurve'])
        }

    })
})


const renderer = new THREE.WebGLRenderer();
renderer.setSize( threeNode.clientWidth , threeNode.clientHeight );
threeNode.appendChild(renderer.domElement);
console.log(threeNode);

const camera = new THREE.PerspectiveCamera( 45, threeNode.clientWidth / threeNode.clientHeight, 1, 10000 );
camera.position.set( 100, -20, 100 );

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
const helperxy = new THREE.PlaneHelper( planexyhelper, 10, 0x22faff );

const controls = new OrbitControls( camera, renderer.domElement );

//scene.add(camera);

scene.add(new THREE.AxesHelper(1));
//scene.add(new THREE.GridHelper(10,10))
//scene.add(cube);
scene.add(helperxy);
// scene.add(planexz)
// scene.add(planeyz)
scene.remove(helperxy)
const dir = new THREE.Vector3( 1, 2, 0 );

//normalize the direction vector (convert to vector of length 1)
dir.normalize();


const layers = {

    'toggle 0': function () {

        camera.layers.toggle( 0 );

    },

    'toggle 1': function () {

        camera.layers.toggle( 1 );

    },

    'toggle 2': function () {

        camera.layers.toggle( 2 );

    },

    'enable all': function () {

        camera.layers.enableAll();

    },

    'disable all': function () {

        camera.layers.disableAll();

    }

};


//
// Init gui
const gui = new GUI();
gui.add( layers, 'toggle 0' );
gui.add( layers, 'toggle 1' );
gui.add( layers, 'toggle 2' );
gui.add( layers, 'enable all' );
gui.add( layers, 'disable all' );


function tick() {
    //renderer.render( scene, camera );
    render();
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
function render() {

    // update the picking ray with the camera and mouse position
    //raycaster.setFromCamera( mouse, camera );

    // calculate objects intersecting the picking ray
    // const intersects = raycaster.intersectObjects( scene.children );
    //
    // for ( let i = 0; i < intersects.length; i ++ ) {
    //
    //     //intersects[ i ].object.material.color.set( 0xff0000 );
    //     console.log(intersects[i])
    // }
    //controls.update();
    renderer.render( scene, camera );

}
//render();
window.addEventListener( 'mousemove', onMouseMove, false );
//window.requestAnimationFrame(render);