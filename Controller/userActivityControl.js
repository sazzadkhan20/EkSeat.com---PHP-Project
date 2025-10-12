// Ride history data from PHP
        const rideHistory = <?php echo $has_rides ? json_encode($ride_history) : '[]'; ?>;
        const hasRides = <?php echo $has_rides ? 'true' : 'false'; ?>;
        
        // Get current and previous month names
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const currentDate = new Date();
        const currentMonth = months[currentDate.getMonth()];
        const previousMonth = months[(currentDate.getMonth() - 1 + 12) % 12];
        
        // Update the select option with the previous month name
        document.addEventListener('DOMContentLoaded', function() {
            if (hasRides) {
                const timeFilter = document.getElementById('timeFilter');
                timeFilter.innerHTML = `
                    <option value="all">All Time</option>
                    <option value="30days">Last 30 Days</option>
                    <option value="lastMonth">${previousMonth}</option>
                    <option value="3months">Last 3 Months</option>
                `;
                
                // Initialize the page with all rides
                renderRideHistory('all', 'all');
                
                // Initialize stats animation
                updateStats();
            }
        });

        // Function to filter rides based on selected time period
        function filterRidesByTime(timePeriod) {
            const now = Math.floor(Date.now() / 1000); // Current timestamp in seconds
            let filteredRides = [];
            
            switch (timePeriod) {
                case 'all':
                    filteredRides = rideHistory;
                    break;
                case '30days':
                    const thirtyDaysAgo = now - (30 * 24 * 60 * 60);
                    filteredRides = rideHistory.filter(ride => {
                        // Convert ride date to timestamp
                        const rideDate = new Date(ride.rideDate).getTime() / 1000;
                        return rideDate >= thirtyDaysAgo;
                    });
                    break;
                case 'lastMonth':
                    const firstDayOfCurrentMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getTime() / 1000;
                    const firstDayOfLastMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1).getTime() / 1000;
                    filteredRides = rideHistory.filter(ride => {
                        const rideDate = new Date(ride.rideDate).getTime() / 1000;
                        return rideDate >= firstDayOfLastMonth && rideDate < firstDayOfCurrentMonth;
                    });
                    break;
                case '3months':
                    const threeMonthsAgo = now - (90 * 24 * 60 * 60);
                    filteredRides = rideHistory.filter(ride => {
                        const rideDate = new Date(ride.rideDate).getTime() / 1000;
                        return rideDate >= threeMonthsAgo;
                    });
                    break;
                default:
                    filteredRides = rideHistory;
            }
            
            return filteredRides;
        }
        
        // Function to filter rides by trip type
        function filterRidesByType(rides, tripType) {
            if (tripType === 'all') {
                return rides;
            }
            return rides.filter(ride => {
                // For demo purposes, let's assume trips with higher prices are business
                // In real application, you would have a tripType field in your database
                return tripType === 'business' ? ride.rent > 20 : ride.rent <= 20;
            });
        }
        
        // Function to render ride history
        function renderRideHistory(tripType = 'all', timePeriod = 'all') {
            const historyList = document.getElementById('historyList');
            let filteredRides = filterRidesByTime(timePeriod);
            filteredRides = filterRidesByType(filteredRides, tripType);
            
            if (filteredRides.length === 0) {
                let emptyMessage = "";
                let emptyTitle = "";
                if(tripType === 'personal') tripType = 'business';
                else if(tripType === 'business') tripType = 'personal';
                if (tripType !== 'all' && timePeriod !== 'all') {
                    emptyTitle = `No ${tripType} Rides in Selected Period`;
                    emptyMessage = `You don't have any ${tripType} rides in the selected time period.`;
                } else if (tripType !== 'all') {
                    emptyTitle = `No ${tripType} Rides`;
                    emptyMessage = `You don't have any ${tripType} rides in your history.`;
                } else if (timePeriod !== 'all') {
                    switch (timePeriod) {
                        case '30days':
                            emptyTitle = "No Rides in the Last 30 Days";
                            emptyMessage = "You haven't taken any rides in the past 30 days. Ready to book your next trip?";
                            break;
                        case 'lastMonth':
                            emptyTitle = `No Rides in ${previousMonth}`;
                            emptyMessage = `You didn't take any rides during ${previousMonth}. Time to explore new destinations?`;
                            break;
                        case '3months':
                            emptyTitle = "No Recent Rides";
                            emptyMessage = "You haven't taken any rides in the last 3 months. Your ride history is waiting for new adventures!";
                            break;
                        default:
                            emptyTitle = "No Ride History Yet";
                            emptyMessage = "You haven't taken any rides yet. Your journey begins with that first trip!";
                    }
                } else {
                    emptyTitle = "No Ride History Yet";
                    emptyMessage = "You haven't taken any rides yet. Your journey begins with that first trip!";
                }
                
                historyList.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-car"></i>
                        <h3>${emptyTitle}</h3>
                        <p>${emptyMessage}</p>
                        <button class="book-ride-btn" onclick="window.location.href='ride.php'">
                            Book Your First Ride
                        </button>
                    </div>
                `;
            } else {
                historyList.innerHTML = filteredRides
                    .map(ride => `
                        <div class="history-item">
                            <div class="trip-info">
                                <div class="trip-route">${ride.pickupLocation} → ${ride.destination}</div>
                                <div class="trip-date">${formatDate(ride.rideDate)}</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="trip-price">$${ride.rent}</div>
                                <div class="trip-status status-completed">Completed</div>
                            </div>
                        </div>
                    `)
                    .join('');
            }
        }
        
        // Helper function to format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        }
        
        // Function to update stats with animation
        function updateStats() {
            // Animate total rides
            animateValue("totalRides", 0, <?php echo $has_rides ? $total_rides : 0; ?>, 1500);
            
            // Animate total distance
            animateValue("totalDistance", 0, <?php echo $has_rides ? round($total_distance) : 0; ?>, 1500);
            
            // Animate total spent
            animateValue("totalSpent", 0, <?php echo $has_rides ? $total_spent : 0; ?>, 1500, true);
        }
        
        // Function to animate value changes
        function animateValue(id, start, end, duration, isCurrency = false) {
            const obj = document.getElementById(id);
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                obj.innerHTML = isCurrency ? "$" + value.toFixed(2) : value;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
        
        // Tab switching functionality
        if (hasRides) {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    document.querySelectorAll('.tab').forEach(t => {
                        t.classList.remove('active');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Get the selected trip type
                    const tripType = this.getAttribute('data-tab');
                    
                    // Get the current time filter
                    const timeFilter = document.getElementById('timeFilter').value;
                    
                    // Render the filtered rides
                    renderRideHistory(tripType, timeFilter);
                });
            });
            
            // Filter change functionality
            document.getElementById('timeFilter').addEventListener('change', function() {
                // Get the current tab
                const activeTab = document.querySelector('.tab.active');
                const tripType = activeTab ? activeTab.getAttribute('data-tab') : 'all';
                
                // Render the filtered rides
                renderRideHistory(tripType, this.value);
            });
        }