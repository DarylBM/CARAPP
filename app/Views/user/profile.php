<!-- profile.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
            border: 4px solid #007bff;
        }
        p {
            color: #666;
            margin-bottom: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="profile_picture.jpg" alt="Profile Picture" class="profile-img">
        <h1>Welcome to your profile, <span id="username"><?= htmlspecialchars($user['name']) ?></span></h1>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <a href="#" id="changeName">Change Name</a>
        <a href="/logout" class="logout-btn">Logout</a>
    </div>

    <script>
        document.getElementById("changeName").addEventListener("click", function() {
            var newName = prompt("Enter your new name:");
            if (newName !== null && newName !== "") {
                document.getElementById("username").innerText = newName;
            }
        });
    </script>
</body>
</html>
