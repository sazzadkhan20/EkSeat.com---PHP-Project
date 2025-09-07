document.getElementById('register').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent form submission for validation

  let isValid = true; // Flag to check if the form is valid
  const name = document.querySelector('input[placeholder="Name"]');
  const phone = document.querySelector('input[placeholder="Phone"]');
  const email = document.querySelector('input[placeholder="email"]');
  const nid = document.querySelector('input[placeholder="NID"]');
  const password = document.querySelector('input[placeholder="Create a password"]');
  const confirmPassword = document.querySelector('input[placeholder="Confirm your password"]');
  
  // Validate Name
  if (name.value.trim() === "") {
    alert("Name is required!");
    isValid = false;
  }

  // Validate Phone (check if it's a valid number)
  const phonePattern = /^01[3-9][0-9]{8}$/; // Change regex to match your country's phone format
  if (!phonePattern.test(phone.value)) {
    alert("Please enter a valid 11-digit phone number!");
    isValid = false;
  }

  // Validate Email format
  const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  if (!emailPattern.test(email.value)) {
    alert("Please enter a valid email address!");
    isValid = false;
  }

  // Validate NID (example: numeric and a specific length, change as per your requirement)
  if (nid.value.trim() === "") {
    alert("NID is required!");
    isValid = false;
  }

  // Validate Password
  if (password.value.length < 6) {
    alert("Password must be at least 6 characters long!");
    isValid = false;
  }

  // Check if passwords match
  if (password.value !== confirmPassword.value) {
    alert("Passwords do not match!");
    isValid = false;
  }

  // If all validations pass, submit the form
  if (isValid) {
    alert("Form is valid! Proceeding with submission.");
    // Uncomment below line to actually submit the form
    // event.target.submit(); 
  }
});
