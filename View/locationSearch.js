// locationSearch.js
// Autocomplete functionality for location search fields with PHP data integration

// Global variable to store location data
let locationData = [];

// Track selected locations for validation
const selectedLocations = {
  "initial-pickup": null,
  "initial-destination": null,
  pickup: null,
  destination: null,
};

// Initialize autocomplete functionality
document.addEventListener("DOMContentLoaded", function () {
  loadLocationData()
    .then(() => {
      initializeLocationSearch();
    })
    .catch((error) => {
      console.error("Failed to load location data:", error);
      // Fallback to empty array if data loading fails
      locationData = [];
      initializeLocationSearch();
    });
});

// Load location data from PHP backend
async function loadLocationData() {
  try {
    const response = await fetch("../Model/allLocation.php");

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();

    if (Array.isArray(data)) {
      locationData = data;
      console.log(
        "Location data loaded successfully:",
        locationData.length,
        "locations"
      );
    } else {
      throw new Error("Invalid data format received from server");
    }
  } catch (error) {
    console.error("Error loading location data:", error);
    throw error;
  }
}

function initializeLocationSearch() {
  // Initialize autocomplete for all location inputs
  const locationInputs = [
    {
      input: document.getElementById("initial-pickup"),
      dropdown: document.getElementById("initial-pickup-dropdown"),
      key: "initial-pickup",
    },
    {
      input: document.getElementById("initial-destination"),
      dropdown: document.getElementById("initial-destination-dropdown"),
      key: "initial-destination",
    },
    {
      input: document.getElementById("pickup"),
      dropdown: document.getElementById("pickup-dropdown"),
      key: "pickup",
    },
    {
      input: document.getElementById("destination"),
      dropdown: document.getElementById("destination-dropdown"),
      key: "destination",
    },
  ];

  locationInputs.forEach((item) => {
    if (item.input && item.dropdown) {
      initAutocomplete(item.input, item.dropdown, item.key);

      // Add input event listener to clear selection when user types
      item.input.addEventListener("input", function () {
        // If the current value doesn't match the selected location, clear the selection
        if (selectedLocations[item.key] !== this.value) {
          selectedLocations[item.key] = null;
          updateSearchButtonState();
        }
      });
    }
  });

  // Add event listeners for search buttons
  const initialSearchBtn = document.getElementById("initialSearchBtn");
  const searchBtn = document.getElementById("searchBtn");

  if (initialSearchBtn) {
    initialSearchBtn.addEventListener("click", function () {
      const pickup = document.getElementById("initial-pickup").value;
      const destination = document.getElementById("initial-destination").value;

      if (
        isLocationSelected("initial-pickup") &&
        isLocationSelected("initial-destination")
      ) {
        // Transition to main content
        document.getElementById("initialSearchContainer").style.display =
          "none";
        document.getElementById("mainContent").style.display = "flex";

        // Set values in the main form
        document.getElementById("pickup").value = pickup;
        document.getElementById("destination").value = destination;

        // Update selections in main form
        selectedLocations["pickup"] = pickup;
        selectedLocations["destination"] = destination;

        // Trigger search in main form
        if (searchBtn) {
          searchBtn.click();
        }
      }
    });
  }

  if (searchBtn) {
    searchBtn.addEventListener("click", function () {
      if (isLocationSelected("pickup") && isLocationSelected("destination")) {
        // Show loading
        const loadingElement = document.getElementById("loading");
        if (loadingElement) {
          loadingElement.classList.remove("hidden");
        }

        // Simulate API call delay
        setTimeout(function () {
          // Hide loading
          if (loadingElement) {
            loadingElement.classList.add("hidden");
          }

          // Show results
          const resultsContainer = document.getElementById("resultsContainer");
          const distanceInfo = document.getElementById("distanceInfo");

          if (resultsContainer) {
            resultsContainer.style.display = "block";
          }
          if (distanceInfo) {
            distanceInfo.style.display = "block";
          }

          // Set distance info
          const distanceValue = document.getElementById("distanceValue");
          const fromLocation = document.getElementById("fromLocation");
          const toLocation = document.getElementById("toLocation");

          if (distanceValue) distanceValue.textContent = "15.2";
          if (fromLocation)
            fromLocation.textContent = selectedLocations["pickup"];
          if (toLocation)
            toLocation.textContent = selectedLocations["destination"];

          // Populate ride options
          if (typeof populateRideOptions === "function") {
            populateRideOptions();
          }
        }, 1500);
      }
    });
  }

  // Initial button state update
  updateSearchButtonState();
}

// Initialize autocomplete for a specific input
function initAutocomplete(input, dropdown, key) {
  input.addEventListener("input", function () {
    const value = input.value.toLowerCase();
    dropdown.innerHTML = "";

    if (value.length > 0 && locationData.length > 0) {
      const filteredLocations = locationData.filter((location) =>
        location.toLowerCase().includes(value)
      );

      if (filteredLocations.length > 0) {
        filteredLocations.forEach((location) => {
          const item = document.createElement("div");
          item.className = "autocomplete-item";
          item.textContent = location;
          item.addEventListener("click", function () {
            input.value = location;
            selectedLocations[key] = location; // Mark as selected
            dropdown.style.display = "none";
            updateSearchButtonState();

            // Add visual indicator for selected location
            input.style.borderColor = "#2c394b";
            //input.style.boxShadow = "0 0 0 3px rgba(39, 174, 96, 0.2)";
          });
          dropdown.appendChild(item);
        });
        dropdown.style.display = "block";
      } else {
        dropdown.style.display = "none";
      }
    } else {
      dropdown.style.display = "none";
      selectedLocations[key] = null; // Clear selection when input is empty
      resetInputStyle(input);
      updateSearchButtonState();
    }
  });

  // Hide dropdown when clicking outside
  document.addEventListener("click", function (e) {
    if (!input.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = "none";

      // If input has value but wasn't selected from dropdown, clear it
      if (input.value && !selectedLocations[key]) {
        input.value = "";
        resetInputStyle(input);
        updateSearchButtonState();
      }
    }
  });

  // Handle keyboard navigation
  input.addEventListener("keydown", function (e) {
    const items = dropdown.querySelectorAll(".autocomplete-item");
    let activeItem = dropdown.querySelector(".autocomplete-item.active");

    if (e.key === "ArrowDown") {
      e.preventDefault();
      if (!activeItem && items.length > 0) {
        items[0].classList.add("active");
      } else if (activeItem) {
        activeItem.classList.remove("active");
        const nextItem = activeItem.nextElementSibling;
        if (nextItem) {
          nextItem.classList.add("active");
        } else {
          items[0].classList.add("active");
        }
      }
    } else if (e.key === "ArrowUp") {
      e.preventDefault();
      if (!activeItem && items.length > 0) {
        items[items.length - 1].classList.add("active");
      } else if (activeItem) {
        activeItem.classList.remove("active");
        const prevItem = activeItem.previousElementSibling;
        if (prevItem) {
          prevItem.classList.add("active");
        } else {
          items[items.length - 1].classList.add("active");
        }
      }
    } else if (e.key === "Enter") {
      e.preventDefault();
      if (activeItem) {
        input.value = activeItem.textContent;
        selectedLocations[key] = activeItem.textContent; // Mark as selected
        dropdown.style.display = "none";

        // Add visual indicator for selected location
        input.style.borderColor = "#2c394b";
        //input.style.boxShadow = "0 0 0 3px rgba(39, 174, 96, 0.2)";

        updateSearchButtonState();
      } else if (input.value && !selectedLocations[key]) {
        // If user presses enter without selecting, clear the input
        input.value = "";
        resetInputStyle(input);
        updateSearchButtonState();
      }
    } else if (e.key === "Escape") {
      dropdown.style.display = "none";
      if (input.value && !selectedLocations[key]) {
        input.value = "";
        resetInputStyle(input);
        updateSearchButtonState();
      }
    }
  });

  // Clear active item when dropdown is hidden
  input.addEventListener("blur", function () {
    setTimeout(() => {
      const activeItem = dropdown.querySelector(".autocomplete-item.active");
      if (activeItem) {
        activeItem.classList.remove("active");
      }
    }, 200);
  });

  // Reset input style when user starts typing again
  input.addEventListener("focus", function () {
    if (!selectedLocations[key]) {
      resetInputStyle(input);
    }
  });
}

// Reset input styling to default
function resetInputStyle(input) {
  input.style.borderColor = "#e0e0e0";
  input.style.boxShadow = "none";
}

// Check if a location is selected (from dropdown)
function isLocationSelected(key) {
  return selectedLocations[key] !== null && selectedLocations[key] !== "";
}

// Check if a location is valid (exists in locationData)
function isLocationValid(location) {
  return locationData.includes(location);
}

// Update search button state based on input validity
function updateSearchButtonState() {
  const initialSearchBtn = document.getElementById("initialSearchBtn");
  const searchBtn = document.getElementById("searchBtn");

  // Check if both locations are selected for initial form
  const initialPickupSelected = isLocationSelected("initial-pickup");
  const initialDestinationSelected = isLocationSelected("initial-destination");

  // Check if both locations are selected for main form
  const pickupSelected = isLocationSelected("pickup");
  const destinationSelected = isLocationSelected("destination");

  if (initialSearchBtn) {
    initialSearchBtn.disabled = !(
      initialPickupSelected && initialDestinationSelected
    );
  }

  if (searchBtn) {
    searchBtn.disabled = !(pickupSelected && destinationSelected);
  }
}

// Function to manually set a location selection (for external use)
function setLocationSelection(inputId, location) {
  const input = document.getElementById(inputId);
  if (input && locationData.includes(location)) {
    input.value = location;
    selectedLocations[inputId] = location;

    // Add visual indicator
    input.style.borderColor = "#2c394b";
    //input.style.boxShadow = "0 0 0 3px rgba(39, 174, 96, 0.2)";

    updateSearchButtonState();
    return true;
  }
  return false;
}

// Function to reload location data (useful if data changes)
async function reloadLocationData() {
  await loadLocationData();
  // Re-initialize autocomplete with new data
  initializeLocationSearch();
}

// Export functions for use in other modules (if using ES6 modules)
if (typeof module !== "undefined" && module.exports) {
  module.exports = {
    initializeLocationSearch,
    initAutocomplete,
    isLocationSelected,
    isLocationValid,
    updateSearchButtonState,
    reloadLocationData,
    setLocationSelection,
    getLocationData: () => [...locationData],
  };
}
