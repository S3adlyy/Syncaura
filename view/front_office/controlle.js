document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Récupère le formulaire
    const typeField = document.getElementById('type'); // Champ "type"
    const questionField = document.getElementById('questions'); // Champ "question"
    const dateField = document.getElementById('date_creation'); // Champ "date de création"
    const userIdField = document.getElementById('id'); // Champ "ID utilisateur"

    // Écoute l'événement de soumission du formulaire
    form.addEventListener('submit', function (event) {
        let isValid = true;
        let errorMessages = [];

        // Vérification du champ "type"
        if (!typeField.value) {
            showError(typeField, 'Please select a type for the question.');
            errorMessages.push('Please select a type for the question.');
            isValid = false;
        } else {
            clearError(typeField);
        }

        // Vérification du champ "question"
        if (!questionField.value.trim() || questionField.value.length < 10) {
            showError(questionField, 'The question must contain at least 10 characters.');
            errorMessages.push('The question must contain at least 10 characters.');
            isValid = false;
        } else {
            clearError(questionField);
        }

        // Vérification du champ "date de création"
        if (!dateField.value) {
            showError(dateField, 'Please provide a valid creation date.');
            errorMessages.push('Please provide a valid creation date.');
            isValid = false;
        } else {
            clearError(dateField);
        }

        // Vérification du champ "ID utilisateur"
        const userIdValue = parseInt(userIdField.value, 10);
        if (!userIdField.value || isNaN(userIdValue) || userIdValue <= 0) {
            showError(userIdField, 'User ID must be a positive number.');
            errorMessages.push('User ID must be a positive number.');
            isValid = false;
        } else {
            clearError(userIdField);
        }

        // Si le formulaire n'est pas valide
        if (!isValid) {
            event.preventDefault(); // Empêche l'envoi du formulaire
            event.stopPropagation();
            // Affiche une alerte avec tous les messages d'erreur
            alert('Form submission failed:\n' + errorMessages.join('\n'));
        }
    });

    // Fonction pour afficher un message d'erreur
    function showError(input, message) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
            errorDiv.textContent = message;
        }
        input.classList.add('is-invalid');
    }

    // Fonction pour effacer les erreurs
    function clearError(input) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
            errorDiv.textContent = '';
        }
        input.classList.remove('is-invalid');
    }
});
