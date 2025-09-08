// Send OTP
function SentOTP() {
  const email = document.getElementById("email");
  if (!email || email.value.trim() === "") {
    alert("Please enter your email.");
    return;
  }

  // Generate a 6-digit OTP
  let otp_code = Math.floor(100000 + Math.random() * 900000);

  // Save OTP & email in browser storage
  localStorage.setItem("sentOTP", otp_code);
  localStorage.setItem("signupEmail", email.value);

  let emailbody = `<h1>Your OTP is: ${otp_code}</h1>`;

  Email.send({
    SecureToken: "eee7ecc3-f9ab-4b29-bc02-65e5a22a0e6e",
    To: "zohurulsazzad@gmail.com",
    From: "sazzad53913@gmail.com",
    Subject: "OTP Verification",
    Body: emailbody,
  }).then((message) => {
    if (message === "OK") {
      alert("OTP sent to your email: " + email.value);
      // Redirect to OTP page
      window.location.href = "verify_otp.html";
    } else {
      alert("Error sending email: " + message);
    }
  });
}

// Verify OTP
function verifyOTP() {
  const enteredOTP = document.getElementById("verify_OTP").value.trim();
  const savedOTP = localStorage.getItem("sentOTP");

  if (enteredOTP === "") {
    alert("Please enter the OTP.");
  } else if (enteredOTP === savedOTP) {
    alert("✅ OTP Verified Successfully!");
    window.location.href = "user_Register.html"; // next page
  } else {
    alert("❌ Invalid OTP. Please try again.");
  }
}

// Resend OTP
function resendOTP() {
  const email = localStorage.getItem("signupEmail");
  if (!email) {
    alert("No email found. Please sign up again.");
    return;
  }

  let newOTP = Math.floor(100000 + Math.random() * 900000);
  localStorage.setItem("sentOTP", newOTP);

  let emailbody = `<h1>Your new OTP is: ${newOTP}</h1>`;

  Email.send({
    SecureToken: "4282fe70-f927-4137-ae42-4b1bf31a496bc",
    To: email,
    From: "sazzad53913@gmail.com",
    Subject: "EkSeat.dom OTP Verification - Resent",
    Body: emailbody,
  }).then((message) => {
    if (message === "OK") {
      alert("A new OTP has been sent to " + email);
    } else {
      alert("Error: " + message);
    }
  });
}
