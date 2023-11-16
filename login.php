<?php 
include("header.php"); ?>

<section class="section-login">
    <div class="form-box-login">
        <div class="form-value">
            <form action="login_process.php" method="post" enctype="multipart/form-data" id="login-form">
                <h2>Login</h2>

                <!-- IC/ID input -->
                <div class="inputbox">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input type="text" name="IC_ID" id="IC_ID" required title="Enter a valid IC or ID" />
                    <label for="IC_ID">IC or ID</label>
                </div>

                <!-- Password input -->
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" id="password" required />
                    <label for="password">Password</label>
                </div>

                <!-- Role Selection Part -->
                <div class="role-selection">
                    <p>Who are you?:</p>
                    <div class="role-options">
                        <label>
                            <input type="radio" name="role" value="patient" checked />
                            <span class="checkmark"></span>
                            Patient
                        </label>

                        <label>
                            <input type="radio" name="role" value="admin" />
                            <span class="checkmark"></span>
                            Admin
                        </label>
                    </div>
                </div>

                <div class="forget">
                    <label>
                        <input type="checkbox" name="remember" id="remember" /> Remember me
                    </label>
                </div>

                <button type="submit">Log in</button>

                <div class="register">
                    <p>Don't have an account? <a href="signup-1.php">Register</a></p>
                </div>
            </form>
            <br>
            <a href="index.php"><button>Back to Home Page</button></a>
        </div>
    </div>
</section>

<script>
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', (e) => {
        if (!validateForm()) {
            e.preventDefault();
        }
    });

    function validateForm() {
        const ICID = document.getElementById('IC_ID').value;
        const password = document.getElementById('password').value;

        // Add your custom validation logic here, e.g., checking password length, complexity, etc.
        // You can also use regular expressions or other methods to validate the inputs.

        // Example validation: Password should be at least 8 characters long.
        // if (password.length < 8) {
        //     alert('Password must be at least 8 characters long');
        //     return false;
        // }

        return true;
    }
</script>