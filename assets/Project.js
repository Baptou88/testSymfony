console.log("Project Js Loaded !")
const base_url ="https://localhost:44305/api/"

document.addEventListener('DOMContentLoaded', (event) =>{
    const projetId = document.getElementById("projet_id").innerText
    var liste = document.createElement("ul")
    console.log(projetId)
    // httpRequest = new XMLHttpRequest();
    // httpRequest.onreadystatechange = function() {
    //     let Projet;
    //     if (httpRequest.readyState === XMLHttpRequest.DONE) {
    //         data = JSON.parse(httpRequest.responseText)
    //         console.log(data)
    //         data.forEach(element =>
    //
    //             //let Projet;
    //         Projet = document.createElement('li')
    //
    //     )
    //
    //
    //     } else {
    //         // pas encore prête
    //     }
    // };
    //httpRequest.open('GET', base_url + 'project?name=' + projetId, true);
    //httpRequest.send();

    // var myHeaders = new Headers();
    // myHeaders.append("crossDomain", "true");
    // myHeaders.append("Access-Control-Allow-Origin", "*");
    // fetch(base_url + 'project/search/' + projetId, {
    //     headers: myHeaders
    // }).then(function (response){
    //     console.log(response.json())
    //     }
    // )
})