<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* General styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 1200px; /* Updated width */
        margin: 20px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #007bff; /* Color for heading */
    }

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
        background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 500px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        cursor: pointer;
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
    }

    th {
        background-color: #007bff;
        color: white;
    }

    button {
        padding: 10px 20px; /* Adjusted padding */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease; /* Smooth transition */
        color: white; /* White text for contrast */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Shadow for depth */
    }

    button.submit {
        background: linear-gradient(90deg, #007bff, #0056b3); /* Gradient for submit button */
    }

    button.submit:hover {
        background: linear-gradient(90deg, #0056b3, #003d7a); /* Darker gradient on hover */
    }

    button.delete {
        background-color: #dc3545; /* Red background for delete button */
    }

    button.delete:hover {
        background-color: #c82333; /* Darker red on hover */
    }

    form {
        margin-bottom: 20px;
    }

    input[type="text"], input[type="email"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 15px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus, input[type="email"]:focus {
        border-color: #007bff;
        outline: none;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        /* Responsive adjustments */
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
</style>

<div class="container">
    <h1>User Management</h1>
    <a href="<?= base_url('admin') ?>">See All Users</a>

    <form action="<?= base_url('admin/search') ?>" method="GET">
        <input type="text" name="search" placeholder="Search by Username" required>
        <button type="submit" class="submit">Search</button>
    </form>

    <!-- Display Users -->
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['address'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td>
                <a href="<?= base_url('admin/delete/' . $user['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?');" style="text-decoration: none;">
                    <button class="delete">Delete</button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?= $this->endSection() ?>
