<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<style>
    /* General styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f2f5;
        color: #333;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Prevent horizontal overflow */
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s; /* Animation on container load */
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #007bff;
    }

    .alert {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        display: inline-block;
        transition: all 0.3s; /* Smooth transition */
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
        transition: background-color 0.3s;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1; /* Highlight row on hover */
    }

    button {
        padding: 10px 20px; /* Adjusted padding for a better look */
        font-size: 16px; /* Slightly larger font size */
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease; /* Smooth transition */
        border: none; /* Remove default border */
        color: white; /* White text for contrast */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Shadow for depth */
    }

    button.submit {
        background: linear-gradient(90deg, #28a745, #218838); /* Gradient for submit button */
    }

    button.submit:hover {
        background: linear-gradient(90deg, #218838, #1e7e34); /* Darker gradient on hover */
    }

    button.cancel {
        background: linear-gradient(90deg, #ffc107, #e0a800); /* Gradient for cancel button */
    }

    button.cancel:hover {
        background: linear-gradient(90deg, #e0a800, #c69500); /* Darker gradient on hover */
    }

    button.delete {
        background-color: #dc3545; /* Red background for delete button */
    }

    button.delete:hover {
        background-color: #c82333; /* Darker red on hover */
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        button {
            width: 100%;
            margin-bottom: 10px;
        }

        table {
            display: block;
            overflow-x: auto;
        }

        th, td {
            white-space: nowrap;
        }
    }

    /* Popup Form styles */
    #carForm {
        display: none;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 20px; /* Reduced padding */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        width: 70%; /* Reduced width */
        max-width: 400px; /* Reduced max width */
        box-sizing: border-box; /* Include padding and border in element's total width */
        animation: slideIn 0.5s; /* Slide-in animation */
    }

    @keyframes slideIn {
        from { transform: translate(-50%, -60%); opacity: 0; }
        to { transform: translate(-50%, -50%); opacity: 1; }
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="number"]:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Overlay styles */
    .overlay {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Black overlay with opacity */
        z-index: 999; /* Behind the popup */
    }
</style>

<div class="container">
    <h1>Car Management</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <button class="submit" onclick="openForm()">Add Car</button>

    <table>
        <thead>
            <tr>
                <th>Model</th>
                <th>Year</th>
                <th>Color</th>
                <th>Mileage</th>
                <th>Transmission</th>
                <th>Fuel Type</th>
                <th>Price</th>
                <th>Image</th> <!-- New column for image -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?= esc($car['Model']) ?></td>
                    <td><?= esc($car['Year']) ?></td>
                    <td><?= esc($car['Color']) ?></td>
                    <td><?= esc($car['Mileage']) ?></td>
                    <td><?= esc($car['Transmission']) ?></td>
                    <td><?= esc($car['FuelType']) ?></td>
                    <td><?= esc($car['Price']) ?></td>
                    <td>
                        <img src="<?= base_url('uploaded_images/' . $car['Image']); ?>" height="100" alt="Car Image"> <!-- Display the car image -->
                    </td>
                    <td>
                        <button class="submit" onclick="openEditForm(<?= esc($car['Carid']) ?>)">Update</button>
                        <a href="<?= base_url("car/delete/{$car['Carid']}") ?>" onclick="return confirm('Are you sure?')">
                            <button class="delete">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Overlay for popup form -->
    <div class="overlay" id="overlay" onclick="closeForm()"></div>

    <!-- Popup Form -->
    <div id="carForm">
        <form id="carFormElement" action="<?= base_url('car/store') ?>" method="post" enctype="multipart/form-data"> <!-- Added enctype -->
            <?= csrf_field() ?>
            <input type="hidden" name="Carid" id="carIdField">

            <div class="form-group">
                <label>Model:</label>
                <input type="text" name="Model" id="modelField" required>
            </div>

            <div class="form-group">
                <label>Year:</label>
                <input type="number" name="Year" id="yearField" required>
            </div>

            <div class="form-group">
                <label>Color:</label>
                <input type="text" name="Color" id="colorField" required>
            </div>

            <div class="form-group">
                <label>Mileage:</label>
                <input type="number" name="Mileage" id="mileageField" required>
            </div>

            <div class="form-group">
                <label>Transmission:</label>
                <input type="text" name="Transmission" id="transmissionField" required>
            </div>

            <div class="form-group">
                <label>Fuel Type:</label>
                <input type="text" name="FuelType" id="fuelTypeField" required>
            </div>

            <div class="form-group">
                <label>Price:</label>
                <input type="number" name="Price" id="priceField" required>
            </div>

            <div class="form-group">
                <label>Car Image:</label>
                <input type="file" name="car_image" accept="image/*"> <!-- File input for image upload -->
            </div>

            <button type="submit" class="submit">Submit</button>
            <button type="button" class="cancel" onclick="closeForm()">Cancel</button>
        </form>
    </div>
</div>

<script>
function openForm() {
    document.getElementById("carForm").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function closeForm() {
    document.getElementById("carForm").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

function openEditForm(carId) {
    openForm();
    document.getElementById("carFormElement").action = "<?= base_url('car/update/') ?>" + carId; // Set the action to update route

    // Fetch the car details via an AJAX request
    fetch("<?= base_url('car') ?>/" + carId)
        .then(response => response.json())
        .then(data => {
            document.getElementById("carIdField").value = data.Carid;
            document.getElementById("modelField").value = data.Model;
            document.getElementById("yearField").value = data.Year;
            document.getElementById("colorField").value = data.Color;
            document.getElementById("mileageField").value = data.Mileage;
            document.getElementById("transmissionField").value = data.Transmission;
            document.getElementById("fuelTypeField").value = data.FuelType;
            document.getElementById("priceField").value = data.Price;
        });
}
</script>

<?= $this->endSection() ?>