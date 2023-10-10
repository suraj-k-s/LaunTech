<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include('Head.php');

require 'WhatsappAPI.php'; // Include the WhatsApp API class
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMail/src/Exception.php';
require 'phpMail/src/PHPMailer.php';
require 'phpMail/src/SMTP.php';

// Initialize variables to store the uploaded image filename and registration success flag
$uploadedImage = '';
$registrationSuccess = false;

// Function to validate email address format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate mobile number (10 digits)
function validateMobile($mobile) {
    return preg_match('/^[0-9]{10}$/', $mobile);
}

if (isset($_POST['btn_submit'])) {
    $name = $_POST['txt_name'];
    $gender = $_POST['radio_gen'];
    
    // Validate and format the mobile number with '+91'
    $contact = '+91' . preg_replace('/[^0-9]/', '', $_POST['txt_contact']);
    
    $email = $_POST['txt_email'];
    $place = $_POST['sl_place'];
    $address = $_POST['txt_address'];
    $password = $_POST['txt_password'];

    // Validate email
    if (!validateEmail($email)) {
        echo "<script>alert('Invalid email address');</script>";
    } else {
        // Check if an image was uploaded
        if (isset($_FILES['file_image']) && $_FILES['file_image']['error'] === 0) {
            $image = $_FILES['file_image']['name'];
            $path = $_FILES['file_image']['tmp_name'];
            move_uploaded_file($path, "../Assets/Files/User/".$image);
            $uploadedImage = $image;
        }

        $insqry = "INSERT INTO tbl_user (user_name, user_gender, user_contact, user_email, place_id, user_address, user_password, user_photo) 
                   VALUES ('$name', '$gender', '$contact', '$email', '$place', '$address', '$password', '$uploadedImage')";

        if ($con->query($insqry)) {
            $registrationSuccess = true;

            // Send WhatsApp message after successful registration
            $wp = new WhatsappAPI("", "6eab76fe524510d4371c0c26e22b5223f1b71e63"); // Replace with your user id and API key
            
            // Use the formatted mobile number with country code +91
            $userNumber = $contact; // Use the user's registered WhatsApp number from the form

            $whatsappMessage = "Welcome to LaunTech, your modern laundry solution.We've successfully completed your registration, and we're thrilled to have you on board. Our cutting-edge platform allows you to schedule pickups and deliveries with ease, track the status of your laundry in real-time, and enjoy a seamless, contactless experience.Welcome to the future of laundry!#LaundryMadeEasy";

            $whatsappStatus = $wp->sendText($userNumber, $whatsappMessage);
            $whatsappStatus = json_decode($whatsappStatus);

            if ($whatsappStatus->status == 'error') {
                echo 'WhatsApp API Error: ' . $whatsappStatus->response;
            } elseif ($whatsappStatus->status == 'success') {
                echo 'WhatsApp message sent successfully.';
            } else {
                echo 'WhatsApp API Response: ';
                print_r($whatsappStatus);
            }

            // Send email after successful registration
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'launtech2023@gmail.com'; // Your Gmail
            $mail->Password = 'fnotbyphlsbvtnwo'; // Your Gmail app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('launtech2023@gmail.com'); // Your Gmail

            $mail->addAddress($_POST["txt_email"]);

            $mail->isHTML(true);

            // Collect user's email and password
            $userName = $_POST['txt_name'];
            $userEmail = $_POST['txt_email'];
            $userPassword = $_POST['txt_password'];

            // Send the email with user's email and password
            $mail->Subject = "Welcome to LaunTech, $userName";
            $mail->Body = '<html>
            <head>
                <style>
                    /* Style for the first <p> tag */
                    .first-paragraph {
                        font-size: 18px; /* Adjust the font size for the first paragraph */
                    }
            
                    /* Style for the other two <p> tags */
                    .other-paragraphs {
                        font-size: 16px; /* Adjust the font size for the other paragraphs */
                    }
            
                    /* Change text color for the second <p> tag */
                    .black-text {
                        color: black;
                    }
                </style>
            </head>
            <body>
                <p class="first-paragraph">Your registration on the Launtech Laundry Management System has been successfully completed.</p>
                <p class="other-paragraphs black-text"><strong>User ID:</strong> ' . $userEmail . '</p>
                <p class="other-paragraphs"><strong>User Password:</strong> ' . $userPassword . '</p>
            </body>
            </html>';

            if ($mail->send()) {
                // Email sent successfully
                echo 'Email sent successfully';
            } else {
                // Email could not be sent
                echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            }
        } else {
            echo "Insert Failed";
        }
    }
}
?>
<!-- Rest of your HTML and JavaScript code remains the same -->
<!-- Rest of your HTML and JavaScript code remains the same -->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LuanTech::Guest::NewUser</title>
    <!-- Add custom CSS for image preview and centering -->
    <style>

    body {
    background-image: url('../Assets/Files/slider-bg.jpg'); /* Replace 'path-to-your-image' with the actual path to your image file */
    background-size: cover; /* This property ensures the image covers the entire background */
    background-repeat: no-repeat; /* Prevent the image from repeating */
  }
        .image-preview-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-preview {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    border: 2px solid #ccc;
    position: relative; /* Add position relative */
}

.image-preview-button {
    cursor: pointer;
    display: block;
    text-align: center;
    font-size: 32px;
    color: #007bff;
    position: absolute; /* Add position absolute */
    top: 50%; /* Center vertically */
    left: 50%; /* Center horizontally */
    transform: translate(-50%, -50%); /* Center the button */
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header text-center">New User Registration</div>
                        <div class="card-body">
                            <!-- Image preview container -->
                            <div class="text-center mb-3 image-preview-container">
                            <div class="image-preview" id="image-preview">
                             <label for="file_image" class="image-preview-button" id="image-preview-button">+</label>
                            </div>
                            <input type="file" style="display: none;" class="form-control-file" id="file_image" name="file_image" accept="image/*" onchange="previewImage(this)">
                            </div>

                            <!-- End of Image preview container -->

                            <!-- Name field -->
                            <div class="form-group">
                                <label for="txt_name">Name</label>
                                <input type="text" class="form-control" id="txt_name" name="txt_name" required>
                            </div>

                            <!-- Gender field -->
                            <div class="form-group">
                                <label>Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_gen" id="male" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio_gen" id="female" value="Female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>

                            <!-- Contact field -->
                            <div class="form-group">
                                <label for="txt_contact">Contact</label>
                                <input type="text" class="form-control" id="txt_contact" name="txt_contact" required pattern="[0-9]{10}">
                            </div>

                            <!-- Email field -->
                            <div class="form-group">
                                <label for="txt_email">Email</label>
                                <input type="email" class="form-control" id="txt_email" name="txt_email" required>
                            </div>

                            <!-- District and Place fields (you can add options dynamically) -->
                            <div class="form-group">
                                <label for="sl_district">District</label>
                                <select class="form-control" name="sl_district" id="sl_district" onChange="getplace(this.value)" required>
                                    <option value="">--Select--</option>
                                    <?php
                                        $selQry = "SELECT * FROM tbl_district";
                                        $result = $con->query($selQry);
                                        while($row = $result->fetch_assoc())
                                        {
                                    ?>
                                    <option value="<?php echo $row['district_id']; ?>"><?php echo $row['district_name']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sl_place">Place</label>
                                <select class="form-control" name="sl_place" id="sl_place" required>
                                    <option value="">--Select--</option>
                                    <!-- Add your place options here -->
                                </select>
                            </div>

                            <!-- Address field -->
                            <div class="form-group">
                                <label for="txt_address">Address</label>
                                <textarea class="form-control" id="txt_address" name="txt_address" rows="5" required></textarea>
                            </div>

                            <!-- Password field -->
                            <div class="form-group">
                            <label for="txt_password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="txt_password" name="txt_password" title="You must enter 6 or more characters" required pattern="[a-zA-Z0-9.@#$%^&*]{6,30}">
                                <div class="input-group-append">
                                    <button type="button" id="viewPasswordBtn" class="btn btn-outline-secondary">
                                        <img src="../Assets/Files/Guest/eye.png" alt="View Password" style="width: 20px; height: 20px;">
                                    </button>
                                </div>
                            </div>
                            </div>
                            <!-- Confirm Password field -->
                            <div class="form-group">
                                <label for="txt_confirmpassword">Confirm password</label>
                                <input type="password" class="form-control" id="txt_confirmpassword" name="txt_confirmpassword" title="You must enter 6 or more characters" required pattern="[a-zA-Z0-9.@#$%^&*]{6,30}">
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                            <button type="reset" class="btn btn-secondary" name="btn_cancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for image preview and registration success alert -->
    <script>
        function previewImage(input) {
            var preview = document.getElementById('image-preview');
            var button = document.getElementById('image-preview-button');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.style.backgroundImage = "url('" + reader.result + "')";

                // Hide the "+" button after previewing the image
                button.style.display = 'none';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.style.backgroundImage = null;
                button.style.display = 'block'; // Show the "+" button
            }
        }

        // View Password button functionality
        var viewPasswordBtn = document.getElementById('viewPasswordBtn');
        var txtPassword = document.getElementById('txt_password');
        viewPasswordBtn.addEventListener('click', function () {
            if (txtPassword.type === 'password') {
                txtPassword.type = 'text';
            } else {
                txtPassword.type = 'password';
            }
        });

        <?php
        if ($registrationSuccess) {
            echo "alert('Successfully Registered to LaunTech');";
            echo "window.location = 'Login.php';</script>";
        }
        ?>
    </script>

    <script src="../Assets/JQuery/jQuery.js"></script>
    <script>
        function getplace(pid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?pid=" + pid,
                success: function (a) {
                    $("#sl_place").html(a);
                }
            });
        }
    </script>
    <?php
    include('Foot.php');
    ob_flush();
    ?>
</body>
</html>
