<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<style>
    /* General styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
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
        transition: background-color 0.2s;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    th:hover {
        background-color: #0056b3;
    }

    td:hover {
        background-color: #f1f1f1;
    }

    .button {
        display: inline-flex;
        align-items: center;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .button.edit {
        background-color: #007bff;
        color: white;
    }

    .button.edit:hover {
        background-color: #0056b3;
        transform: translateY(-1px);
    }

    .button.delete {
        background-color: #dc3545;
        color: white;
    }

    .button.delete:hover {
        background-color: #c82333;
        transform: translateY(-1px);
    }

    .icon {
        margin-right: 5px;
    }

    input[type="text"],
    input[type="email"],
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
    input[type="email"]:focus,
    input[type="number"]:focus {
        border-color: #007bff;
        outline: none;
    }

    button[type="submit"],
    button[type="reset"] {
        padding: 10px 15px;
        font-size: 16px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"] {
        background-color: #28a745;
    }

    button[type="submit"]:hover {
        background-color: #218838;
    }

    button[type="reset"] {
        background-color: #ffc107;
        margin-left: 10px;
    }

    button[type="reset"]:hover {
        background-color: #e0a800;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 50px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 8px;
        width: 40%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from { top: -50px; opacity: 0; }
        to { top: 0; opacity: 1; }
    }

    .modal-header {
        font-size: 24px;
        margin-bottom: 20px;
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

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .modal-footer {
        text-align: right;
    }
    
</style>

<div class="container">
    <h1>Payment Management</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('errors') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('payment/search') ?>" method="GET">
        <input type="text" name="search" placeholder="Search by name, card number..." required>
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Card Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($payments)): ?>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= esc($payment['id']) ?></td>
                        <td><?= esc($payment['card_number']) ?></td>
                        <td><?= esc($payment['name']) ?></td>
                        <td><?= esc($payment['address']) ?></td>
                        <td><?= esc($payment['payment_method']) ?></td>
                        <td>
                        <button class="button edit" onclick="openModal(<?= esc($payment['id']) ?>, '<?= htmlspecialchars($payment['card_number']) ?>', '<?= htmlspecialchars($payment['name']) ?>', '<?= htmlspecialchars($payment['address']) ?>', '<?= htmlspecialchars($payment['payment_method']) ?>')">
        <i class="fas fa-edit icon"></i>Edit
    </button>
    <a href="<?= base_url('payment/delete/' . esc($payment['id'])) ?>" onclick="return confirm('Are you sure you want to delete this payment?');" style="text-decoration: none;">
        <button class="button delete">
            <i class="fas fa-trash icon"></i>Delete
        </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No payment records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Modal for editing payment -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 class="modal-header">Edit Payment</h2>
            <form id="editForm" action="" method="POST">
                <input type="hidden" id="paymentId" name="id" value="">
                
                <div class="form-group">
                    <label for="card_number">Card Number:</label>
                    <input type="text" id="card_number" name="card_number" required>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <input type="text" id="payment_method" name="payment_method" required>
                </div>

                <div class="modal-footer">
                    <button type="submit">Update</button>
                    <button type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to open modal and populate form with payment data
function openModal(id, card_number, name, address, payment_method) {
    document.getElementById('editModal').style.display = "block";
    document.getElementById('editForm').action = "<?= base_url('payment/update/') ?>" + id;
    document.getElementById('paymentId').value = id;
    document.getElementById('card_number').value = card_number;
    document.getElementById('name').value = name;
    document.getElementById('address').value = address;
    document.getElementById('payment_method').value = payment_method;
}

// Function to close modal
function closeModal() {
    document.getElementById('editModal').style.display = "none";
}

// Close modal if user clicks anywhere outside of it
window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
        closeModal();
    }
}
</script>

<?= $this->endSection() ?>
