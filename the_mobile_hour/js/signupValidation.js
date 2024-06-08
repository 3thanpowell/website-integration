
document.getElementById('phone').addEventListener('input', function () {
  const phoneField = document.getElementById('phone');
  const phone = phoneField.value;
  const isValid = /^(?:\+?61|0)[2-478](?:[ -]?[0-9]){8}$/.test(phone);

  if (!isValid) {
      phoneField.setCustomValidity('Please enter a valid Australian phone number.');
  } else {
      phoneField.setCustomValidity('');
  }
});

document.getElementById('password').addEventListener('input', function () {
  const passwordField = document.getElementById('password');
  const password = passwordField.value;
  const isValid = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/.test(password);

  if (!isValid) {
      passwordField.setCustomValidity('Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.');
  } else {
      passwordField.setCustomValidity('');
  }
});

