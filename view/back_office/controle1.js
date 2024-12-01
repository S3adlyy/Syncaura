document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Récupère le formulaire

    form.addEventListener('submit', function (event) {
        let errorMessages = [];

        // Vérification du champ "contenu"
        const contenuField = document.getElementById('contenu');
        if (!contenuField.value.trim() || contenuField.value.length < 5) {
            errorMessages.push('The content of the response must contain at least 5 characters.');
        }

        // Vérification du champ "date_reponse"
        const dateField = document.getElementById('date_reponse');
        if (!dateField.value) {
            errorMessages.push('Please provide a valid response date.');
        }

        // Vérification du champ "id_question"
        const idQuestionField = document.getElementById('id_question');
        const idQuestionValue = parseInt(idQuestionField.value, 10);
        if (!idQuestionField.value || isNaN(idQuestionValue) || idQuestionValue <= 0) {
            errorMessages.push('The question ID must be a positive number.');
        }

        // Si des erreurs sont présentes, afficher une alerte et empêcher l'envoi
        if (errorMessages.length > 0) {
            event.preventDefault(); // Empêche l'envoi du formulaire
            alert('Form submission failed:\n' + errorMessages.join('\n'));
        }
    });
});
