const themeButton = document.getElementById("theme-btn");
const contactForm = document.getElementById("contact-form");
const navigationLinks = document.querySelectorAll(".nav-links a");

function showWelcomeMessage() {
    console.log("Welcome to my portfolio!");
}


function validateForm() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (name === "") {
        alert("Please enter your name.");
        return false;
    }

    if (email === "") {
        alert("Please enter your email.");
        return false;
    }

    if (message === "") {
        alert("Please enter your message.");
        return false;
    }

  
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}


if (themeButton) {
    themeButton.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            themeButton.textContent = "☀️ Light Mode";
        } else {
            themeButton.textContent = "🌙 Dark Mode";
        }
    });
}

if (contactForm) {
    contactForm.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
}


navigationLinks.forEach(function (link) {
    link.addEventListener("click", function () {
        console.log("Navigation link clicked:", link.textContent);
    });
});


const nameInput = document.getElementById("name");

if (nameInput) {
    nameInput.addEventListener("keyup", function () {
        console.log("Name entered:", nameInput.value);
    });
}

document.body.addEventListener("change", function () {
    console.log("A form value was changed.");
});


const heroTitle = document.querySelector(".hero h1");

if (heroTitle) {
    heroTitle.addEventListener("click", function () {
        heroTitle.textContent = "Welcome to My Portfolio!";
    });
}
showWelcomeMessage();