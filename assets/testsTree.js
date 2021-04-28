console.log("testsTree.js chargé")

import * as THREE from 'three';

const scene = new THREE.Scene();

const threeNode = document.getElementById("three")
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


const line = new THREE.Line( geometry, material );

scene.add( line );
renderer.render( scene, camera );