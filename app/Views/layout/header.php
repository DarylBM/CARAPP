<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earl Garahe Car Trading</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="css/home.css">

    <!-- Google Font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<header class="header" data-header>
    <div class="container">
        <div class="overlay" data-overlay></div>
        <a href="/home" class="logo">
            <img src="images/IMAHE.jpg" alt="Earl Garahe Car Trading Logo">
        </a>

        <nav class="navbar" data-navbar>
            <ul class="navbar-list">
                <li>
                    <a href="/home" class="navbar-link" data-nav-link>Home</a>
                </li>
                <li>
                    <a href="/rent" class="navbar-link" data-nav-link>Rent</a>
                </li>
                <li>
                    <a href="/carslist" class="navbar-link" data-nav-link>Shop</a>
                </li>
                <?php if (!session()->get('isLoggedIn')) : ?>
                    <li>
                        <a href="#getstart" class="navbar-link" data-nav-link>Get Started</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="header-actions">
            <div class="header-contact">
                <a href="tel:88002345678" class="contact-link">8 800 234 56 78</a>
                <span class="contact-time">Mon - Sat: 9:00 am - 8:00 pm</span>
            </div>

            <div class="icons" style="display: flex; align-items: center;">
                <a href="#" class="history-icon" aria-label="History" style="margin-right: 10px;">
                    <ion-icon name="time-outline" style="font-size: 24px; color: white;"></ion-icon>
                </a>
                <a href="#" class="notification-icon" aria-label="Notifications" style="margin-right: 10px;">
                    <ion-icon name="notifications-outline" style="font-size: 24px; color: white;"></ion-icon>
                </a>
                
                <!-- Logout icon -->
                <a href="#" class="logout-icon" aria-label="Logout" onclick="confirmLogout(event)" style="color: white;">
                    <i class="fas fa-sign-out-alt" style="font-size: 24px;"></i>
                </a>
            </div>
        </div>
    </div>
</header>

</body>
<script>
function confirmLogout(event) {
    // Prevent the default link action
    event.preventDefault();

    // Show confirmation dialog
    if (confirm("Are you sure you want to logout?")) {
        // If confirmed, redirect to logout URL
        window.location.href = "<?php echo site_url('/logout'); ?>";
    }
}
</script>
</html>
