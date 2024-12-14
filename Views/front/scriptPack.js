alert("Script is running!");

function validateFormP() {
    var nom = document.getElementById('nom').value;
    var description = document.getElementById('description').value;
    var prix = document.getElementById('prix').value;
    var image = document.getElementById('image').files.length;

    // Vérification que le nom n'est pas vide
    if (nom.trim() === '') {
        alert('Please enter the name of the pack.');
        return false;
    }

    // Validation : Le nom doit contenir uniquement des lettres et des espaces
    var namePattern = /^[a-zA-Z\s]+$/;
    if (!namePattern.test(nom)) {
        alert('The name should only contain letters.');
        return false;
    }

    // Vérification que la description n'est pas vide
    if (description.trim() === '') {
        alert('Please enter a description for the pack.');
        return false;
    }

    // Vérification que le prix n'est pas vide et est valide
    if (prix.trim() === '') {
        alert('Please enter the price of the pack.');
        return false;
    } else if (isNaN(prix) || prix <= 0) {
        alert('Please enter a valid price.');
        return false;
    }

    // Vérification qu'une image a été sélectionnée
    if (image === 0) {
        alert('Please upload an image.');
        return false;
    }

    return true;
}
