import * as bootstrap from 'bootstrap';
import '../sass/app.scss';
import Alpine from 'alpinejs';


window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function() {

    let checkboxes = document.querySelectorAll(".checkboxClass");
    let sidebar = document.querySelector(".sidebar");
    let changingContainer = document.getElementById("changingContainer");
    let productsList = document.querySelector(".sidebar ul");
    let quantitys = document.getElementsByClassName("quantity");
    let products = document.getElementsByClassName("nameProduct");
    let counter = 0;


    // Faire un compteur pour les éléments
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function() {
            if (this.checked) {
                counter++;
                if(counter == 1) {
                    sidebar.classList.add("visible");
                    changingContainer.classList.add("sidebar-active");
                }
                let productName = products[i].childNodes[3].innerText;
                let countQuantity = quantitys[i].parentNode.childNodes[3].innerText;
                let productNameContainer = '<p>' + productName + '</p>';
                let productQuantityContainer = "<span class=\" badge bg-danger\"> "+ countQuantity + "</span>";
                productsList.innerHTML += '<li class="productListElement d-flex ">' + productQuantityContainer + productNameContainer + '</li>';
            } else {
                counter--;
                if(counter == 0){
                    sidebar.classList.remove("visible");
                    changingContainer.classList.remove("sidebar-active");

                }
                let productName = products[i].childNodes[3].innerText;
                for(let n = 0; n < productsList.childNodes.length; n++){
                    if(productsList.childNodes[n].childNodes[1].innerText == productName){
                        productsList.childNodes[n].remove();
                    }
                }
            }
        });
    }

});

