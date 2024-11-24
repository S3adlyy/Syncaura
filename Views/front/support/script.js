// Get the form and modal elements
const form = document.getElementById("contact-form");
const successModal = document.getElementById("success-modal");
const closeModalBtn = document.querySelector(".close");

// Handle form submission
form.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Simulate a successful form submission with a small delay
    setTimeout(() => {
        // Show the success modal
        successModal.style.display = "block";
    }, 500); // Simulate server response delay

    // Optionally reset the form here
    // form.reset();
});

// Close the modal when the user clicks the close button (×)
closeModalBtn.addEventListener("click", function () {
    successModal.style.display = "none";
});

// Close the modal if the user clicks outside of it
window.addEventListener("click", function (event) {
    if (event.target === successModal) {
        successModal.style.display = "none";
    }
});
