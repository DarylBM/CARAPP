<?= $this->include('layout/header') ?>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 200px;
            float: left;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <h1>Car List</h1>
    <?php foreach ($cars as $car): ?>
        <div class="card">
            <p>Model: <?php echo isset($car['Model']) ? $car['Model'] : 'N/A'; ?></p>
            <p>Year: <?php echo isset($car['Year']) ? $car['Year'] : 'N/A'; ?></p>
            <p>Color: <?php echo isset($car['Color']) ? $car['Color'] : 'N/A'; ?></p>
            <p>Mileage: <?php echo isset($car['Mileage']) ? $car['Mileage'] : 'N/A'; ?></p>
            <p>Transmission: <?php echo isset($car['Transmission']) ? $car['Transmission'] : 'N/A'; ?></p>
            <p>FuelType: <?php echo isset($car['FuelType']) ? $car['FuelType'] : 'N/A'; ?></p>
        </div>
    <?php endforeach; ?>
</body>
<script src="<?= base_url('js/script.js') ?>"></script>

<!-- 
  - ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

