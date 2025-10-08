// Transition script for ride booking page
document.addEventListener("DOMContentLoaded", function () {
  // Get elements
  const initialSearchContainer = document.getElementById(
    "initialSearchContainer"
  );
  const mainContent = document.getElementById("mainContent");
  const initialSearchBtn = document.getElementById("initialSearchBtn");
  const initialPickupInput = document.getElementById("initial-pickup");
  const initialDestinationInput = document.getElementById(
    "initial-destination"
  );
  const pickupInput = document.getElementById("pickup");
  const destinationInput = document.getElementById("destination");
  const searchBtn = document.getElementById("searchBtn");

  // Validate initial search form
  function validateInitialForm() {
    const pickup = initialPickupInput.value.trim();
    const destination = initialDestinationInput.value.trim();
    initialSearchBtn.disabled = !(pickup && destination);
  }

  // Add event listeners for initial form validation
  [initialPickupInput, initialDestinationInput].forEach((input) => {
    input.addEventListener("input", validateInitialForm);
  });

  // Handle initial search button click
  initialSearchBtn.addEventListener("click", function () {
    const pickup = initialPickupInput.value.trim();
    const destination = initialDestinationInput.value.trim();

    if (!pickup || !destination) {
      alert("Please enter both pickup and destination locations");
      return;
    }

    // Transfer values to the main search form
    pickupInput.value = pickup;
    destinationInput.value = destination;

    // Hide initial search and show main layout
    initialSearchContainer.style.display = "none";
    mainContent.style.display = "flex";

    // Trigger search in the main layout
    if (typeof handleSearch === "function") {
      handleSearch();
    }
  });

  // Add event listeners for main form validation
  [pickupInput, destinationInput].forEach((input) => {
    input.addEventListener("input", function () {
      const pickup = pickupInput.value.trim();
      const destination = destinationInput.value.trim();
      searchBtn.disabled = !(pickup && destination);
    });
  });

  // Handle main search button click
  searchBtn.addEventListener("click", function () {
    if (typeof handleSearch === "function") {
      handleSearch();
    }
  });
});
