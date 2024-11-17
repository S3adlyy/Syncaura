<script>
function login(response) {
    console.log(response);
    // Handle the Google sign-in response here
    // e.g., send token to your server for verification
}

// Validation JavaScript
document.getElementById("registerForm").addEventListener("submit", function(event) {
    // Prevent form submission to validate first
    event.preventDefault();
    
    // Clear previous error messages
    document.getElementById("nameError").textContent = "";
    document.getElementById("emailError").textContent = "";
    document.getElementById("passwordError").textContent = "";

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    let isValid = true;

    // Validate Name
    if (name.length < 3) {
        document.getElementById("nameError").textContent = "Name must be at least 3 characters long.";
        isValid = false;
    }

    // Validate Email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("emailError").textContent = "Please enter a valid email address.";
        isValid = false;
    }

    // Validate Password
    if (password.length < 6) {
        document.getElementById("passwordError").textContent = "Password must be at least 6 characters long.";
        isValid = false;
    }

    // If all fields are valid, submit the form
    if (isValid) {
        this.submit();
    }
});
</script>