<?= $this->include('layout/header') ?>
<title>Register</title>

<script>
    function validateForm() {
        var name = document.forms["signupForm"]["name"].value;
        var email = document.forms["signupForm"]["email"].value;
        var password = document.forms["signupForm"]["password"].value;
        var confirmPassword = document.forms["signupForm"]["confirmpassword"].value;
        var phone = document.forms["signupForm"]["phone"].value;
        var termsAndPolicy = document.forms["signupForm"]["termsAndPolicy"].checked;

        if (name == "" || email == "" || password == "" || confirmPassword == "" || phone == "") {
            alert("All fields must be filled out");
            return false;
        }
        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false;
        }
        if (!termsAndPolicy) {
            alert("You must agree to the terms and policy");
            return false;
        }
    }

    function enableNextInput(currentInput, nextInput) {
        if (currentInput.value.trim() !== "") {
            nextInput.removeAttribute('disabled');
        } else {
            nextInput.setAttribute('disabled', 'disabled');
        }
    }

    function enableConfirmPassword(currentInput, nextInput) {
        var password = document.forms["signupForm"]["password"].value;
        if (password.trim() !== "") {
            nextInput.removeAttribute('disabled');
        } else {
            nextInput.setAttribute('disabled', 'disabled');
        }
    }

    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const togglePasswordIcon = document.getElementById(iconId);
        const isPasswordVisible = passwordInput.type === "text";

        // Toggle password visibility
        passwordInput.type = isPasswordVisible ? "password" : "text";

        // Change the icon based on visibility
        togglePasswordIcon.innerHTML = isPasswordVisible 
            ? '<ion-icon name="eye-off-outline"></ion-icon>' 
            : '<ion-icon name="eye-outline"></ion-icon>';
    }
</script>

<style>
.container {
    animation: fadeIn 0.5s ease-in-out forwards;
    display: flex;
    justify-content: left;
    padding: 20px;
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

.col-5 {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 70px;
    max-width: 800px;
    width: 100%;
}

h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.d-grid .btn {
    width: 100%;
}

.form-control {
    border: 2px solid #ced4da;
    border-radius: 5px;
    padding: 15px;
    width: 100%;
}

.form-control:hover {
    border-color: #707070;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-row .form-group {
    width: 100%;
}

.form-row .form-group:first-child {
    grid-column: span 2;
}

.checkbox-row {
    display: flex;
    align-items: center;
    margin-left: 20px;
}

.checkbox-row input[type="checkbox"] {
    margin-right: 50px; /* Adds space between checkbox and label */
}

.back-to-login {
    display: flex;
    justify-content: flex-start; /* Align text and link side by side */
}

.back-to-login a {
    margin-left: 5px; /* Adds space between "Have an account?" and the link */
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.success-message {
    animation: fadeIn 0.5s ease-in-out forwards, slideUp 0.5s ease-in-out forwards;
    display: none; /* Initially hidden */
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
}

.error-message {
    animation: fadeIn 0.5s ease-in-out forwards;
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
    }
    to {
        transform: translateY(0);
    }
}

/* Password icon styling */
.password-icon {
    position: absolute;
    right: 15px; /* Adjust as needed */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 20px; /* Adjust size as needed */
    z-index: 10; /* Ensure icon appears above other elements */
}
</style>

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h2>Register User</h2>

                <!-- Success message -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="success-message" style="display: block;">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Error message -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="error-message" style="display: block;">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Validation Errors -->
                <?php if (session()->getFlashdata('validation')): ?>
                    <div class="error-message" style="display: block;">
                        <ul>
                        <?php foreach (session()->getFlashdata('validation') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/SignupController/store'); ?>" method="post" name="signupForm" onsubmit="return validateForm()">
                    <div class="form-row">
                        <div class="form-group mb-3">
                            <input type="text" name="name" placeholder="Name" value="<?= set_value('name') ?>" class="form-control" required onkeyup="enableNextInput(this, document.forms['signupForm']['email'])">
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" required disabled>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="phone" placeholder="Phone Number" value="<?= set_value('phone') ?>" class="form-control" pattern="[0-9]+" title="Only numeric values are allowed" required>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                            <span id="togglePassword" class="password-icon" onclick="togglePassword('password', 'togglePassword')">
                                <ion-icon name="eye-off-outline"></ion-icon>
                            </span>
                        </div>
                        <div class="form-group mb-3" style="position: relative;">
                            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" class="form-control" required onkeyup="enableConfirmPassword(this, document.forms['signupForm']['confirmpassword'])">
                            <span id="toggleConfirmPassword" class="password-icon" onclick="togglePassword('confirmpassword', 'toggleConfirmPassword')">
                                <ion-icon name="eye-off-outline"></ion-icon>
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="address" placeholder="Address" value="<?= set_value('address') ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <input type="checkbox" id="termsAndPolicy" name="termsAndPolicy" required>
                        <label for="termsAndPolicy"><a href="/terms-and-policy">I agree to the Terms and Policy</a></label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Signup</button>
                    </div>
                </form>
                <div class="back-to-login mt-3">
                    Have an account? <a href="/signin"> Sign In</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-banner"></div>
</body>

<script src="<?= base_url('js/script.js') ?>"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
