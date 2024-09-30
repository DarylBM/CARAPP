<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Shop</title>
    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="css/home.css">
    <!-- FontAwesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        h3 {
            margin: 0;
            color: #343a40;
        }
        /* Navbar Styles */
        nav {
            background-color: #343a40;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .nav-link li {
            display: inline-block;
            margin: 0 15px;
        }
        .nav-link a {
            color: white;
            font-size: 1rem;
            padding: 8px 16px;
            border-radius: 20px;
            transition: background-color 0.3s;
        }
        .nav-link a:hover {
            background-color: #495057;
        }
        /* Hero Section */
        .hero-section {
            background: url('https://via.placeholder.com/1920x500') no-repeat center center/cover;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3rem;
        }
        /* Card Container */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 100px auto 50px;
            padding: 0 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-img img {
            width: 100%;
            height: auto;
        }
        .card-details {
            padding: 20px;
        }
        .car-title {
            font-size: 1.5rem;
            color: #343a40;
        }
        .car-price {
            margin: 10px 0;
            font-size: 1.2rem;
            color: #007bff;
        }
        .car-tags {
            margin-bottom: 10px;
            color: #868e96;
        }
        .rating {
            color: #FFD700;
        }
        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        footer .social-link a {
            margin: 0 10px;
            color: white;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        footer .social-link a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Start Navbar -->
    <nav>
        <div class="container nav-container">
            <a href="" class="logo"><h3>E-Shop</h3></a>
            <ul class="nav-link">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#shop">Shop</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div>
            <h1>Welcome to Our E-Shop</h1>
            <p>Find the best products just for you!</p>
        </div>
    </section>

    <!-- Card Section -->
    <div class="card-container">
        <!-- Product Card -->
        <div class="card">
            <div class="card-img">
                <img src="car-image.jpg" alt="Product Image">
            </div>
            <div class="card-details">
                <h3 class="car-title">Product Name</h3>
                <p class="car-price">$XX,XXX</p>
                <p class="car-tags">Tag1, Tag2, Tag3</p>
                <div class="rating">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
            </div>
        </div>
        <!-- Add more product cards similarly -->
    </div>

    <!-- Footer -->
    <footer>
        <p>Follow Us</p>
        <div class="social-link">
            <a href=""><i class="fab fa-facebook"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 E-Shop. All Rights Reserved.</p>
    </footer>
</body>
</html>
