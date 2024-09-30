<?= $this->include('layout/header') ?>

<style>
/* Container fade-in animation */
.container {
    animation: fadeIn 0.7s ease-in-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Center the form container */
.row.justify-content-md-center {
    display: flex;
    justify-content: left; /* Move the form to the left */
    margin-left: 0; /* Reset margin */
}

/* Styling the login box */
.col-5 {
    background-color: #ffffff;
    padding: 40px; /* Increased padding */
    border-radius: 15px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    margin-top: 80px;
    width: 100%;
    max-width: 500px; /* Increase form width */
    justify-content: flex-start;
}

/* Headings */
h2 {
    margin-bottom: 25px;
    font-weight: bold;
    color: #333;
}

/* Form inputs */
.form-group input {
    padding: 14px; /* Slightly larger input fields */
    border-radius: 8px;
    border: 1px solid #ddd;
    width: 100%;
    transition: border-color 0.3s;
}

.form-group input:focus {
    border-color: #764ba2;
    outline: none;
}

/* Form Group Spacing */
.form-group {
    margin-bottom: 25px; /* More spacing between form fields */
}

/* Button Styling */
.d-grid .btn {
    width: 100%;
    padding: 14px;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

/* Account Link */
.mt-3 a {
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
}

.mt-3 a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .col-5 {
        margin-top: 30px;
        padding: 20px;
        max-width: 100%; /* Full width for mobile */
    }
}

/* Styling for input group */
.input-group {
    position: relative;
}

.input-group .input-group-icon {
    position: absolute;
    right: 10px; /* Position the icon inside the textbox */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #767676; /* Icon color */
}
</style>

<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h2>Login</h2>

                <?php if(session()->getFlashdata('login_msg')):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('login_msg') ?>
                    </div>
                <?php endif;?>

                <form action="<?php echo base_url(); ?>/LoginController/loginAuth" method="post">
                    <div class="form-group mb-3">
                        <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                            <span class="input-group-icon" onclick="togglePassword()">
                                <ion-icon id="toggle-icon" name="eye-outline"></ion-icon>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Signin</button>
                    </div>
                </form>

                <!-- Create an account link -->
                <div class="mt-3">
                    <p>Don't have an account? <a href="<?php echo base_url('signup'); ?>">Create one</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-banner"></div>
</body>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('toggle-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.setAttribute('name', 'eye-off-outline'); // Change to eye-off icon
        } else {
            passwordInput.type = 'password';
            icon.setAttribute('name', 'eye-outline'); // Change back to eye icon
        }
    }
</script>
