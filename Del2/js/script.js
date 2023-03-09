"use strict";

// ====================================================================//

// ====================================================================//
/**
 * start  a submit event listener to a form element that calls the validate function to validate the form data before submission.
 * If the validation fails, the function prevents the form from being submitted.
 * @param {HTMLFormElement} form - The form element to start  the event listener
 */
const form = document.querySelector("form");
form.addEventListener("submit", function (event) {
  // Call the validate function with the form as its argument
  if (!validate(this)) {
    // If the validation fails, prevent the default form submission behavior
    event.preventDefault();
  }
});

// ====================================================================//

// ====================================================================//

/**
 * Validates the input fields of a form to ensure needed meet requirements.
 * @param {HTMLFormElement} form - The HTML form element to validate.
 * @returns {boolean} True if all fields are valid, false otherwise.
 */
function validate(form) {
  // fail string to store  validation errors
  let fail = "";

  // Validate the username field using the validateUsername function and add   errors to the fail string
  fail += validateUsername(form.name.value);

  // Validate the message field using the validateMessage function and add  any errors to the fail string
  fail += validateMessage(form.message.value);

  // If the fail string is empty, all fields are valid, so return true
  if (fail === "") {
    return true;
  } else {
    // If the fail string is not empty, display an alert with the error message and return false
    alert(fail);
    return false;
  }
}

// ====================================================================//

// ====================================================================//
/**
 * Validates a username field to ensure it meets certain requirements.
 * @param {string} field - The username field to validate.
 * @returns {string} An error message if the field is invalid, or an empty string if it is valid.
 */

function validateUsername(field) {
  if (field == "") return "No Username was entered.\n";
  else if (field.length < 3)
    return "Usernames must be at least 3 characters.\n";
  else if (/[^a-zA-Z0-9_-]/.test(field))
    return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n";
  return "";
}

// ====================================================================//

// ====================================================================//

/**
 * Validates a message string to ensure it is not empty or whitespace only.
 * @param {string} message - The message string to validate.
 * @returns {string} An error message if the message is invalid, or an empty string if it is valid.
 */
function validateMessage(message) {
  // This is a  regular expression that matches empty or whitespace-only strings
  const messageRegex = /^\s*$/;

  //return an empty string to indicate the message is valid
  // else the message matches the empty or whitespace-only, return an error
  // message
  return messageRegex.test(message) ? "Please enter a valid message.\n" : "";
}
