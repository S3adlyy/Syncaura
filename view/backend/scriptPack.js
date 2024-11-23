alert("Script is running!");

function validateForm2() {
    var nom = document.getElementById('nom').value;
    var description = document.getElementById('description').value;
    var prix = document.getElementById('prix').value;
    var image = document.getElementById('image').files.length;

    if (nom.trim() === '') {
        alert('Please enter the name of the pack.');
        return false;
    }

    if (description.trim() === '') {
        alert('Please enter a description for the pack.');
        return false;
    }

    if (prix.trim() === '') {
        alert('Please enter the price of the pack.');
        return false;
    } else if (isNaN(prix) || prix <= 0) {
        alert('Please enter a valid price.');
        return false;
    }

    if (image === 0) {
        alert('Please upload an image.');
        return false;
    }

    return true;
}
