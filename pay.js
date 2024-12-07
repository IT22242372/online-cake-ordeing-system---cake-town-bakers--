function validateForm() {
    var fullName = document.getElementById('fullName').value;
    var email = document.getElementById('email').value;
    var address = document.getElementById('address').value;
    var mobileNumber = document.getElementById('mobileNumber').value;
    var cardNumber = document.getElementById('cardNumber').value;
    var cvv = document.getElementById('cvv').value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var phoneRegex = /^\d{10}$/;
    var cardNumberRegex = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
    var cvvRegex = /^\d{3}$/;

    if (fullName.trim() === "") {
        alert("Please enter your full name.");
        return false;
    }

    if (!phoneRegex.test(mobileNumber)) {
        alert("Please enter a valid phone number.");
        return false;
    }

    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (address.trim() === "") {
        alert("🏠 We need your address for delivery. Please don't forget to fill it in!");
        return false;
    }

    if (!cardNumberRegex.test(cardNumber)) {
        alert("💳 The card number you entered isn't quite right. Please enter a valid 16-digit number (e.g., 1111-2222-3333-4444).");
        return false;
    }

    if (!cvvRegex.test(cvv)) {
        alert("🔐 The CVV should be a 3-digit number. Please check and enter again.");
        return false;
    }

    // If validation is successful, allow the form to submit
    return true; 
}

function showPopupMessage(fullName, email) {
    var popup = document.getElementById('popupMessage');
    var popupText = document.getElementById('popupText');
    
    // Set the message with the user's name and email
    popupText.textContent = "Thank you, " + fullName + "! Your payment is successfully completed. We’ll send the details to " + email + ".";
    
    popup.classList.remove('hidden');
    setTimeout(redirectToIndex, 5000);
}

function formatCardNumber(input) {
    // Remove any non-digit characters
    let value = input.value.replace(/\D/g, '');
    
    // Format the value with spaces after every 4 digits
    let formattedValue = '';
    for (let i = 0; i < value.length; i += 4) {
        formattedValue += value.substring(i, i + 4) + (i + 4 < value.length ? '-' : '');
    }

    // Set the formatted value back to the input
    input.value = formattedValue;
}

function formatExpiryDate(input) {
    // Remove non-digit characters
    let value = input.value.replace(/\D/g, '');
    
    // Ensure only the first two digits are for MM and the next two for YY
    if (value.length >= 3) {
        input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
    } else if (value.length >= 2) {
        input.value = value.substring(0, 2) + '/';
    } else {
        input.value = value;
    }

    // Validate month and year
    const [month, year] = input.value.split('/').map(num => num.trim());
    const currentYear = new Date().getFullYear() % 100; // Get last two digits of current year
    const maxYear = (currentYear + 24) % 100; // Current year + 24 (next 24 years)

    // Check for valid month (01-12)
    if (month && (parseInt(month) < 1 || parseInt(month) > 12)) {
        input.setCustomValidity('Please enter a valid month (01-12).');
    } else {
        input.setCustomValidity('');
    }

    // Check for valid year (current year to next 24 years)
    if (year && (parseInt(year) < currentYear || parseInt(year) > maxYear)) {
        input.setCustomValidity(`Please enter a valid year (${currentYear} - ${currentYear + 24}).`);
    } else {
        input.setCustomValidity('');
    }
}
