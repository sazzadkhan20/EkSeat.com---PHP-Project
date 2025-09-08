function ValidateUserForm() {
  const name = document.getElementById("Name").value.trim();
  const phone = document.getElementById("Phone").value.trim();
  const nid = document.getElementById("NID").value.trim();
  const email = document.getElementById("Email").value.trim();
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmPassword").value;
  const errorEl = document.getElementById("errorMessage");

  // clear previous message
  errorEl.textContent = "";

  if (!name || !phone || !nid || !email || !password || !confirmPassword) {
    errorEl.textContent = "All fields are required.";
    return false;
  }

  if (password !== confirmPassword) {
    errorEl.textContent = "Passwords do not match.";
    return false;
  }

  if (password.length < 8) {
    errorEl.textContent = "Password must be at least 8 characters long.";
    return false;
  }

  // BD mobile: 11 digits starting with 01 and next digit 3–9
  if (!/^(01)[3-9]\d{8}$/.test(phone)) {
    errorEl.textContent = "Please provide a valid phone number (e.g., 01XXXXXXXXX).";
    return false;
  }

  // simple email check
  if (!/\w*[@][A-Za-z]*[\.][a-z]{3}$/.test(email)) {
    errorEl.textContent = "Please provide a valid email address.";
    return false;
  }
  // NID: 10 or 13 digits
  if (!/^\d{10}$|^\d{13}$/.test(nid)) {
    errorEl.textContent = "Please provide a valid NID (10 or 13 digits).";
    return false;
  }
  return true; 
}
