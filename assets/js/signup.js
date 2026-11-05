// assets/js/signup.js

function validateForm() {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const ageInput =
    document.getElementById("age") ||
    document.querySelector('input[name="age"]');
  const age = ageInput ? ageInput.value.trim() : "";
  const errorMessage = document.getElementById("errorMessage");

  const messages = [];

  // Clear previous error state
  if (errorMessage) {
    errorMessage.textContent = "";
    errorMessage.style.display = "none";
  }

  // 1. Email validation
  if (email === "") {
    messages.push("Email address is required.");
  } else {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      messages.push("Please enter a valid email address.");
    }
  }

  // 2. Password validation (min 8 chars, letter, number, special char)
  if (password === "") {
    messages.push("Password is required.");
  } else {
    const passwordPattern = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/;
    if (!passwordPattern.test(password)) {
      messages.push(
        "Password must be at least 8 characters long and include letters, numbers, and special characters.",
      );
    }
  }

  // 3. Age validation
  if (age === "") {
    messages.push("Age is required.");
  } else {
    const ageNumber = parseInt(age, 10);
    if (isNaN(ageNumber) || ageNumber < 10 || ageNumber > 120) {
      messages.push("Please enter a valid age between 10 and 120.");
    }
  }

  // Stop submission if validation errors exist
  if (messages.length > 0) {
    if (errorMessage) {
      errorMessage.textContent = messages[0];
      errorMessage.style.display = "block";
    } else {
      alert(messages.join("\n"));
    }
    return false;
  }

  return true;
}

// Password Visibility Toggle Logic
document.addEventListener("DOMContentLoaded", () => {
  const togglePassword = document.querySelector("#togglePassword");
  const passwordInput = document.querySelector("#password");

  if (togglePassword && passwordInput) {
    togglePassword.addEventListener("click", () => {
      const isPassword = passwordInput.getAttribute("type") === "password";
      passwordInput.setAttribute("type", isPassword ? "text" : "password");

      togglePassword.classList.toggle("fa-eye");
      togglePassword.classList.toggle("fa-eye-slash");
    });
  }
});
