setTimeout(function() {
    var alertDiv = document.querySelector('.alert');
    if (alertDiv) {
        alertDiv.style.display = 'none';
    }
}, 2000);

document.addEventListener("DOMContentLoaded", function() {
    var alertDiv = document.querySelector('.alert-2');
    var flickerDuration = 3000;
    var flickerCount = 3; 
    
    setTimeout(function() {
        alertDiv.style.display = "block"; 

        // Flicker effect
        var flickerInterval = setInterval(function() {
            flickerCount--;
            alertDiv.style.animation = "flicker 1s ease-in-out";
            setTimeout(function() {
                alertDiv.style.animation = ""; 
                if (flickerCount <= 0) {
                    clearInterval(flickerInterval); 
                    setTimeout(function() {
                        alertDiv.style.display = "none"; 
                    }, flickerDuration);
                }
            }, 1000);
        }, flickerDuration);
    }, 1000);
});

function showAlert(message) {
    // Create a div for the alert
    var alertDiv = document.createElement('div');
    alertDiv.classList.add('alert-popup');
    alertDiv.textContent = message;

    // Append the alert div to the body
    document.body.appendChild(alertDiv);

    // Center the alert div vertically and horizontally
    alertDiv.style.position = 'fixed';
    alertDiv.style.top = '50%';
    alertDiv.style.left = '50%';
    alertDiv.style.transform = 'translate(-50%, -50%)';

    // Set a timeout to remove the alert after 3 seconds
    setTimeout(function() {
        alertDiv.style.opacity = '0';
        setTimeout(function() {
            alertDiv.remove();
        }, 1000);
    }, 3000);
}