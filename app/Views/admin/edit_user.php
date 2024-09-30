<?= $this->extend('backend/layout/pages-layout') ?>
<?= $this->section('content') ?>
<style>
    /* Modal styles */
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        padding-top: 100px; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 5px;
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

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ccc;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<h1>User Management</h1>

<a href="<?= base_url('admin') ?>">See All Users</a>

<form action="<?= base_url('admin/search') ?>" method="GET">
    <input type="text" name="search" placeholder="Search by Username">
    <button type="submit">Search</button>
</form>

<!-- Display Users -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['phone'] ?></td>
        <td><?= $user['address'] ?></td>
        <td>
            <a href="#" onclick="openModal(<?= $user['id'] ?>, '<?= $user['name'] ?>', '<?= $user['email'] ?>', '<?= $user['phone'] ?>', '<?= $user['address'] ?>')">Edit</a> |
            <a href="<?= base_url('admin/delete/' . $user['id']) ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- The Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit User</h2>
        <form id="editForm" action="" method="POST">
            <input type="hidden" id="userId" name="id" value="">
            <label for="name">Username:</label><br>
            <input type="text" id="name" name="name" value=""><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value=""><br><br>

            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value=""><br><br>

            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address" value=""><br><br>

            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
// Function to open modal and populate form with user data
function openModal(id, name, email, phone, address) {
    document.getElementById('editModal').style.display = "block";
    document.getElementById('editForm').action = "<?= base_url('admin/update/') ?>" + id;
    document.getElementById('userId').value = id;
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('address').value = address;
}

// Function to close modal
function closeModal() {
    document.getElementById('editModal').style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
        closeModal();
    }
}
</script>

<?= $this->endsection() ?>
