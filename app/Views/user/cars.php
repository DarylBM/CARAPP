    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?= $this->include('layout/header') ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
        <style>
            /* Your existing styles */
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f0f3;
                margin: 0;
                padding: 0;
                color: #333;
            }
            h1 {
                text-align: center;
                margin: 40px 0;
                font-size: 2.8em;
                color: #2c3e50;
                text-transform: uppercase;
                letter-spacing: 3px;
                font-weight: 600;
            }
            .container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                grid-gap: 30px;
                padding: 20px;
                max-width: 1200px;
                margin: 0 auto;
            }
            .card {
                background-color: #fff;
                border-radius: 15px;
                overflow: hidden;
                width: 100%;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
                position: relative;
                text-align: center;
            }
            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            }
            .img-container {
                padding: 10px;
                border: 2px solid #ddd;
                border-radius: 15px;
                box-sizing: border-box;
            }
            .card img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border: none;
            }
            .card-content {
                padding: 15px;
            }
            .card-content p {
                margin: 10px 0;
                font-size: 1.2em;
                color: #555;
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }
            .card-content i {
                margin-right: 10px;
                color: #000;
                font-size: 1.2em;
            }
            .price {
                font-size: 1.4em;
                font-weight: 600;
                color: #27ae60;
                margin-top: 15px;
            }
            .button {
                display: inline-flex;
                align-items: center;
                margin: 15px 10px 0;
                padding: 12px 20px;
                background-color: #000;
                color: #fff;
                border: 2px solid #f39c12;
                border-radius: 30px;
                font-size: 1em;
                font-weight: 600;
                transition: background-color 0.3s ease, transform 0.3s ease;
                text-decoration: none;
            }
            .button:hover {
                background-color: #f39c12;
                color: #000;
                transform: scale(1.05);
            }
            .button i {
                margin-right: 8px;
                transition: transform 0.2s;
            }
            .button:hover i {
                transform: scale(1.2);
            }
            
            /* Modal styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(10px);
            }
            .modal-content {
                background-color: #fff;
                margin: 5% auto;
                padding: 40px;
                border-radius: 30px;
                width: 80%; /* Increased size */
                max-width: 1000px;
                box-shadow: 0 6px 30px rgba(0, 0, 0, 0.3);
                position: relative;
                display: flex;
                gap: 40px;
                justify-content: space-between;
            }
            .modal-content img {
                width: 100%;
                height: auto;
                border-radius: 20px;
                margin-bottom: 20px;
                border: 4px solid #f39c12;
            }
            .close {
                position: absolute;
                top: 15px;
                right: 20px;
                font-size: 32px;
                color: #555;
                cursor: pointer;
                transition: color 0.3s ease;
            }
            .close:hover {
                color: #f39c12;
            }
            .car-info {
                flex: 1;
                text-align: left;
            }
            .payment-methods {
                flex: 1;
                padding-left: 30px;
                border-left: 2px solid #f0f0f0;
            }
            .payment-methods form {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .payment-methods h2 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }
            .payment-methods label {
                font-size: 1.1em;
                color: #555;
            }
            .payment-methods input,
            .payment-methods select {
                padding: 15px;
                font-size: 1.1em;
                border-radius: 8px;
                border: 1px solid #ddd;
                transition: border-color 0.3s ease;
            }
            .payment-methods input:focus,
            .payment-methods select:focus {
                border-color: #f39c12;
                outline: none;
            }
            .payment-methods .button {
                padding: 15px;
                background-color: #f39c12;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 1.2em;
                cursor: pointer;
            }
            .payment-methods .button:hover {
                background-color: #e67e22;
            }
            
            /* Responsive styles */
            @media (max-width: 768px) {
                .modal-content {
                    flex-direction: column;
                    gap: 20px;
                }
                .payment-methods {
                    padding-left: 0;
                    border-left: none;
                }
            }
        </style>
    </head>
    <body>
    <h1>Cars ni Jovan</h1>
        <div class="container">
            <?php foreach ($cars as $car): ?>
            <div class="card">
                <div class="img-container">
                <img src="<?= base_url('uploads/' . esc($car['image'])) ?>" alt="<?= htmlspecialchars($car['Model']) ?>">
                </div>
                <div class="card-content">
                    <p><i class="fa-solid fa-car"></i><strong> Model:</strong> <?= htmlspecialchars($car['Model']) ?></p>
                    <p><i class="fa-solid fa-calendar"></i><strong> Year:</strong> <?= htmlspecialchars($car['Year']) ?></p>
                    <p><i class="fa-solid fa-tint"></i><strong> Color:</strong> <?= htmlspecialchars($car['Color']) ?></p>
                    <p><i class="fa-solid fa-cogs"></i><strong> Transmission:</strong> <?= htmlspecialchars($car['Transmission']) ?></p>
                    <p class="price">$<?= htmlspecialchars(number_format((float)$car['Price'], 0)) ?></p>
                </div>
                    <button class="button" onclick="showModal(
                        '<?= htmlspecialchars($car['Model']) ?>', 
                        '<?= htmlspecialchars($car['Year']) ?>', 
                        '<?= htmlspecialchars($car['Color']) ?>', 
                        '<?= htmlspecialchars($car['Transmission']) ?>', 
                        '<?= htmlspecialchars(number_format((float)$car['Price'], 0)) ?>',
                        '<?= base_url('uploads/' . $car['Image']) ?>'
                    )"><i class="fa-solid fa-credit-card"></i>Checkout</button>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- Car Information (Left) -->
                <div class="car-info">
                    <span class="close" onclick="hideModal()">&times;</span>
                    <img id="modalImage" src="" alt="Car Image">
                    <h2 id="model"></h2>
                    <p><i class="fa-solid fa-calendar"></i> <strong>Year:</strong> <span id="year"></span></p>
                    <p><i class="fa-solid fa-paintbrush"></i> <strong>Color:</strong> <span id="color"></span></p>
                    <p><i class="fa-solid fa-cogs"></i> <strong>Transmission:</strong> <span id="transmission"></span></p>
                    <p class="price"><strong>Price: </strong> $<span id="price"></span></p>
                </div>

                <!-- Payment Information (Right) -->
            <!-- Updated Payment Form Section -->
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
<<<<<<< Updated upstream

            <!-- Payment Information (Right) -->
           <!-- Updated Payment Form Section -->
           <div class="payment-methods"> 
    <h2>Payment Details</h2>
    <form action="<?= base_url('payment/submit') ?>" method="post"> <!-- Change action to your controller's method -->
        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" name="card-number" placeholder="XXXX-XXXX-XXXX-XXXX" required>

        <label for="card-name">Name</label>
        <input type="text" id="card-name" name="card-name" placeholder="Name" required>

        <label for="card-address">Address</label>
        <input type="text" id="card-address" name="card-address" placeholder="St, City, Country" required>

        <label for="payment-method">Payment Method</label>
        <select id="payment-method" name="payment-method" required>
            <option value="creditCard">Credit Card</option>
            <option value="paypal">Paypal</option>
            <option value="gcash">GCash</option>
        </select>

        <button type="submit" class="button"><i class="fa-solid fa-credit-card"></i> Pay Now</button>
    </form>
</div>


=======
>>>>>>> Stashed changes
        </div>
        
        <script>
            function showModal(model, year, color, transmission, price, image) {
                document.getElementById('model').textContent = model;
                document.getElementById('year').textContent = year;
                document.getElementById('color').textContent = color;
                document.getElementById('transmission').textContent = transmission;
                document.getElementById('price').textContent = price;
                document.getElementById('modalImage').src = image;
                document.getElementById('myModal').style.display = "block";
            }

            function hideModal() {
                document.getElementById('myModal').style.display = "none";
            }
        </script>

    <?= $this->include('layout/footer') ?>
    </body>
    </html>
