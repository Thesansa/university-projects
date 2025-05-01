document.addEventListener("DOMContentLoaded", function() {
    const passwordField = document.getElementById("pword");
    const confirmPasswordField = document.getElementById("re-pword");
    const correctMessage = document.getElementById("correctp");
    const wrongMessage = document.getElementById("wrongp");
    const registerButton = document.getElementById("registerbtn"); 

    // Initially, the register button is disabled
    registerButton.disabled = true;

    // Event listener to check password confirmation on input change
    confirmPasswordField.addEventListener("input", function() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        if (password === confirmPassword && password !== "") {
            correctMessage.style.display = "block";
            wrongMessage.style.display = "none";
            correctMessage.style.opacity = "1"; 
            setTimeout(() => {
                correctMessage.style.opacity = "0"; 
                setTimeout(() => {
                    correctMessage.style.display = "none"; 
                }, 1000); 
            }, 3000); 

            // Enable the register button if passwords match
            registerButton.disabled = false; // Allow registration

        } else {
            wrongMessage.style.display = "block";
            correctMessage.style.display = "none";
            wrongMessage.style.opacity = "1"; 
            setTimeout(() => {
                wrongMessage.style.opacity = "0"; 
                setTimeout(() => {
                    wrongMessage.style.display = "none"; 
                }, 1000); 
            }, 3000); 

            // Disable the register button if passwords don't match
            registerButton.disabled = true;
        }
    });
});
