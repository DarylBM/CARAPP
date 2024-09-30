<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h3 {
            margin: 0;
        }

        /* Button styles */
        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .btn:hover {
            background-color: #218838;
        }

        /* Icon styles */
        .btn i {
            margin-right: 5px;
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.6); /* Black with opacity */
            padding-top: 0; /* No padding at the top */
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Center the modal */
            padding: 20px;
            border: 1px solid #888;
            width: 90%; /* Responsive width */
            max-width: 500px; /* Maximum width for the modal */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); /* Shadow for better visibility */
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

        /* Form styles */
        .box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .box:focus {
            border-color: #28a745; /* Highlight on focus */
            outline: none;
        }

        /* Product list styles */
        .product-display {
            margin-top: 20px;
        }

        .product-display table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .product-display th, .product-display td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-display th {
            background-color: #f8f9fa;
        }

        .product-display tr:hover {
            background-color: #f1f1f1;
        }

        /* Message styles */
        .message {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #e7f3fe;
            color: #31708f;
            border: 1px solid #bce8f1;
            border-radius: 4px;
        }

        /* Delete button styles */
        .delete {
            background-color: #dc3545;
        }

        .delete:hover {
            background-color: #c82333;
        }

        /* Action button styles */
        .action-btns {
            display: flex;
            gap: 10px;
        }

        .action-btns .btn {
            padding: 5px 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .action-btns .btn.edit {
            background-color: #007bff;
        }

        .action-btns .btn.edit:hover {
            background-color: #0069d9;
        }

        .action-btns .btn.delete {
            background-color: #dc3545;
        }

        .action-btns .btn.delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="message"><?= session()->getFlashdata('message'); ?></div>
    <?php endif; ?>

    <div class="container">
        <div class="header">
            <h3>Product Management</h3>
            <button id="addProductBtn" class="btn">Add New Car</button>
        </div>

        <div class="product-display">
            <h3>Product List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Mileage</th>
                        <th>Fuel Type</th>
                        <th>Transmission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><img src="<?= base_url('uploaded_img/' . $product['image']); ?>" height="100" alt="<?= esc($product['model']); ?>"></td>
                            <td><?= esc($product['model']); ?></td>
                            <td><?= esc($product['price']); ?></td>
                            <td><?= esc($product['mileage']); ?></td>
                            <td><?= esc($product['fueltype']); ?></td>
                            <td><?= esc($product['transmission']); ?></td>
                            <td class="action-btns">
                                <button class="btn edit editBtn" data-id="<?= $product['id']; ?>" data-model="<?= esc($product['model']); ?>" data-price="<?= esc($product['price']); ?>" data-mileage="<?= esc($product['mileage']); ?>" data-fuel="<?= esc($product['fueltype']); ?>" data-transmission="<?= esc($product['transmission']); ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('admins/delete/' . $product['id']); ?>" class="btn delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeAddModal">&times;</span>
            <form action="<?= base_url('admins/add'); ?>" method="post" enctype="multipart/form-data">
                <h3>Add a New Product</h3>
                <input type="text" name="product_name" placeholder="Model" class="box" required>
                <input type="number" name="product_price" placeholder="Enter product price" class="box" required>
                <input type="number" name="mileage" placeholder="Enter mileage" class="box" required>
                <input type="text" name="fueltype" placeholder="Enter fuel type" class="box" required>
                <input type="text" name="transmission" placeholder="Enter transmission" class="box" required>
                <input type="file" name="product_image" class="box" accept="image/png, image/jpeg, image/jpg" required>
                <input type="submit" value="Add Product" class="btn">
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditModal">&times;</span>
            <form id="editProductForm" action="" method="post" enctype="multipart/form-data">
                <h3>Update Product</h3>
                <input type="text" name="product_name" id="editModel" class="box" required>
                <input type="number" name="product_price" id="editPrice" class="box" required>
                <input type="number" name="mileage" id="editMileage" class="box" required>
                <input type="text" name="fueltype" id="editFuel" class="box" required>
                <input type="text" name="transmission" id="editTransmission" class="box" required>
                <input type="file" name="product_image" class="box" accept="image/png, image/jpeg, image/jpg">
                <input type="submit" value="Update Product" name="update_product" class="btn">
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var addModal = document.getElementById("addProductModal");
        var editModal = document.getElementById("editProductModal");

        // Get the button that opens the modal
        var addBtn = document.getElementById("addProductBtn");

        // Get the <span> element that closes the modal
        var closeAddModal = document.getElementById("closeAddModal");
        var closeEditModal = document.getElementById("closeEditModal");

        // When the user clicks the button, open the modal 
        addBtn.onclick = function() {
            addModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        closeAddModal.onclick = function() {
            addModal.style.display = "none";
        }

        closeEditModal.onclick = function() {
            editModal.style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target === addModal) {
                addModal.style.display = "none";
            } else if (event.target === editModal) {
                editModal.style.display = "none";
            }
        }

        // Edit button click event
        var editButtons = document.querySelectorAll(".editBtn");
        editButtons.forEach(function(button) {
            button.onclick = function() {
                var productId = this.getAttribute('data-id');
                var model = this.getAttribute('data-model');
                var price = this.getAttribute('data-price');
                var mileage = this.getAttribute('data-mileage');
                var fuel = this.getAttribute('data-fuel');
                var transmission = this.getAttribute('data-transmission');

                // Set the action for the edit form
                document.getElementById("editProductForm").action = "<?= base_url('admins/edit/'); ?>" + productId;

                // Populate the form fields
                document.getElementById("editModel").value = model;
                document.getElementById("editPrice").value = price;
                document.getElementById("editMileage").value = mileage;
                document.getElementById("editFuel").value = fuel;
                document.getElementById("editTransmission").value = transmission;

                // Show the edit modal
                editModal.style.display = "block";
            }
        });
    </script>
</body>
</html>
<?= $this->endsection() ?>
