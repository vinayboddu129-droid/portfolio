// ===============================
// DARK / LIGHT MODE
// ===============================

const themeButton = document.getElementById("theme-btn");

themeButton.addEventListener("click", function () {

    document.body.classList.toggle("dark-mode");

    if (document.body.classList.contains("dark-mode")) {
        themeButton.textContent = "☀️";
    } else {
        themeButton.textContent = "🌙";
    }

});


// ===============================
// CONTACT FORM VALIDATION
// ===============================

const contactForm = document.getElementById("contact-form");

contactForm.addEventListener("submit", function (event) {

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    // Check name
    if (name === "") {
        event.preventDefault();
        alert("Please enter your name.");
        return;
    }

    // Check email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        event.preventDefault();
        alert("Please enter a valid email address.");
        return;
    }

    // Check message
    if (message === "") {
        event.preventDefault();
        alert("Please enter your message.");
        return;
    }

    // If everything is valid,
    // allow the form to submit to contact.php.

});


// ===============================
// NAVIGATION CLICK EVENT
// ===============================

const navigationLinks = document.querySelectorAll(".nav-links a");

navigationLinks.forEach(function (link) {

    link.addEventListener("click", function () {

        console.log("Navigation clicked:", link.textContent);

    });

});


// ===============================
// KEYUP EVENT
// ===============================

const nameInput = document.getElementById("name");

nameInput.addEventListener("keyup", function () {

    console.log("User is typing:", nameInput.value);

});


// ===============================
// CHANGE EVENT
// ===============================

document.body.addEventListener("change", function () {

    console.log("A form value has changed.");

});


// ===============================
// DOM MANIPULATION
// ===============================

const heroTitle = document.querySelector(".hero h1");

console.log("Portfolio title:", heroTitle.textContent);


// ===============================
// SIMPLE FUNCTION
// ===============================

function showWelcomeMessage() {

    console.log("Welcome to Vinay's Portfolio!");

}

showWelcomeMessage();