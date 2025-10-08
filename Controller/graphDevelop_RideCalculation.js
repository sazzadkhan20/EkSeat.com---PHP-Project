// Pricing configuration
const RIDE_RATES = {
  car: 70,
  bike: 35,
  cng: 45,
};

const RENTAL_RATES = {
  car: 2000,
  bike: 800,
  cng: 1200,
};

const RENTAL_RATE_PER_KM = {
  car: 100,
  bike: 50,
  cng: 70,
};

// DOM Elements
const pickupInput = document.getElementById("pickup");
const destinationInput = document.getElementById("destination");
const searchBtn = document.getElementById("searchBtn");
const loading = document.getElementById("loading");
const resultsContainer = document.getElementById("resultsContainer");
const rideOptions = document.getElementById("rideOptions");
const rentalOptions = document.getElementById("rentalOptions");
const confirmBtnContainer = document.getElementById("confirmBtnContainer");
const confirmBtn = document.getElementById("confirmBtn");
const distanceInfo = document.getElementById("distanceInfo");
const distanceValue = document.getElementById("distanceValue");
const fromLocation = document.getElementById("fromLocation");
const toLocation = document.getElementById("toLocation");

// Form elements for submission
const bookingForm = document.getElementById("bookingForm");
const formPickup = document.getElementById("formPickup");
const formDestination = document.getElementById("formDestination");
const formDistance = document.getElementById("formDistance");
const formServiceType = document.getElementById("formServiceType");
const formVehicleType = document.getElementById("formVehicleType");
const formPrice = document.getElementById("formPrice");
const formBookingType = document.getElementById("formBookingType");

// Selected service
let selectedRideType = null;
let selectedRentalType = null;
let currentDistance = 0;

// Initialize
document.addEventListener("DOMContentLoaded", function () {
  confirmBtn.addEventListener("click", handleConfirmation);
});

// Show tab content
function showTab(tabName) {
  document.querySelectorAll(".tab-btn").forEach((btn) => {
    btn.classList.remove("active");
  });
  event.target.classList.add("active");

  document.querySelectorAll(".tab-content").forEach((content) => {
    content.classList.remove("active");
  });
  document.getElementById(`${tabName}-tab`).classList.add("active");

  updateConfirmButton();
}

// Handle search
function handleSearch() {
  const pickup = pickupInput.value.trim();
  const destination = destinationInput.value.trim();

  if (!pickup || !destination) {
    alert("Please enter both pickup and destination locations");
    return;
  }

  loading.classList.remove("hidden");
  resultsContainer.style.display = "none";
  confirmBtnContainer.style.display = "none";

  calculateDistance(pickup, destination)
    .then((distance) => {
      currentDistance = distance;

      distanceValue.textContent = distance.toFixed(2);
      fromLocation.textContent = pickup;
      toLocation.textContent = destination;
      distanceInfo.style.display = "block";

      displayRideOptions(distance);
      //displayRentalOptions(distance);
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Error calculating route. Please try again.");
    })
    .finally(() => {
      loading.classList.add("hidden");
      resultsContainer.style.display = "block";
    });
}

// Display ride options
function displayRideOptions(distance) {
  const distanceKm = parseFloat(distance).toFixed(2);

  const carPrice = (distance * RIDE_RATES.car).toFixed(2);
  const bikePrice = (distance * RIDE_RATES.bike).toFixed(2);
  const cngPrice = (distance * RIDE_RATES.cng).toFixed(2);

  rideOptions.innerHTML = `
    <div class="ride-option" onclick="selectRide('car')">
      <div class="ride-header">
        <span class="ride-type"> Car</span>
        <span class="ride-price">${carPrice} ৳</span>
      </div>
      <div class="ride-details">
        One-way trip with professional driver
        <div class="price-breakdown">Distance: ${distanceKm} km × ${RIDE_RATES.car} ৳/km</div>
      </div>
    </div>
    
    <div class="ride-option" onclick="selectRide('bike')">
      <div class="ride-header">
        <span class="ride-type">Bike</span>
        <span class="ride-price">${bikePrice} ৳</span>
      </div>
      <div class="ride-details">
        Quick and economical bike ride
        <div class="price-breakdown">Distance: ${distanceKm} km × ${RIDE_RATES.bike} ৳/km</div>
      </div>
    </div>
    
    <div class="ride-option" onclick="selectRide('cng')">
      <div class="ride-header">
        <span class="ride-type"> CNG</span>
        <span class="ride-price">${cngPrice} ৳</span>
      </div>
      <div class="ride-details">
        Eco-friendly and affordable CNG auto
        <div class="price-breakdown">Distance: ${distanceKm} km × ${RIDE_RATES.cng} ৳/km</div>
      </div>
    </div>
  `;
}

// Select ride type
function selectRide(rideType) {
  document.querySelectorAll("#ride-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });
  document.querySelectorAll("#rental-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });

  const selectedOption = event.currentTarget;
  selectedOption.classList.add("selected");

  selectedRideType = rideType;
  selectedRentalType = null;

  updateConfirmButton();
  confirmBtnContainer.style.display = "block";
}

// Select rental type
function selectRental(rentalType) {
  document.querySelectorAll("#ride-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });
  document.querySelectorAll("#rental-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });

  const selectedOption = event.currentTarget;
  selectedOption.classList.add("selected");

  selectedRentalType = rentalType;
  selectedRideType = null;

  updateConfirmButton();
  confirmBtnContainer.style.display = "block";
}

// Update confirm button text
function updateConfirmButton() {
  if (selectedRideType) {
    const price = (currentDistance * RIDE_RATES[selectedRideType]).toFixed(2);
    confirmBtn.textContent = `Request ${getServiceDisplayName(
      selectedRideType
    )} Ride - ${price} ৳`;
  } else if (selectedRentalType) {
    const basePrice = RENTAL_RATES[selectedRentalType];
    const distancePrice =
      currentDistance * RENTAL_RATE_PER_KM[selectedRentalType];
    const totalPrice = (basePrice + distancePrice).toFixed(2);
    confirmBtn.textContent = `Request ${getServiceDisplayName(
      selectedRentalType
    )} Rental - ${totalPrice} ৳`;
  }
}

// Get display name for service
function getServiceDisplayName(serviceType) {
  const names = {
    car: "Car",
    bike: "Bike",
    cng: "CNG",
  };
  return names[serviceType] || serviceType;
}

// Handle confirmation and form submission
function handleConfirmation() {
  if (!selectedRideType && !selectedRentalType) {
    alert("Please select a service first");
    return;
  }

  const pickup = pickupInput.value;
  const destination = destinationInput.value;
  const distance = currentDistance.toFixed(2);

  let serviceType, vehicleType, price, bookingType;

  if (selectedRideType) {
    serviceType = "Ride";
    vehicleType = selectedRideType;
    price = (currentDistance * RIDE_RATES[selectedRideType]).toFixed(2);
    bookingType = "one_way";
  } else {
    serviceType = "Rental";
    vehicleType = selectedRentalType;
    const basePrice = RENTAL_RATES[selectedRentalType];
    const distancePrice =
      currentDistance * RENTAL_RATE_PER_KM[selectedRentalType];
    price = (basePrice + distancePrice).toFixed(2);
    bookingType = "rental";
  }

  // Populate the hidden form
  formPickup.value = pickup;
  formDestination.value = destination;
  formDistance.value = distance;
  formServiceType.value = serviceType;
  formVehicleType.value = vehicleType;
  formPrice.value = price;
  formBookingType.value = bookingType;

  // Submit the form
  bookingForm.submit();
}

// Distance calculation functions (keep your existing implementation)
function calculateDistance(start, end) {
  let distance = 0;
  return new Promise((resolve, reject) => {
    fetch("../Model/graphRead.php")
      .then((response) => response.json())
      .then((phpGraphData) => {
        const graph = convertToAdjacencyList(phpGraphData);
        distance = dijkstraWithMap(graph, start, end);
      })
      .catch((error) => {
        console.error("Error loading graph data:", error);
      });
    setTimeout(() => {
      resolve(distance);
    }, 1500);
  });
}

function convertToAdjacencyList(phpData) {
  const graph = {};
  for (const [mainLocation, connections] of Object.entries(phpData)) {
    graph[mainLocation] = [];
    connections.forEach((connection) => {
      if (Array.isArray(connection)) {
        const [neighbor, distance] = connection;
        graph[mainLocation].push({
          node: neighbor,
          distance: Number(distance),
        });
      } else if (connection.node && connection.distance) {
        graph[mainLocation].push({
          node: connection.node,
          distance: Number(connection.distance),
        });
      }
    });
  }
  return graph;
}

function dijkstraWithMap(graph, start, end) {
  if (!graph[start] || !graph[end]) {
    console.error("Start or end node not found in graph");
    return null;
  }

  const distances = {};
  const visited = new Set();
  const pq = new MinPriorityQueue();

  for (const vertex of Object.keys(graph)) {
    distances[vertex] = Infinity;
  }
  distances[start] = 0;

  pq.enqueue(start, 0);

  while (!pq.isEmpty()) {
    const { element: currentNode, priority: currentDistance } = pq.dequeue();

    if (visited.has(currentNode)) continue;
    visited.add(currentNode);

    if (currentNode === end) {
      return currentDistance;
    }

    const neighbors = graph[currentNode] || [];
    for (const neighbor of neighbors) {
      const { node: neighborNode, distance: edgeWeight } = neighbor;

      if (!graph[neighborNode]) continue;

      const newDistance = currentDistance + edgeWeight;

      if (newDistance < distances[neighborNode]) {
        distances[neighborNode] = newDistance;
        pq.enqueue(neighborNode, newDistance);
      }
    }
  }

  return distances[end] === Infinity ? null : distances[end];
}

class MinPriorityQueue {
  constructor() {
    this.heap = [];
  }

  enqueue(element, priority) {
    this.heap.push({ element, priority });
    this._bubbleUp();
  }

  dequeue() {
    const min = this.heap[0];
    const end = this.heap.pop();
    if (this.heap.length > 0) {
      this.heap[0] = end;
      this._sinkDown(0);
    }
    return min;
  }

  isEmpty() {
    return this.heap.length === 0;
  }

  _bubbleUp() {
    let index = this.heap.length - 1;
    const element = this.heap[index];

    while (index > 0) {
      const parentIndex = Math.floor((index - 1) / 2);
      const parent = this.heap[parentIndex];

      if (element.priority >= parent.priority) break;

      this.heap[parentIndex] = element;
      this.heap[index] = parent;
      index = parentIndex;
    }
  }

  _sinkDown(index) {
    const length = this.heap.length;
    const element = this.heap[index];

    while (true) {
      let leftChildIndex = 2 * index + 1;
      let rightChildIndex = 2 * index + 2;
      let leftChild, rightChild;
      let swap = null;

      if (leftChildIndex < length) {
        leftChild = this.heap[leftChildIndex];
        if (leftChild.priority < element.priority) {
          swap = leftChildIndex;
        }
      }

      if (rightChildIndex < length) {
        rightChild = this.heap[rightChildIndex];
        if (
          (swap === null && rightChild.priority < element.priority) ||
          (swap !== null && rightChild.priority < leftChild.priority)
        ) {
          swap = rightChildIndex;
        }
      }

      if (swap === null) break;

      this.heap[index] = this.heap[swap];
      this.heap[swap] = element;
      index = swap;
    }
  }
}

// Add CSS for loading spinner
const style = document.createElement("style");
style.textContent = `
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
`;
document.head.appendChild(style);
