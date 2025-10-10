// authPopup.js - Simple authentication popup handler
document.addEventListener("DOMContentLoaded", function () {
  // Get elements
  const modal = document.getElementById("loginModal");
  const continueBtn = document.getElementById("continueBtn");
  const initialSearchBtn = document.getElementById("initialSearchBtn");
  const searchBtn = document.getElementById("searchBtn");

  // Function to show modal
  function showModal() {
    modal.style.display = "block";

    // Add blur to all main content
    const initialContainer = document.getElementById("initialSearchContainer");
    const mainContent = document.getElementById("mainContent");

    if (initialContainer) initialContainer.classList.add("blur-background");
    if (mainContent) mainContent.classList.add("blur-background");
  }

  // Function to redirect to login page
  function redirectToLogin() {
    window.location.href = "signIn.php";
  }

  // Check if user is not logged in and bind events
  if (!isLoggedIn) {
    // Bind continue button
    if (continueBtn) {
      continueBtn.addEventListener("click", redirectToLogin);
    }

    // Override initial search button
    if (initialSearchBtn) {
      const originalInitialClick = initialSearchBtn.onclick;
      initialSearchBtn.onclick = function (e) {
        e.preventDefault();
        e.stopPropagation();
        showModal();
        return false;
      };
    }

    // Override main search button
    if (searchBtn) {
      const originalSearchClick = searchBtn.onclick;
      searchBtn.onclick = function (e) {
        e.preventDefault();
        e.stopPropagation();
        showModal();
        return false;
      };
    }

    // Prevent form submissions
    const forms = document.querySelectorAll("form");
    forms.forEach((form) => {
      form.addEventListener("submit", function (e) {
        if (!isLoggedIn) {
          e.preventDefault();
          e.stopPropagation();
          showModal();
          return false;
        }
      });
    });
  }
});
