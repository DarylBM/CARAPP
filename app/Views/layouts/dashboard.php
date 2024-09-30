<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .calendar-container {
        margin: 20px 0;
        text-align: center;
    }

    .calendar-container i {
        font-size: 60px;
        cursor: pointer;
        color: #333;
    }

    .calendar-container i:hover {
        color: #007bff;
    }

    .charts-container {
    display: flex; /* Enable Flexbox layout */
    justify-content: space-between; /* Space between the cards */
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
    margin: 20px auto; /* Centering the container */
    max-width: 1200px; /* Optional: Set a max width for the container */
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Slightly stronger shadow */
    padding: 20px;
    margin: 10px; /* Space between cards */
    text-align: center;
    width: calc(50% - 20px); /* Each card takes half of the width minus margin */
    max-width: 600px; /* Optional: Set a maximum width */
}


    .card h3 {
        margin-bottom: 15px; /* Reduced margin */
        font-size: 22px; /* Slightly smaller font */
        font-weight: bold;
        color: #333; /* Darker color for better contrast */
    }

    .chart-container {
        width: 100%; 
        height: 200px; /* Smaller height */
        position: relative; /* Allows for better control of positioning */
    }

    canvas {
        border-radius: 8px; /* Rounded corners for the canvas */
        background-color: rgba(255, 255, 255, 0.8); /* Slight background to make it pop */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow around the canvas */
    }
</style>

<div class="head-title">
    <div class="left">
        <h1>Dashboard</h1>
        <ul class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li><a class="active" href="/ui">Home</a></li>
            <?php
            $session = session();
            if ($session->get('isLoggedIn')) {
                $userName = $session->get('name');
                echo "<h2>Hello, $userName!</h2>";
            }
            ?>
        </ul>
    </div>
</div>

<ul class="box-info">
    <li>
        <i class='bx bxs-calendar-check'></i>
        <span class="text">
            <h3><?= $userCount ?></h3>
            <p>Number of Users</p>
        </span>
    </li>

    <li>
        <i class='bx bxs-calendar-check'></i>
        <span class="text">
            <h3><?= $carCount ?></h3>
            <p>Number of Cars</p>
        </span>
    </li>

    <li>
        <i class='bx bxs-calendar-check'></i>
        <span class="text">
            <h3><?= $rentCount ?></h3>
            <p>Number of Rents</p>
        </span>
    </li>
</ul>

<div class="charts-container">
    <!-- Card for the counts chart -->
    <div class="card">
        <h3>Statistics Overview</h3>
        <div class="chart-container">
            <canvas id="statsChart"></canvas>
        </div>
    </div>

    <!-- Card for the rental chart -->
    <div class="card">
        <h3>Rental Statistics</h3>
        <div class="chart-container">
            <canvas id="rentalChart"></canvas>
        </div>
    </div>
</div>

<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Recent Users</h3>
            <a href="/admin">
                <i class='bx bx-search'></i>
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Date Registered</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($users) && !empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><img src="img/people.png"><p><?= esc($user['name']) ?></p></td>
                            <td><?= date('d-m-Y', strtotime($user['created_at'])) ?></td>
                            <td><span class="status active">Active</span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No recent users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="rental-schedule">
        <div class="head">
            <h3>Rental Schedule</h3>
        </div>

        <div class="calendar-container">
            <i class='bx bxs-calendar' id="calendar-icon"></i>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Redirect to Rentman page when the calendar icon is clicked
    document.getElementById('calendar-icon').addEventListener('click', function() {
        window.location.href = '/rentman';
    });

    // Data for the counts chart (Users, Cars, Rents)
    var ctx = document.getElementById('statsChart').getContext('2d');
    var statsChart = new Chart(ctx, {
        type: 'bar', // Using bar chart to visualize the counts
        data: {
            labels: ['Users', 'Cars', 'Rents'], // Labels for the X-axis
            datasets: [{
                label: 'Counts', // Label for the dataset
                data: [<?= $userCount ?>, <?= $carCount ?>, <?= $rentCount ?>], // Values for Users, Cars, Rents
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)', // Light blue
                    'rgba(153, 102, 255, 0.5)', // Light purple
                    'rgba(255, 159, 64, 0.5)'   // Light orange
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)', // Dark blue
                    'rgba(153, 102, 255, 1)', // Dark purple
                    'rgba(255, 159, 64, 1)'   // Dark orange
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Ensures that the Y-axis starts from 0
                }
            },
            responsive: true,
            maintainAspectRatio: false // Ensure it looks good on all screens
        }
    });

    // Data for the rental chart
    const ctxRental = document.getElementById('rentalChart').getContext('2d');
    const rentalChart = new Chart(ctxRental, {
        type: 'bar', // You can change this to 'line', 'pie', etc.
        data: {
            labels: <?= json_encode($chartData['labels']) ?>,
            datasets: [{
                label: 'Number of Rentals',
                data: <?= json_encode($chartData['data']) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Slightly darker
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>