<!-- 
  - #HERO
-->
<article>
    <!-- #HERO -->
    <section class="section hero" id="home">
        <div class="container">
            <!-- Greeting message -->
            <?php if(session()->get('isLoggedIn') && session()->get('isAdmin') !== true): ?>
                <div class="hero-content">
                    <h2 class="h1 hero-title">Hello, <?php echo session()->get('name'); ?></h2>
                    <p class="hero-text">The easy way to takeover a lease</p>
                </div>
            <?php else: ?>
                <div class="hero-content">
                    <h2 class="h1 hero-title">BROO BROOM!!</h2>

                </div>
            <?php endif; ?>
            <div class="hero-banner"></div>

            <form action="" class="hero-form">
                <div class="input-wrapper">
                    <label for="input-1" class="input-label">Car, model, or brand</label>
                    <input type="text" name="car-model" id="input-1" class="input-field" placeholder="What car are you looking?">
                </div>

                <div class="input-wrapper">
                    <label for="input-2" class="input-label">Max. monthly payment</label>
                    <input type="text" name="monthly-pay" id="input-2" class="input-field" placeholder="Add an amount in $">
                </div>

                <div class="input-wrapper">
                    <label for="input-3" class="input-label">Make Year</label>
                    <input type="text" name="year" id="input-3" class="input-field" placeholder="Add a minimal make year">
                </div>
                <a href="/cars" class="btn" aria-labelledby="aria-label-txt">
          <span id="aria-label-txt">Explore cars</span>

</a>

            </form>
        </div>
    </section>
</article>
