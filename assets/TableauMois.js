console.log("TableauMois")

// for (const el in document.querySelectorAll(".tm-days")) {
//     console.log(el)
// }
function test(el,event){
    
}

function bindSelect(el) {
    el.addEventListener('click', function(el) {
        // alert( this.getAttribute("day"))
        console.log(this.dataset.day)
        //console.log("/heureprojet/new?d=" + encodeURIComponent(this.dataset.day)+ "&m=" + encodeURIComponent(this.dataset.month) + "&y=" + encodeURIComponent(this.dataset.year));
        window.location = "/heureprojet/new?d=" + encodeURIComponent(this.dataset.day)+ "&m=" + encodeURIComponent(this.dataset.month) + "&y=" + encodeURIComponent(this.dataset.year);
    })

}
Array.from(document.querySelectorAll('.tm-days')).map(bindSelect)