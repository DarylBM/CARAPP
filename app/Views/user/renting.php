<?php
$user_name = isset($user_name) ? $user_name : '';
$user_phone = isset($user_phone) ? $user_phone : '';
?>
<?= $this->include('layout/header') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<style>
   body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    flex: 1;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-top: 90px;
}

h1 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
}

h1 i {
    margin-right: 10px;
    color: #4CAF50;
}

.form-group {
    margin-bottom: 15px;
    position: relative;
}

.form-group i {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #888;
    font-size: 16px;
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="time"] {
    width: 100%;
    padding: 12px 50px;
    border: 1px solid #ddd;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-size: 16px;
    background-color: #fafafa;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus,
input[type="time"]:focus {
    outline: none;
    border-color: #4CAF50;
    box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
}

button[type="submit"] {
    width: 100%;
    padding: 12px 0;
    border: none;
    border-radius: 6px;
    background-color: black;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: white;
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

.map {
    flex: 1;
    margin-left: 20px;
    margin-top: 90px;
    height: 800px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.map .leaflet-container {
    border-radius: 15px;
}

</style>

<div class="container">
    <div class="card">
        <h1>
            <i class="fas fa-car"></i> Car Rental Form
        </h1>
        <form id="rental-form" action="<?= site_url('rental/submit') ?>" method="post">
            <div class="form-group">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" id="firstlocation" name="firstlocation" placeholder="Enter First Location" value="Nacoco Highway, Calapan City, Oriental Mindoro, National High School" readonly>
            </div>
            <div class="form-group">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" id="secondlocation" name="secondlocation" placeholder="Enter Second Location">
            </div>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" placeholder="Your Name" value="<?= esc($user_name) ?>">
            </div>
            <div class="form-group">
                <i class="fas fa-phone"></i>
                <input type="text" id="phone" name="phone" placeholder="Your Phone" value="<?= esc($user_phone) ?>">
            </div>
            <div class="form-group">
                <i class="fas fa-calendar-alt"></i>
                <input type="text" id="start-date" name="start_date" placeholder="Start Date">
            </div>
            <div class="form-group">
                <i class="fas fa-calendar-alt"></i>
                <input type="text" id="end-date" name="end_date" placeholder="End Date">
            </div>
            <div class="form-group">
                <i class="fas fa-clock"></i>
                <input type="text" id="start-time" name="start_time" placeholder="Start Time">
            </div>
            <div class="form-group">
                <i class="fas fa-clock"></i>
                <input type="text" id="end-time" name="end_time" placeholder="End Time">
            </div>
            <div class="form-group">
                <i class="fas fa-dollar-sign"></i>
                <input type="text" id="price" name="price" placeholder="Auto-generated Price" readonly>
            </div>
            <button type="submit"><i class="fas fa-paper-plane"></i> Submit</button>
        </form>
    </div>
    <div class="map" id="map"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    let map;
    let firstMarker, secondMarker;
    let firstLocation = [13.4115, 121.1803]; // Coordinates for Nacoco Highway, Calapan City
    let secondLocation = null;
    let routeControl = null;
    let distanceInKm = 0;
    let ratePerKmPerHour = 10; // Adjust the rate here

    function initMap() {
        // Set the map's view to Nacoco Highway, Calapan City
        map = L.map('map').setView(firstLocation, 14); // Zoom level 14 for better view of roads and places

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Place marker for the first location (fixed)
        firstMarker = L.marker(firstLocation).addTo(map).bindPopup("Nacoco Highway, Calapan City, Oriental Mindoro, National High School").openPopup();

        // Add Geocoder Control for searching locations
        L.Control.geocoder().addTo(map);

        // Handle map clicks to set only the second location
        map.on('click', function(e) {
            const latlng = e.latlng;

            // Set second marker (changeable)
            if (!secondMarker) {
                placeMarker(latlng, 'second');
                reverseGeocode(latlng.lat, latlng.lng, 'second');
            } else {
                map.removeLayer(secondMarker);
                placeMarker(latlng, 'second');
                reverseGeocode(latlng.lat, latlng.lng, 'second');
            }

            // Draw route after setting the second location
            if (secondLocation) {
                drawRoute(firstLocation, secondLocation);
            }
        });
    }

    function placeMarker(latlng, locationType) {
        if (locationType === 'second') {
            secondMarker = L.marker(latlng).addTo(map).bindPopup("Second Location").openPopup();
            secondLocation = [latlng.lat, latlng.lng];
        }
    }

    function reverseGeocode(lat, lng, locationType) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.address) {
                    const { road, village, city, municipality, state, country } = data.address;
                    const formattedAddress = `${road || village || ''}, ${municipality || city || ''}, ${state || ''}, Philippines`;

                    if (locationType === 'second') {
                        document.getElementById('secondlocation').value = formattedAddress;
                    }
                } else {
                    alert('Address not found.');
                }
            })
            .catch(error => {
                console.error('Error during reverse geocoding:', error);
            });
    }

    // Function to calculate rental duration in hours
    function calculateDuration(startDate, startTime, endDate, endTime) {
        const start = new Date(`${startDate}T${startTime}`);
        const end = new Date(`${endDate}T${endTime}`);
        const duration = (end - start) / (1000 * 60 * 60); // Convert milliseconds to hours
        return duration > 0 ? duration : 0; // Ensure positive duration
    }

    // Function to calculate price based on km and rental duration
    function calculatePrice() {
        const startDate = document.getElementById('start-date').value;
        const startTime = document.getElementById('start-time').value;
        const endDate = document.getElementById('end-date').value;
        const endTime = document.getElementById('end-time').value;

        // Calculate rental duration in hours
        const rentalDuration = calculateDuration(startDate, startTime, endDate, endTime);

        // Calculate total price
        const totalPrice = distanceInKm * rentalDuration * ratePerKmPerHour;

        // Update the price input field
        document.getElementById('price').value = totalPrice.toFixed(2);
    }

    // Override drawRoute to capture distance in km
    function drawRoute(start, end) {
        if (routeControl) {
            map.removeControl(routeControl);
        }

        routeControl = L.Routing.control({
            waypoints: [
                L.latLng(start[0], start[1]),
                L.latLng(end[0], end[1])
            ],
            routeWhileDragging: true,
            createMarker: function() { return null; }
        })
        .on('routesfound', function(e) {
            const routes = e.routes;
            if (routes.length > 0) {
                // Get the distance in kilometers (converted from meters)
                distanceInKm = routes[0].summary.totalDistance / 1000;

                // Update price based on distance and time
                calculatePrice();
            }
        })
        .addTo(map);
    }

    // Initialize flatpickr for date and time inputs
    flatpickr('#start-date', { dateFormat: "Y-m-d" });
    flatpickr('#end-date', { dateFormat: "Y-m-d" });
    flatpickr('#start-time', { enableTime: true, noCalendar: true, dateFormat: "H:i" });
    flatpickr('#end-time', { enableTime: true, noCalendar: true, dateFormat: "H:i" });

    // Add event listeners to recalculate the price when date or time fields change
    document.getElementById('start-date').addEventListener('change', calculatePrice);
    document.getElementById('start-time').addEventListener('change', calculatePrice);
    document.getElementById('end-date').addEventListener('change', calculatePrice);
    document.getElementById('end-time').addEventListener('change', calculatePrice);

    // Initialize the map when the page loads
    window.onload = function() {
        initMap();
    }
</script>

<?= $this->include('layout/footer') ?>
