<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="../include/style.css">
    <link rel="stylesheet" href="register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="register.js"></script>
</head>

<body>
    
    <div class="row h-100 d-flex align-items-center mx-0">

        <div class="col-md-5 ">

            <div class="form-container  glass-effect text-center p-5">
                <div class="display-4 mb-1">
                    <div>AEVG BUILDERS</div>
                    <h4> REGISTER</h4>
                </div>
                <form id="registerForm">
                    <div class="d-flex justify-content-evenly">
                        <input type="text" class="form-control mt-5" name="firstName" placeholder="First Name" required>
                        <input type="text" class="form-control mt-5" name="middleName" placeholder="Middle Name (optional)">
                        <input type="text" class="form-control mt-5" name="lastName" placeholder="Last Name" required>
                    </div>

                    <div class="d-flex justify-content-evenly">
                        <input type="email" class="form-control mt-2" name="email" placeholder="Email" required>
                        <input type="text" class="form-control mt-2" name="contact" placeholder="Contact Number" required>
                    </div>
                    <div class="d-flex justify-content-evenly">
                        <input type="text" class="form-control mt-2" name="houseNo" placeholder="House No. (optional)">
                        <input type="text" class="form-control mt-2" name="street" placeholder="Street (optional)">
                        <input type="text" class="form-control mt-2" name="barangay" placeholder="Barangay" required>
                    </div>
                    <div class="d-flex justify-content-evenly">
                        <input type="text" class="form-control mt-2" name="municipality" placeholder="Municipality" required>
                        <input type="text" class="form-control mt-2" name="province" placeholder="Province" required>
                    </div>
                    <input type="password" class="form-control mt-2" name="password" placeholder="Password" required>
                    <input type="password" class="form-control mt-2" name="confirmPassword" placeholder="Confirm Password" required>

                    <div class="alert alert-danger mt-3" role="alert" id="alertError">
                    </div>
                    <div class="alert alert-success mt-3" role="alert" id="alertSuccess">
                    </div>
                    <button type="submit" class="btn btn-primary form-control mt-3">Sign Up</button>
                    <div class="d-flex justify-content-evenly mt-4">
                        <a href="../login/login.php">Already Have an Account?</a>
                    </div>
                </form>

            </div>


        </div>
</body>

</html>