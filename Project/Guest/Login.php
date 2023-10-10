<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');

if (isset($_POST['btnlogin'])) {
    $email = $_POST['txt_uname'];
    $password = $_POST['txt_password'];

    $selAdmin = "select * from tbl_admin where admin_email='$email' and admin_password='$password'";
    $resAdmin = $con->query($selAdmin);

    $selUser = "select * from tbl_user where user_email='$email' and user_password='$password'";
    $resUser = $con->query($selUser);
    if ($resAdmin->num_rows > 0) {
        $row = $resAdmin->fetch_assoc();
        $_SESSION['aid'] = $row['admin_id'];
        $_SESSION['aname'] = $row['admin_name'];
        header("location: ../Admin/Homepage.php");
    } else if ($resUser->num_rows > 0) {
        $row = $resUser->fetch_assoc();
        $_SESSION['uid'] = $row['user_id'];
        $_SESSION['uname'] = $row['user_name'];
        header("location: ../User/HomePage.php");
     }else {
        echo '<script>alert("Invalid Credentials");</script>';
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LaunHub::Guest::Login</title>
    <style>
        body {
            background-image: url("../Assets/Files/slider-bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
        }
        

        /* Custom CSS for the slide button */
        /* Custom CSS for the switch button */
.switch-button-container {
    display: flex;
    align-items: center;
    justify-content: center; /* Center the switch button horizontally */
}

.switch-button {
    width: 50px;
    height: 30px;
    background-color: #87CEEB;
    border-radius: 15px;
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
}

.switch-button .slider {
    width: 24px;
    height: 24px;
    background-color: #0073e6;
    border-radius: 50%;
    transition: 0.3s;
    position: absolute;
    left: 3px; /* Initial position of the slider when the button is off */
}

/* Add styles for the switch button when it's on */
.switch-button.active .slider {
    left: 23px; /* Position of the slider when the button is on */
}

        .bold-label {
        font-weight: bold;
        margin-right: 15px; /* Adjust the margin for "USER" label as needed */
        vertical-align: middle; /* Align the text vertically in the middle */
        }

        .bold-label:last-child {
        margin-right: 5px; /* Increase this margin to move the "BRANCH" label further away */
        vertical-align: middle; /* Align the text vertically in the middle */
        }



        /* Hide the branch login elements initially */
        .branch-login-elements {
            display: none;
        }

        /* Show the branch login elements when branch login is selected */
        .branch-login .branch-login-elements {
            display: block;
        }
    </style>
</head>
<body>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                <!-- Add the video element with the video source -->
                                 <div class="text-center">
                                     <h2 class="mt-1 mb-3 pb-1">Welcome User</h2>
                                     <!-- Add some space between the text and video -->
                                     <div class="mt-0">
                                         <video autoplay muted loop width="300" height="100">
                                             <source src="../Assets/Files/Logo/Laun.mp4" type="video/mp4">
                                             Your browser does not support the video tag.
                                         </video>
                                     </div>
                                     </div>
                                     <section class="h-100 gradient-form">
                                    <form method="POST" action="login.php">
                                    <div class="text-center">
                                    <h4 class="mt-1 mb-2">Login Type</h4>
                                    </div>
                                        <!-- Slide button container -->
                                        <!-- Switch button container -->
                                    <div class="form-group switch-button-container">
                                        <label class="bold-label" for="loginType">USER</label>
                                        <div class="switch-button" onclick="toggleLoginType()">
                                            <div class="slider"></div>
                                        </div>
                                        <label class="bold-label" for="loginType">BRANCH</label>
                                    </div>


                                        <!-- User login elements -->
                                        <div class="form-group">
                                            <div class="form-outline mb-4">
                                                <input type="email" id="form2Example11" class="form-control" name="txt_uname" placeholder="Enter your Email address" />
                                                <label class="form-label" for="form2Example11">Username</label>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" name="txt_password" />
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="btnlogin" type="submit">Log in</button>
                                            <a class="text-muted" href="#!">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <a href="NewUser.php" class="btn btn-outline-danger">Create new</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // JavaScript code to toggle login type and redirect to branch login
        // JavaScript code to toggle login type and redirect to branch login page
let isLogin = false;

function toggleLoginType() {
    const switchButton = document.querySelector('.switch-button');
    const branchLoginElements = document.querySelector('.branch-login-elements');

    isLogin = !isLogin;
    if (isLogin) {
        switchButton.classList.add('active');
        branchLoginElements.style.display = 'block';
    } else {
        switchButton.classList.remove('active');
        branchLoginElements.style.display = 'none';
    }
}

    </script>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>
