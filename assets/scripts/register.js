// Function to validate input fields
function validateInput(inputId, regex, errorMessage) {
    var input = document.getElementById(inputId);
    var inputValue = input.value.trim();
    var errorElement = document.getElementById(inputId + '-error');

    if (!regex.test(inputValue)) {
        input.classList.add('is-invalid');
        errorElement.textContent = errorMessage;
        return false;
    } else {
        input.classList.remove('is-invalid');
        errorElement.textContent = "";
        return true;
    }
}

// Function to validate form on submission
function validateForm() {
    var isValid = true;

    // Clear previous error messages
    var errorContainer = document.getElementById('error-messages');
    errorContainer.innerHTML = '';

    // Perform individual field validations
    isValid &= validateInput('username', /^[A-Za-z0-9_]+$/, "Username should contain only letters, numbers, and underscores");
    isValid &= validateInput('user_email', /^[A-Za-z0-9._%+-]+@ashesi\.edu\.gh$/, "Please enter a valid Ashesi email");
    isValid &= validateInput('user_phone', /^\+?\d{10,14}$/, "Please enter a valid phone number");
    isValid &= validateInput('user_image', /(.+)/, "Please upload a profile picture");
    isValid &= validateInput('user_address', /.+/, "Please enter your address");
    
    var passwordInput = document.getElementById('user_password');
    var passwordValue = passwordInput.value.trim();
    var passwordError = document.getElementById('user_password-error');

    if (passwordValue.length < 8 || !/[a-z]/.test(passwordValue) || !/[A-Z]/.test(passwordValue) || !/\d/.test(passwordValue)) {
        passwordInput.classList.add('is-invalid');
        passwordError.textContent = "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, and one number";
        isValid = false;
    } else {
        passwordInput.classList.remove('is-invalid');
        passwordError.textContent = "";
    }

    var retypePasswordInput = document.getElementById('retype_password');
    var retypePasswordValue = retypePasswordInput.value.trim();
    var retypePasswordError = document.getElementById('retype_password-error');

    if (passwordValue !== retypePasswordValue) {
        retypePasswordInput.classList.add('is-invalid');
        retypePasswordError.textContent = "Passwords entered do not match";
        isValid = false;
    } else {
        retypePasswordInput.classList.remove('is-invalid');
        retypePasswordError.textContent = "";
    }

    // Check if any field is empty
    var requiredFields = ['username', 'user_email', 'user_phone', 'user_image', 'user_address', 'user_password', 'retype_password'];
    requiredFields.forEach(function(fieldId) {
        var fieldInput = document.getElementById(fieldId);
        if (fieldInput.value.trim() === '') {
            appendErrorMessage("Please enter your " + fieldId.replace(/_/g, ' ') + ".");
            isValid = false;
        }
    });

    // Prevent form submission if any field is invalid
    if (!isValid) {
        return false;
    }

    return true;
}

// Function to append error message to the error container
function appendErrorMessage(message) {
    var errorContainer = document.getElementById('error-messages');
    var errorMessage = document.createElement('p');
    errorMessage.textContent = message;
    errorContainer.appendChild(errorMessage);
}

// Attach event listener to form for validation on submission
document.addEventListener("DOMContentLoaded", function() {
    var registrationForm = document.getElementById('registration-form');
    registrationForm.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
