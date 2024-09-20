// Fonction pour l'aperçu de la création de produit
function previewImage(event) {
    const input = event.target;
    const imagePreview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';  // Afficher l'image
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Fonction pour l'aperçu des modifications
function previewModifiedImage(event, productId) {
    const input = event.target;
    const imagePreview = document.getElementById(`imagePreview-${productId}`);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';  // Afficher l'image
        };
        reader.readAsDataURL(input.files[0]);
    }
}
