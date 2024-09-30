<section class="section featured-car" id="featured-car">
    <div class="container">
        <br>
        <div class="title-wrapper">
            <h2 class="h2 section-title">Featured cars</h2>
            <a href="/cars" class="featured-car-link">
                <span>View more</span>
                <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
        </div>
        <ul class="featured-car-list">
            <?php foreach ($cars as $car): ?>
            <li>
                <div class="featured-car-card">
                    <figure class="card-banner">
                        <img src="images/">
                    </figure>
                    <div class="card-content">
                        <div class="card-title-wrapper">
                            <h3 class="h3 card-title">
                                <a href="#"><?php echo isset($car['Model']) ? $car['Model'] : 'N/A'; ?></a>
                            </h3>
                            <data class="year" value="<?php echo isset($car['Year']) ? $car['Year'] : 'N/A'; ?>"><?php echo isset($car['Year']) ? $car['Year'] : 'N/A'; ?></data>
                        </div>
                        <ul class="card-list">
                            <li class="card-list-item">
                                <ion-icon name="people-outline"></ion-icon>
                                <span class="card-item-text"><?php echo isset($car['Color']) ? $car['Color'] : 'N/A'; ?> People</span>
                            </li>
                            <li class="card-list-item">
                                <ion-icon name="flash-outline"></ion-icon>
                                <span class="card-item-text"><?php echo isset($car['FuelType']) ? $car['FuelType'] : 'N/A'; ?></span>
                            </li>
                            <li class="card-list-item">
                                <ion-icon name="speedometer-outline"></ion-icon>
                                <span class="card-item-text"><?php echo isset($car['Mileage']) ? $car['Mileage'] : 'N/A'; ?></span>
                            </li>
                            <li class="card-list-item">
                                <ion-icon name="hardware-chip-outline"></ion-icon>
                                <span class="card-item-text"><?php echo isset($car['Transmission']) ? $car['Transmission'] : 'N/A'; ?></span>
                            </li>
                        </ul>
                        <div class="card-price-wrapper">
                            <p class="card-price">
                                <strong>$<?php echo isset($car['Status']) ? $car['Status'] : 'N/A'; ?></strong> / month
                            </p>
                            <button class="btn fav-btn" aria-label="Add to favourite list">
                                <ion-icon name="heart-outline"></ion-icon>
                            </button>
                            <button class="btn">Rent now</button>
                            <a href="/shop" class="featured-car-link">
                                <ion-icon name="storefront-outline" style="font-size: 30px;"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
