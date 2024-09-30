<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?= $this->include('layout/header') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400,600&display=swap" rel="stylesheet">
    <style>
        /* General styles */
        body {
            font-family: 'Roboto', sans-serif; /* Changed to Roboto for general text */
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
            font-family: 'Montserrat', sans-serif; /* Changed to Montserrat for headings */
        }

        /* Search Container */
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-container input {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-btn {
            padding: 10px 15px;
            border: none;
            background-color: #333;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 5px;
            transition: background-color 0.3s ease;
        }

        .search-btn:hover {
            background-color: #555;
        }

        /* Card Container */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Card Styles */
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 15px;
            flex: 1 1 calc(33% - 30px);
            height: 400px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            position: relative;
            min-width: 300px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Card Image */
        .card-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        /* Card Body */
        .card-body {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .car-title {
            font-size: 1.8em;
            margin: 0 0 10px;
            color: #333;
            line-height: 1.2;
            font-family: 'Montserrat', sans-serif; /* Changed to Montserrat for car titles */
        }

        .price {
            font-size: 1.5em;
            margin: 0;
            color: #333;
            font-family: 'Montserrat', sans-serif; /* Changed to Montserrat for price */
        }

        .car-details {
            position: absolute;
            bottom: 60px;
            left: 15px;
            right: 15px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 4px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .card:hover .car-details {
            opacity: 1;
        }

        .car-details p {
            display: flex;
            align-items: center;
            margin: 5px 0;
            line-height: 1.5;
            font-size: 1.1em;
            font-family: 'Roboto', sans-serif; /* Changed to Roboto for car details */
        }

        .car-details i {
            margin-right: 10px;
            font-size: 1.5em;
            color: #333;
        }

        /* Button Styles */
        .cta-buttons {
            text-align: center;
            margin-top: auto;
        }

        .checkout-btn {
            background-color: black;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            font-size: 1.2em;
        }

        .checkout-btn:hover {
            background-color: #444;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 900px;
            width: 100%;
        }

        .car-info {
            width: 45%;
            padding-right: 20px;
            border-right: 1px solid #eee;
        }

        .car-info img {
            width: 100%;
            max-height: 250px; /* Fixed height for modal image */
            object-fit: cover;
            margin-bottom: 15px;
        }

        .car-info h2 {
            font-size: 2em; /* Enhanced size for better visibility */
            margin-bottom: 10px;
            font-family: 'Montserrat', sans-serif; /* Changed to Montserrat for modal car title */
            color: #333; /* Added color for better contrast */
        }

        .price-modal {
            font-size: 1.8em; /* Enhanced size for price display */
            color: green; /* Color for price to stand out */
            margin-top: 15px;
            font-family: 'Montserrat', sans-serif; /* Changed to Montserrat for modal price */
        }

        .payment-methods {
            width: 50%;
            padding-left: 20px;
        }

        .payment-methods h2 {
            font-family: 'Montserrat', sans-serif; /* Changed to Montserrat for payment heading */
        }

        .payment-methods form {
            display: flex;
            flex-direction: column;
        }

        .payment-methods input,
        .payment-methods select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            font-family: 'Roboto', sans-serif; /* Changed to Roboto for inputs */
        }

        .payment-methods button {
            background-color: black;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .payment-methods button:hover {
            background-color: #444;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Car List</h1>

<div class="search-container">
    <input type="text" id="searchInput" placeholder="Search for cars..." onkeyup="searchCars()">
    <button class="search-btn"><i class="fas fa-search"></i></button>
</div>

<div class="container">
    <?php if (!empty($cars) && is_array($cars)): ?>
        <?php foreach ($cars as $car): ?>
            <div class="card">
                <div class="card-image">
                    <img src="<?= base_url('uploaded_img/' . $car['image']) ?>" alt="<?= esc($car['model']) ?>" class="img-fluid">
                </div>
                <div class="card-body">
                    <h3 class="car-title"><?= esc($car['model']) ?></h3>
                    <p class="price text-success"><strong>₱<?= esc($car['price']) ?></strong></p>
                    
                    <div class="car-details">
                        <p><i class="fas fa-car"></i> <?= esc($car['fueltype']) ?></p>
                        <p><i class="fas fa-cogs"></i> <?= esc($car['transmission']) ?></p>
                        <p><i class="fas fa-tachometer-alt"></i> <?= esc($car['mileage']) ?> km</p>
                    </div>

                    <div class="cta-buttons">
                    <button class="checkout-btn" onclick="openModal('<?= esc($car['model']) ?>', <?= esc($car['price']) ?>, '<?= base_url('uploaded_img/' . $car['image']) ?>')">
    <i class="fas fa-shopping-cart"></i> Check Out
</button>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No cars available.</p>
    <?php endif; ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="car-info">
            <img id="modalCarImage" src="" alt="Car Image">
            <h2 id="modalCarModel"></h2>
            <div class="price-modal" id="modalCarPrice"></div>
        </div>
        <div class="payment-methods">
            <h2>Payment Details</h2>
            <form method="POST" action="<?= base_url('payment/submit'); ?>">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card-number" placeholder="XXXX-XXXX-XXXX-XXXX" required>

                <label for="card-name">Name</label>
                <input type="text" id="card-name" name="card-name" placeholder="Name" required>

                <label for="card-address">Address</label>
                <input type="text" id="card-address" name="card-address" placeholder=" St, City, Country" required>

                <label for="payment-method">Payment Method</label>
                <select id="payment-method" name="payment-method" required>
                    <option value="creditCard">Credit Card</option>
                    <option value="paypal">Paypal</option>
                    <option value="gcash">GCash</option>
                </select>

                <button type="submit" class="button"><i class="fa-solid fa-credit-card"></i> Pay Now</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(carModel, carPrice, carImage) {
        document.getElementById("modalCarModel").innerText = carModel;
        document.getElementById("modalCarPrice").innerText = "₱" + carPrice;
        document.getElementById("modalCarImage").src = carImage; // Set the image source
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function searchCars() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.getElementsByClassName('card');

        for (let i = 0; i < cards.length; i++) {
            const title = cards[i].getElementsByClassName('car-title')[0].innerText.toLowerCase();
            if (title.indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
</script>

<?= $this->include('layout/footer') ?>
</body>
</html>
