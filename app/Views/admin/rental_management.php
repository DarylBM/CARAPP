<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<body>
    <style>
        /* General body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container for central layout */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Main heading */
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.5rem;
            text-align: center;
        }

        /* Calendar section */
        #calendar {
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            max-width: 500px;
            max-height: 80vh; /* Set a max height for the modal */
            overflow-y: auto; /* Enable vertical scrolling */
            margin: auto;
        }

        /* Close button for modal */
        .close {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 25px;
            color: #888;
            transition: color 0.3s;
        }

        .close:hover {
            color: #e74c3c;
        }

        /* Modal background */
        #updateModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        /* Button styling */
        button {
            background-color: #3498db; /* Default button color */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem; /* Size for the default button */
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
            padding: 10px 15px; /* Adjusted padding for a larger button */
        }

        /* Specific style for the update button */
        button[type="submit"] {
            background-color: green; /* Change color to green for the update button */
        }

        button[type="submit"]:hover {
            background-color: darkgreen; /* Darker green on hover */
        }

        /* Input field styling */
        input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="date"]:focus, input[type="time"]:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .modal-content {
                width: 90%;
                padding: 20px;
            }
        }

        /* Calendar event styles */
        .fc-event {
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 5px;
            text-align: center;
        }

        .fc-daygrid-event:hover {
            opacity: 0.8;
        }

        /* Custom styles for the calendar header */
        .fc-toolbar {
            background-color: #ecf0f1;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .fc-toolbar button {
            margin: 0 5px;
            padding: 8px 15px;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
            border: none;
        }

        .fc-toolbar button:hover {
            background-color: #2980b9;
        }

        /* Calendar view styles */
        .fc-daygrid-day {
            background-color: #f8f9fa;
            border-radius: 5px;
            margin: 2px;
            transition: background-color 0.2s;
        }

        .fc-daygrid-day:hover {
            background-color: #dfe6e9;
        }
    </style>

    <div class="container">
        <h1>Rental Management Calendar</h1>
        <div id="calendar"></div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('updateModal').style.display='none'">&times;</span>
            <h2>Update Rental</h2>
            <form id="updateForm" method="post" action="<?= base_url('rental/updateRental') ?>">
                <input type="hidden" name="rental_id" id="rental_id" value="">
                <label for="firstlocation">First Location:</label>
                <input type="text" name="firstlocation" id="firstlocation" required>
                <label for="secondlocation">Second Location:</label>
                <input type="text" name="secondlocation" id="secondlocation" required>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" required>
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" required>
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" required>
                <label for="start_time">Start Time:</label>
                <input type="time" name="start_time" id="start_time" required>
                <label for="end_time">End Time:</label>
                <input type="time" name="end_time" id="end_time" required>
                <div>
                    <button type="submit">Accept</button>
                    <button type="button" onclick="clearForm()">Decline</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                <?php foreach ($rentals as $rental): ?>
                {
                    id: '<?= $rental['RentalID']; ?>',
                    title: '<?= $rental['Name']; ?>',
                    start: '<?= $rental['StartDate'] . 'T' . $rental['StartTime']; ?>',
                    end: '<?= $rental['EndDate'] . 'T' . $rental['EndTime']; ?>',
                    backgroundColor: 
                        '<?php
                            if (!empty($rental['Status'])) {
                                echo $rental['Status'] === 'ongoing' ? 'green' : ($rental['Status'] === 'pending' ? 'red' : 'yellow');
                            } else {
                                echo 'gray'; // Default color if status is not defined
                            }
                        ?>',
                    extendedProps: {
                        firstLocation: '<?= $rental['FirstLocation']; ?>',
                        secondLocation: '<?= $rental['SecondLocation']; ?>',
                        phone: '<?= $rental['Phone']; ?>'
                    }
                },
                <?php endforeach; ?>
            ],
            eventRender: function(info) {
                info.el.style.backgroundColor = info.event.backgroundColor;
                info.el.style.color = '#blue'; // Set text color to white for better contrast
            },
            eventClick: function(info) {
                document.getElementById('rental_id').value = info.event.id;
                document.getElementById('firstlocation').value = info.event.extendedProps.firstLocation;
                document.getElementById('secondlocation').value = info.event.extendedProps.secondLocation;
                document.getElementById('name').value = info.event.title;
                document.getElementById('phone').value = info.event.extendedProps.phone;
                document.getElementById('start_date').value = info.event.start.toISOString().slice(0, 10);
                document.getElementById('end_date').value = info.event.end ? info.event.end.toISOString().slice(0, 10) : '';
                document.getElementById('start_time').value = info.event.start.toTimeString().slice(0, 5);
                document.getElementById('end_time').value = info.event.end ? info.event.end.toTimeString().slice(0, 5) : '';
                document.getElementById('updateModal').style.display = 'block';
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day'
            }
        });
        calendar.render();
    });

    function clearForm() {
        document.getElementById('updateForm').reset();
    }
    </script>

</body>
<?= $this->endsection() ?>
