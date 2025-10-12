function ValidateUserProfile() {
  const phone = document.getElementById("Phone").value.trim();
  const nid = document.getElementById("NID").value.trim();
  const email = document.getElementById("Email").value.trim();
  const errorEl = document.getElementById("errorMessage");

  const pattern = /^[a-z0-9.]+@gmail\.com$/;

  if (!pattern.test(email)) {
    errorEl.textContent = "Please enter a valid email address!";
    return false; // Stop form submission
  }

  // clear previous message
  errorEl.textContent = "";

  // BD mobile: 11 digits starting with 01 and next digit 3–9
  if (!/^(01)[3-9]\d{8}$/.test(phone)) {
    errorEl.textContent =
      "Please provide a valid phone number (e.g., 01XXXXXXXXX).";
    return false;
  }

  // NID: 10 or 13 digits
  if (!/^\d{10}$|^\d{13}$/.test(nid)) {
    errorEl.textContent = "Please provide a valid NID (10 or 13 digits).";
    return false;
  }

  return true;
}
