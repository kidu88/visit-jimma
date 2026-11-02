function validateForm() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const age = document.querySelector('input[name="age"]').value;
  const errorMessage = document.getElementById("errorMessage");

  errorMessage.textContent = "";

  if (email === "") {
    alert("Email is required.");
  } else {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
    }
  }

  if (password === "") {
    alert("Password is required.");
  } else {
    const passwordPattern = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/;
    if (!passwordPattern.test(password)) {
      alert(
        "Password must be at least 8 characters long and include letters, numbers, and special characters."
      );
    }
  }

  if (age === "") {
    alert("Age is required.");
  } else {
    const ageNumber = parseInt(age, 10);
    if (isNaN(ageNumber) || ageNumber < 10) {
      alert("Please enter a valid age that is 10 or older.");
      return false;
    }
  }

  if (messages.length > 0) {
    errorMessage.textContent = messages.join(" ");
    errorMessage.style.display = "block";
    return false;
  }

  alert("Email, password, and age are valid!");
  return true;
}
