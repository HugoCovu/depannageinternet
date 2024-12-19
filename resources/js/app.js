import * as bootstrap from 'bootstrap' ;
import '../sass/app.scss';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    const sidebar = document.querySelector(".sidebar");

    // Gérer l'événement lors du changement de l'état des checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            const card = this.closest(".card");  // Trouve la carte associée à la checkbox
            const productReference = card.querySelector(".card-header").textContent.trim();  // Référence du produit
            const productQuantity = card.querySelector(".badge-quantite").textContent.trim();  // Quantité du produit (en utilisant la classe correcte)
            const productName = card.querySelector(".cardModified").textContent.trim();

            if (this.checked) {
                // Créer un élément dans la sidebar pour afficher le produit sélectionné
                const listItem = document.createElement("li");
                listItem.textContent = `Référence: ${productReference} - Quantité: ${productQuantity} ${productName}`;
                sidebar.appendChild(listItem);

                // Rendre visible la sidebar si elle contient des éléments
                sidebar.classList.add("visible");
            } else {
                // Supprimer le produit de la sidebar
                const listItems = sidebar.querySelectorAll("li");
                listItems.forEach(item => {
                    if (item.textContent.includes(productReference)) {
                        sidebar.removeChild(item);
                    }
                });

                // Si aucune ligne n'est présente, masquer la sidebar
                if (sidebar.querySelectorAll("li").length === 0) {
                    sidebar.classList.remove("visible");
                }
            }
        });
    });
});





console.log("hello world");
