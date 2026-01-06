/*CARD FORM VALIDATION*/

function validateCard() 
{
    var cardNumber = document.getElementById("card_number").value.trim();
    var cardName = document.getElementById("card_name").value.trim();
    var cardExpiry = document.getElementById("card_expiry").value;
    var cardCVV = document.getElementById("card_cvv").value.trim();


    if (cardNumber === "") {
        alert("Card number is required");
        return false;
    }
    for (var i = 0; i < cardNumber.length; i++) {
        if (cardNumber[i] < '0' || cardNumber[i] > '9') {
            alert("Card number must be digits only");
            return false;
        }
    }

    if (cardName === "") {
        alert("Name on card is required");
        return false;
    }
    for (var i = 0; i < cardName.length; i++) {
        var ch = cardName[i].toLowerCase();
        if (!((ch >= 'a' && ch <= 'z') || ch === ' ')) {
            alert("Name must contain letters only");
            return false;
        }
    }

    if (cardExpiry === "") {
        alert("Expiry date is required");
        return false;
    }

    if (cardCVV === "") {
        alert("CVV is required");
        return false;
    }
    for (var i = 0; i < cardCVV.length; i++) {
        if (cardCVV[i] < '0' || cardCVV[i] > '9') {
            alert("CVV must be digits only");
            return false;
        }
    }

    return true;
}

/*MOBILE FORM VALIDATION*/

function validateMobile() 
{
    var mobileNumber = document.getElementById("mobile_number").value.trim();
    var mobilePIN = document.getElementById("mobile_pin").value.trim();

    if (mobileNumber === "") {
        alert("Mobile number is required");
        return false;
    }
    for (var i = 0; i < mobileNumber.length; i++) {
        if (mobileNumber[i] < '0' || mobileNumber[i] > '9') {
            alert("Mobile number must be digits only");
            return false;
        }
    }

    if (mobilePIN === "") {
        alert("PIN is required");
        return false;
    }
    for (var i = 0; i < mobilePIN.length; i++) {
        if (mobilePIN[i] < '0' || mobilePIN[i] > '9') {
            alert("PIN must be digits only");
            return false;
        }
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function()
{
    var cardForm = document.getElementById("cardFormElement");
    var mobileForm = document.getElementById("mobileFormElement");

    if (cardForm) {
        cardForm.onsubmit = function(e) {
            if (!validateCard()) e.preventDefault();
        }
    }

    if (mobileForm) {
        mobileForm.onsubmit = function(e) {
            if (!validateMobile()) e.preventDefault();
        }
    }
}
);
