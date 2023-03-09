"use strict";


//==================================================================

// This is for validation
const form = document.querySelector("form");
form.addEventListener("submit", function (event) {
    if (!validate(this)) {
        event.preventDefault(); // prevent form submission if validation fails
    }
});



function validate(form) {
    let fail = "";
    fail += validateUsername(form.name.value);
    fail += validateMessage(form.message.value);
    if (fail === "") {
        return true;
    } else {
        alert(fail);
        return false;
    }
}
function validateUsername(field) {
    if (field == "") return "No Username was entered.\n";
    else if (field.length < 3)
        return "Usernames must be at least 3 characters.\n";
    else if (/[^a-zA-Z0-9_-]/.test(field))
        return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n";
    return "";
}

// This is a regular expression (regex) pattern that is used to validate a string. In particular,
// this regex pattern is used to validate the input in the "message" field of a form.
function validateMessage(message) {
    const messageRegex = /^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/? ]{1,}$/;

    if (!messageRegex.test(message)) {
        return "Please enter a valid message.\n";
    } else {
        return "";
    }
}
