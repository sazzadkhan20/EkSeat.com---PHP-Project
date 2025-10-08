// Pricing configuration
const RIDE_RATES = {
  car: 70, // 15 taka per km
  bike: 35, // 8 taka per km
  cng: 45, // 12 taka per km
};

const RENTAL_RATES = {
  car: 2000, // Base price for car rental
  bike: 800, // Base price for bike rental
  cng: 1200, // Base price for CNG rental
};

const RENTAL_RATE_PER_KM = {
  car: 100, // Additional per km rate
  bike: 50, // Additional per km rate
  cng: 70, // Additional per km rate
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

// Selected service
let selectedRideType = null;
let selectedRentalType = null;
let currentDistance = 0;

// Initialize
document.addEventListener("DOMContentLoaded", function () {
  searchBtn.addEventListener("click", handleSearch);
  confirmBtn.addEventListener("click", handleConfirmation);

  [pickupInput, destinationInput].forEach((input) => {
    input.addEventListener("input", validateForm);
  });

  validateForm();
});

// Validate form
function validateForm() {
  const pickup = pickupInput.value.trim();
  const destination = destinationInput.value.trim();
  searchBtn.disabled = !(pickup && destination);
}

// Show tab content
function showTab(tabName) {
  // Update tab buttons
  document.querySelectorAll(".tab-btn").forEach((btn) => {
    btn.classList.remove("active");
  });
  event.target.classList.add("active");

  // Update tab content
  document.querySelectorAll(".tab-content").forEach((content) => {
    content.classList.remove("active");
  });
  document.getElementById(`${tabName}-tab`).classList.add("active");

  // Update confirm button based on selection
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
      //console.log(`Calculated distance: ${distance} km`);

      // Update distance info
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
                        <span class="ride-type"> Car Ride</span>
                        <span class="ride-price">${carPrice} ৳</span>
                    </div>
                    <div class="ride-details">
                        One-way trip with professional driver
                        <div class="price-breakdown">Distance: ${distanceKm} km × ${RIDE_RATES.car} ৳/km</div>
                    </div>
                </div>
                
                <div class="ride-option" onclick="selectRide('bike')">
                    <div class="ride-header">
                        <span class="ride-type">Bike Ride</span>
                        <span class="ride-price">${bikePrice} ৳</span>
                    </div>
                    <div class="ride-details">
                        Quick and economical bike ride
                        <div class="price-breakdown">Distance: ${distanceKm} km × ${RIDE_RATES.bike} ৳/km</div>
                    </div>
                </div>
                
                <div class="ride-option" onclick="selectRide('cng')">
                    <div class="ride-header">
                        <span class="ride-type"> CNG Ride</span>
                        <span class="ride-price">${cngPrice} ৳</span>
                    </div>
                    <div class="ride-details">
                        Eco-friendly and affordable CNG auto
                        <div class="price-breakdown">Distance: ${distanceKm} km × ${RIDE_RATES.cng} ৳/km</div>
                    </div>
                </div>
            `;
}

// Display rental options
function displayRentalOptions(distance) {
  const distanceKm = parseFloat(distance).toFixed(2);

  // Calculate rental prices
  const carRentalTotal = RENTAL_RATES.car + distance * RENTAL_RATE_PER_KM.car;
  const bikeRentalTotal =
    RENTAL_RATES.bike + distance * RENTAL_RATE_PER_KM.bike;
  const cngRentalTotal = RENTAL_RATES.cng + distance * RENTAL_RATE_PER_KM.cng;

  rentalOptions.innerHTML = `
                <div class="ride-option" onclick="selectRental('car')">
                    <div class="ride-header">
                        <span class="ride-type">🚗 Car Rental</span>
                        <span class="ride-price">${carRentalTotal.toFixed(
                          2
                        )} ৳</span>
                    </div>
                    <div class="ride-details">
                        <strong>Full Day Package (8 hours)</strong>
                        <div class="price-breakdown">
                            Base: ${
                              RENTAL_RATES.car
                            }৳ + Distance (${distanceKm}km × ${
    RENTAL_RATE_PER_KM.car
  }৳)
                        </div>
                        <ul class="rental-features">
                            <li>✓ Includes fuel and driver</li>
                            <li>✓ Up to 200 km included</li>
                            <li>✓ AC comfort</li>
                            <li>✓ Insurance covered</li>
                        </ul>
                    </div>
                </div>
                
                <div class="ride-option" onclick="selectRental('bike')">
                    <div class="ride-header">
                        <span class="ride-type">🏍️ Bike Rental</span>
                        <span class="ride-price">${bikeRentalTotal.toFixed(
                          2
                        )} ৳</span>
                    </div>
                    <div class="ride-details">
                        <strong>Full Day Package (8 hours)</strong>
                        <div class="price-breakdown">
                            Base: ${
                              RENTAL_RATES.bike
                            }৳ + Distance (${distanceKm}km × ${
    RENTAL_RATE_PER_KM.bike
  }৳)
                        </div>
                        <ul class="rental-features">
                            <li>✓ Fuel included</li>
                            <li>✓ Up to 150 km included</li>
                            <li>✓ Helmet provided</li>
                            <li>✓ Maintenance covered</li>
                        </ul>
                    </div>
                </div>
                
                <div class="ride-option" onclick="selectRental('cng')">
                    <div class="ride-header">
                        <span class="ride-type">🛵 CNG Rental</span>
                        <span class="ride-price">${cngRentalTotal.toFixed(
                          2
                        )} ৳</span>
                    </div>
                    <div class="ride-details">
                        <strong>Full Day Package (8 hours)</strong>
                        <div class="price-breakdown">
                            Base: ${
                              RENTAL_RATES.cng
                            }৳ + Distance (${distanceKm}km × ${
    RENTAL_RATE_PER_KM.cng
  }৳)
                        </div>
                        <ul class="rental-features">
                            <li>✓ Gas included</li>
                            <li>✓ Up to 100 km included</li>
                            <li>✓ Experienced driver</li>
                            <li>✓ Eco-friendly</li>
                        </ul>
                    </div>
                </div>
            `;
}

// Select ride type
function selectRide(rideType) {
  // Remove selected class from all ride options
  document.querySelectorAll("#ride-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });

  // Remove selected class from all rental options
  document.querySelectorAll("#rental-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });

  // Add selected class to clicked option
  const selectedOption = event.currentTarget;
  selectedOption.classList.add("selected");

  // Update selection
  selectedRideType = rideType;
  selectedRentalType = null;

  // Update and show confirm button
  updateConfirmButton();
  confirmBtnContainer.style.display = "block";
}

// Select rental type
function selectRental(rentalType) {
  // Remove selected class from all ride options
  document.querySelectorAll("#ride-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });

  // Remove selected class from all rental options
  document.querySelectorAll("#rental-tab .ride-option").forEach((option) => {
    option.classList.remove("selected");
  });

  // Add selected class to clicked option
  const selectedOption = event.currentTarget;
  selectedOption.classList.add("selected");

  // Update selection
  selectedRentalType = rentalType;
  selectedRideType = null;

  // Update and show confirm button
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

// Handle confirmation
function handleConfirmation() {
  if (!selectedRideType && !selectedRentalType) {
    alert("Please select a service first");
    return;
  }

  const pickup = pickupInput.value;
  const destination = destinationInput.value;
  const distance = currentDistance.toFixed(2);

  let serviceType, vehicleType, price, message;

  if (selectedRideType) {
    serviceType = "Ride";
    vehicleType = selectedRideType;
    price = (currentDistance * RIDE_RATES[selectedRideType]).toFixed(2);
    message = "One-way ride";
  } else {
    serviceType = "Rental";
    vehicleType = selectedRentalType;
    const basePrice = RENTAL_RATES[selectedRentalType];
    const distancePrice =
      currentDistance * RENTAL_RATE_PER_KM[selectedRentalType];
    price = (basePrice + distancePrice).toFixed(2);
    message = "Full day rental (8 hours)";
  }

  const confirmationMessage = `
                🎉 Booking Confirmed!
                
                📍 From: ${pickup}
                🎯 To: ${destination}
                📏 Distance: ${distance} km
                🚗 Service: ${getServiceDisplayName(vehicleType)} ${serviceType}
                💰 Total Price: ${price} ৳
                📝 ${message}
                
                Thank you for your booking!
            `;

  alert(confirmationMessage);
}

// Simulate distance calculation (replace with your actual implementation)
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

// // Function to load graph data from PHP
// function loadGraphData() {
//     console.log('Loading graph data from PHP...');

//     fetch('get-data.php')
//     .then(response => {
//         console.log('Raw response received');
//         return response.json();
//     })
//     .then(phpGraphData => {
//         console.log('PHP data converted to JavaScript:', phpGraphData);

//         // Convert PHP associative array to JavaScript Map
//         const graph = convertToAdjacencyList(phpGraphData);

//         console.log('Final JavaScript AdjacencyList:', graph);

//         const dis = dijkstraWithMap(graph, 'ECB Chattar', 'Jomuna Future Park');
//         if(dis)
//             console.log("Distance between Airport to Uttara - ",dis)
//         else
//             console.log("No Route");
//     })
//     .catch(error => {
//         console.error('Error loading graph data:', error);
//     });
// }

// // Convert PHP associative array to JavaScript Map<string, Array<[string, number]>>
// function convertToAdjacencyList(phpData) {
//     console.log('Converting PHP data to AdjacencyList...');

//     const graph = {};

//     // Loop through each main location in PHP data
//     for (const [mainLocation, connections] of Object.entries(phpData))
//     {
//         graph[mainLocation] = [];
//         connections.forEach(([neighbor, distance]) => {
//             graph[mainLocation].push({ node: neighbor, distance: distance });
//         });
//     }
//     return graph;
// }

// // Dijkstra's algorithm using Map<string, Array<[string, number]>>
// function dijkstraWithMap(graphMap, start, end) {
//     console.log(`Running Dijkstra from ${start} to ${end} using Map`);

//     const distances = {};     // distances from start to each node
//     const pq = new MinPriorityQueue();

//     // Initialize distances
//     for (const vertex of Object.keys(graphMap))
//         distances[vertex] = Infinity;

//     distances[start] = 0;

//     pq.enqueue(start, 0);

//     while (!pq.isEmpty())
//     {
//         const { element: node, priority: currentDistance } = pq.dequeue();
//         for(const neighborData of graphMap[node])
//         {
//             const neighbor = neighborData.node;
//             const pathCost = neighborData.distance;
//             const newDistance = currentDistance + pathCost;

//             if (newDistance < distances[neighbor])
//             {
//                 distances[neighbor] = newDistance;
//                 pq.enqueue(neighbor, newDistance);
//             }
//         }
//     }
//     if(distances[end] === Infinity)
//         return null;
//     else
//         return distances[end];
// }

// // MinPriorityQueue implementation for completeness
// class MinPriorityQueue {
//     constructor() {
//         this.heap = [];
//     }

//     enqueue(element, priority) {
//         this.heap.push({ element, priority });
//         this._bubbleUp();
//     }

//     dequeue() {
//         const min = this.heap[0];
//         const end = this.heap.pop();
//         if (this.heap.length > 0) {
//             this.heap[0] = end;
//             this._sinkDown();
//         }
//         return min;
//     }

//     isEmpty() {
//         return this.heap.length === 0;
//     }

//     _bubbleUp() {
//         let index = this.heap.length - 1;
//         const element = this.heap[index];
//         while (index > 0) {
//             const parentIndex = Math.floor((index - 1) / 2);
//             const parent = this.heap[parentIndex];
//             if (element.priority >= parent.priority) break;
//             this.heap[parentIndex] = element;
//             this.heap[index] = parent;
//             index = parentIndex;
//         }
//     }

//     _sinkDown() {
//         let index = 0;
//         const length = this.heap.length;
//         const element = this.heap[0];
//         while (true) {
//             let leftChildIndex = 2 * index + 1;
//             let rightChildIndex = 2 * index + 2;
//             let leftChild, rightChild;
//             let swap = null;

//             if (leftChildIndex < length) {
//                 leftChild = this.heap[leftChildIndex];
//                 if (leftChild.priority < element.priority) {
//                     swap = leftChildIndex;
//                 }
//             }

//             if (rightChildIndex < length) {
//                 rightChild = this.heap[rightChildIndex];
//                 if ((swap === null && rightChild.priority < element.priority) ||
//                     (swap !== null && rightChild.priority < leftChild.priority)) {
//                     swap = rightChildIndex;
//                 }
//             }

//             if (swap === null) break;
//             this.heap[index] = this.heap[swap];
//             this.heap[swap] = element;
//             index = swap;
//         }
//     }
// }

// // Load graph data when page loads
// // document.addEventListener('DOMContentLoaded', function() {
// //     loadGraphData();
// // });

// // // Function to load graph data from PHP
// // function loadGraphData() {
// //     console.log('Loading graph data from PHP...');

// //     fetch('get-data.php')
// //     .then(response => {
// //         console.log('Raw response received');
// //         return response.json();
// //     })
// //     .then(phpGraphData => {
// //         console.log('PHP data converted to JavaScript:', phpGraphData);

// //         // Convert PHP associative array to JavaScript Map
// //         const jsGraphMap = convertToMap(phpGraphData);

// //         console.log('Final JavaScript Map:', jsGraphMap);

// //         // Now you can use this Map for graph algorithms
// //         useGraphData(jsGraphMap);
// //     })
// //     .catch(error => {
// //         console.error('Error loading graph data:', error);
// //     });
// // }

// // // Convert PHP associative array to JavaScript Map<string, Array<[string, number]>>
// // function convertToMap(phpData) {
// //     console.log('Converting PHP data to Map...');

// //     const graphMap = new Map();

// //     // Loop through each main location in PHP data
// //     for (const [mainLocation, connections] of Object.entries(phpData)) {
// //         console.log(`Processing location: ${mainLocation}`);
// //         console.log(`Connections:`, connections);

// //         // Convert connections to Array<[string, number]>
// //         const connectionArray = connections.map(connection => {
// //             // connection is [connectedLocation, distance]
// //             return [connection[0], connection[1]];
// //         });

// //         // Add to Map: map<string, vector<pair<string,int>>>
// //         graphMap.set(mainLocation, connectionArray);

// //         console.log(`Added to Map: ${mainLocation} ->`, connectionArray);
// //     }

// //     return graphMap;
// // }

// // // Function to use the graph data
// // function useGraphData(graphMap) {
// //     console.log('Using graph data for algorithms...');

// //     // Now graphMap is a Map<string, Array<[string, number]>>
// //     // Example structure:
// //     // Map {
// //     //   "Airport" => [ ["Nikunjo - 2", 2.0], ["Uttara", 2.0] ],
// //     //   "Nikunjo - 2" => [ ["Airport", 2.0] ],
// //     //   "Uttara" => [ ["Airport", 2.0] ]
// //     // }

// //     // You can now use this for shortest path algorithms
// //     findShortestPath(graphMap, "Airport", "Uttara");
// // }

// // // Example shortest path function using your Map
// // function findShortestPath(graphMap, start, end) {
// //     console.log(`Finding shortest path from ${start} to ${end}`);

// //     // CORRECT WAY to access Map data:
// //     const airportData = graphMap.get("Airport");
// //     if (airportData) {
// //         console.log(`Airport has ${airportData.length} connections`); // Use .length NOT .length()
// //         console.log('Airport connections:', airportData);
// //     } else {
// //         console.log('Airport not found in graph');
// //     }

// //     // Convert Map to adjacency list for easier processing (if needed)
// //     const adjacencyList = {};

// //     // Convert Map to object format
// //     for (const [mainNode, connections] of graphMap) {
// //         adjacencyList[mainNode] = [];

// //         connections.forEach(([neighbor, distance]) => {
// //             adjacencyList[mainNode].push({ node: neighbor, distance: distance });
// //         });
// //     }

// //     console.log('Adjacency List for path finding:', adjacencyList['Airport'][0].node);

// //     // Now implement Dijkstra's algorithm using the Map directly
// //     dijkstraWithMap(graphMap, start, end);
// // }

// // // Dijkstra's algorithm using Map<string, Array<[string, number]>>
// // function dijkstraWithMap(graphMap, start, end) {
// //     console.log(`Running Dijkstra from ${start} to ${end} using Map`);

// //     const distances = new Map();      // Map<string, number>
// //     const previous = new Map();       // Map<string, string>
// //     const visited = new Set();        // Set<string>
// //     const pq = new MinPriorityQueue();

// //     // Initialize distances
// //     for (const [vertex] of graphMap) {
// //         distances.set(vertex, Infinity);
// //         previous.set(vertex, null);
// //     }
// //     distances.set(start, 0);

// //     pq.enqueue(start, 0);

// //     while (!pq.isEmpty()) {
// //         const { element: currentNode, priority: currentDistance } = pq.dequeue();

// //         console.log(`Processing: ${currentNode} (distance: ${currentDistance})`);

// //         if (visited.has(currentNode)) continue;
// //         if (currentNode === end) {
// //             console.log(`Reached destination: ${end}`);
// //             const path = reconstructPathFromMap(previous, end);
// //             const totalDistance = distances.get(end);
// //             console.log('Shortest path:', path);
// //             console.log('Total distance:', totalDistance);
// //             return { path, totalDistance };
// //         }

// //         visited.add(currentNode);

// //         // Get neighbors from Map: Array<[string, number]>
// //         const neighbors = graphMap.get(currentNode) || [];
// //         console.log(`Neighbors of ${currentNode}:`, neighbors);

// //         for (const [neighbor, edgeDistance] of neighbors) {
// //             if (visited.has(neighbor)) continue;

// //             const newDistance = currentDistance + edgeDistance;
// //             const currentNeighborDistance = distances.get(neighbor);

// //             console.log(`Checking ${neighbor}: new=${newDistance}, current=${currentNeighborDistance}`);

// //             if (newDistance < currentNeighborDistance) {
// //                 distances.set(neighbor, newDistance);
// //                 previous.set(neighbor, currentNode);
// //                 pq.enqueue(neighbor, newDistance);
// //                 console.log(`Updated ${neighbor}: distance=${newDistance}, previous=${currentNode}`);
// //             }
// //         }
// //     }

// //     console.log(`No path found from ${start} to ${end}`);
// //     return null;
// // }

// // // Reconstruct path from Map
// // function reconstructPathFromMap(previousMap, endNode) {
// //     const path = [];
// //     let currentNode = endNode;

// //     while (currentNode !== null && currentNode !== undefined) {
// //         path.unshift(currentNode);
// //         currentNode = previousMap.get(currentNode);
// //     }

// //     return path;
// // }

// // // MinPriorityQueue implementation for completeness
// // class MinPriorityQueue {
// //     constructor() {
// //         this.heap = [];
// //     }

// //     enqueue(element, priority) {
// //         this.heap.push({ element, priority });
// //         this._bubbleUp();
// //     }

// //     dequeue() {
// //         const min = this.heap[0];
// //         const end = this.heap.pop();
// //         if (this.heap.length > 0) {
// //             this.heap[0] = end;
// //             this._sinkDown();
// //         }
// //         return min;
// //     }

// //     isEmpty() {
// //         return this.heap.length === 0;
// //     }

// //     _bubbleUp() {
// //         let index = this.heap.length - 1;
// //         const element = this.heap[index];
// //         while (index > 0) {
// //             const parentIndex = Math.floor((index - 1) / 2);
// //             const parent = this.heap[parentIndex];
// //             if (element.priority >= parent.priority) break;
// //             this.heap[parentIndex] = element;
// //             this.heap[index] = parent;
// //             index = parentIndex;
// //         }
// //     }

// //     _sinkDown() {
// //         let index = 0;
// //         const length = this.heap.length;
// //         const element = this.heap[0];
// //         while (true) {
// //             let leftChildIndex = 2 * index + 1;
// //             let rightChildIndex = 2 * index + 2;
// //             let leftChild, rightChild;
// //             let swap = null;

// //             if (leftChildIndex < length) {
// //                 leftChild = this.heap[leftChildIndex];
// //                 if (leftChild.priority < element.priority) {
// //                     swap = leftChildIndex;
// //                 }
// //             }

// //             if (rightChildIndex < length) {
// //                 rightChild = this.heap[rightChildIndex];
// //                 if ((swap === null && rightChild.priority < element.priority) ||
// //                     (swap !== null && rightChild.priority < leftChild.priority)) {
// //                     swap = rightChildIndex;
// //                 }
// //             }

// //             if (swap === null) break;
// //             this.heap[index] = this.heap[swap];
// //             this.heap[swap] = element;
// //             index = swap;
// //         }
// //     }
// // }

// // // Load graph data when page loads
// // // document.addEventListener('DOMContentLoaded', function() {
// // //     loadGraphData();
// // // });
