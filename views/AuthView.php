<?php
class AuthView
{
    public function displayRegisterPage()
    {
        ?>
        <div class="relative d-flex justify-content-center align-items-center h-100 bg-primary">
            <div class="background-overlay"></div>

            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header text-center p-4">
                                <a href="/cars-comparer-2cs-project">
                                    <img src="/cars-comparer-2cs-project/assets/images/logo.svg" alt="logo" class="img-fluid"
                                        style="max-height: 30px;">
                                </a>
                            </div>
                            <div class="card-body text-center border-bottom">
                                <h3><strong>Register</strong></h3>
                            </div>
                            <div id="message">
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" id="firstName"
                                                placeholder="Enter your first name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" id="lastName"
                                                placeholder="Enter your last name" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                                required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Enter your password" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="birthDate">Birthdate</label>
                                            <input type="date" class="form-control" id="birthDate" required>
                                        </div>
                                    </div>
                                    <button onclick="register()" class="btn btn-primary btn-block">register</button>
                                    <p class="mt-3">Already have an account? <a
                                            href="/cars-comparer-2cs-project/auth/login">Login here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public function displayLoginPage()
    {
        ?>
        <div class="relative d-flex justify-content-center align-items-center h-100 bg-primary">
            <div class="background-overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header text-center p-4">
                                <a href="/cars-comparer-2cs-project">
                                    <img src="/cars-comparer-2cs-project/assets/images/logo.svg" alt="logo" class="img-fluid"
                                        style="max-height: 30px;">
                                </a>
                            </div>
                            <div class="card-body text-center border-bottom">
                                <h3><strong>Login</strong></h3>
                            </div>
                            <div id="message">
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Enter your password" required>
                                    </div>
                                    <button onclick="login()" class="btn btn-primary btn-block">Login</button>
                                    <p class="mt-3">Don't have an account? <a
                                            href="/cars-comparer-2cs-project/auth/register">Register here</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>