alert("Script is running");

function validateForm() {
    // Récupération des valeurs des champs
    var nom_user = document.getElementById('nom_user').value;
    var email = document.getElementById('email').value;
    var prixFinale = document.getElementById('prixFinale').value;
    var idPack = document.getElementById('idPack').value;

    // Vérification du champ nom_user
    if (nom_user.trim() === '') {
        alert('Please enter your name.');
        return false;
    }

    // Validation : Le nom doit contenir uniquement des caractères alphabétiques
    var namePattern = /^[a-zA-Z\s]+$/;
    if (!namePattern.test(nom_user)) {
        alert('The name should only contain letters and spaces.');
        return false;
    }

    // Vérification de l'email
    if (email.trim() === '') {
        alert('Please enter an email address.');
        return false;
    }

    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    // Vérification du prixFinale
    if (prixFinale.trim() === '') {
        alert('Please enter a price.');
        return false;
    }

    // Le prix doit être un nombre positif
    if (isNaN(prixFinale) || prixFinale <= 0) {
        alert('Please enter a valid price (greater than 0).');
        return false;
    }

    // Vérification du champ idPack
    if (idPack.trim() === '') {
        alert('Please select a pack.');
        return false;
    }

    // Si toutes les validations sont OK
    return true;
}


