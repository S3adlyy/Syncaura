alert("Script is running!");

function validateForm() {
    var nom_user = document.getElementById('nom_user').value;
    var email = document.getElementById('email').value;
    var prixFinale = document.getElementById('prixFinale').value;
    var idPack = document.getElementById('idPack').value;

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
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email.trim() === '') {
        alert('Please enter an email address.');
        return false;
    } else if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (prixFinale.trim() === '') {
        alert('Please enter a price.');
        return false;
    } else if (isNaN(prixFinale) || prixFinale <= 0) {
        alert('Please enter a valid price.');
        return false;
    }

    if (idPack.trim() === '') {
        alert('Please select a pack.');
        return false;
    }

    return true;
}
