document.getElementById("phone").addEventListener("input", function () {
  const phoneField = document.getElementById("phone");
  const phone = phoneField.value;
  const isValid = /^(?:\+?61|0)[2-478](?:[ -]?[0-9]){8}$/.test(phone);

  if (!isValid) {
    phoneField.setCustomValidity(
      "Please enter a valid Australian phone number."
    );
  } else {
    phoneField.setCustomValidity("");
  }
});

// pword validation
document.getElementById("password").addEventListener("input", function () {
  const passwordField = document.getElementById("password");
  const password = passwordField.value;
  const isValid = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/.test(password);

  if (!isValid) {
    passwordField.setCustomValidity(
      "Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji."
    );
  } else {
    passwordField.setCustomValidity("");
  }
});

// pword visibility toggle
document
  .getElementById("togglePassword")
  .addEventListener("click", function (e) {
    const passwordField = document.getElementById("password");
    const type =
      passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
  });

document
  .getElementById("toggleConfirmPassword")
  .addEventListener("click", function (e) {
    const confirmPasswordField = document.getElementById("confirmPassword");
    const type =
      confirmPasswordField.getAttribute("type") === "password"
        ? "text"
        : "password";
    confirmPasswordField.setAttribute("type", type);
  });
