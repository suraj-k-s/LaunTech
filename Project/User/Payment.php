<?php 
session_start();
include("../assets/connection/connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <title>Payment Gateway</title>
        <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan|Ubuntu');
            
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Ubuntu', sans-serif;
            }

            body {
            background: url("../Assets/Files/slider-bg.jpg") no-repeat center center fixed;
            background-size: cover;
            margin: 0 10px;
            }

            .payment{
                background: #f8f8f8;
                max-width: 360px;
                margin: 80px auto;
                height: auto;
                padding: 35px;
                padding-top: 70px;
                border-radius: 5px;
                position: relative;
            }

            .payment h2{
                text-align: center;
                letter-spacing: 2px;
                margin-bottom: 40px;
                color: #0d3c61;
            }

            .form .label{
                display: block;
                color: #555555;
                margin-bottom: 6px;
            }

            .input{
                padding: 13px 0px 13px 25px;
                width: 100%;
                text-align: center;
                border: 2px solid #dddddd;
                border-radius: 5px;
                letter-spacing: 1px;
                word-spacing: 3px;
                outline: none;
                font-size: 16px;
                color: #555555;
            }

            .card-grp{
                display: flex;
                justify-content: space-between;
            }

            .card-item{
                width: 48%;
            }

            .space{
                margin-bottom: 20px;
            }

            .icon-relative{
                position: relative;
            }

            .icon-relative .fas,
            .icon-relative .far{
                position: absolute;
                bottom: 12px;
                left: 15px;
                font-size: 20px;
                color: #555555;
            }

            .btn{
                margin-top: 40px;
            }

            .payment-logo {
             position: absolute;
             top: -50px;
             left: 50%;
             transform: translateX(-50%);
             width: 100px;
             height: 100px;
             background: #f8f8f8;
             border-radius: 50%;
             box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
             text-align: center;
             line-height: 85px;
             z-index: 1;
            }
            
            .payment-logo img {
             max-width: 80%;
             max-height: 80%;
             position: absolute;
             top: 50%;
             left: 50%;
             transform: translate(-50%, -50%);
            }

            input[type=submit] {
                border: none;
                font-size: 16px;
				width: 100%;
                background: #2196F3;
                padding: 12px;
                text-align: center;
                color: #f8f8f8;
                border-radius: 5px;
                cursor: pointer;
            }

            @media screen and (max-width: 420px){
                .card-grp{
                    flex-direction: column;
                }
                .card-item{
                    width: 100%;
                    margin-bottom: 20px;
                }
                .btn{
                    margin-top: 20px;
                }
            }
        </style>
</head>
<?php
    if(isset($_POST["btnpay"]))
    {
		if(isset($_SESSION['type'])=='pkgsub'){
			$selqry="select max(packagebooking_id) as latest_id from tbl_packagebooking where user_id='".$_SESSION["uid"]."' ";
		$result=$con->query($selqry);
		$data=$result->fetch_assoc();
        $up ="update tbl_packagebooking set packagebooking_status='1' where packagebooking_id='".$data["latest_id"]."'";
        if($con->query($up))
        {
?>
<script>
window.location="Success.html";
</script>
<?php        }
		
			}
		
    }
	?>
    <body>
        <!-- partial:index.partial.html -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">

        <div class="wrapper">
            <div class="payment">
            <div class="payment-logo">
             <img src="../Assets/Files/Logo/LaunTech-removebg-preview.png" alt="Payment Logo" width="100">
            </div>

                <h2>Payment Gateway</h2>
                <div class="form">
                    <form method="post">
                        <div class="card space icon-relative">
                            <label class="label">Card holder:</label>
                            <input type="text" class="input" placeholder="Card Holder">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card space icon-relative">
                            <label class="label">Card number:</label>
                            <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number">
                            <i class="far fa-credit-card"></i>
                        </div>
                        <div class="card-grp space">
                            <div class="card-item icon-relative">
                                <label class="label">Expiry date:</label>
                                <input type="text" name="expiry-data" class="input" data-mask="00 / 00" placeholder="00 / 00">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="card-item icon-relative">
                                <label class="label">CVV:</label>
                                <input type="text" class="input" data-mask="000" placeholder="000">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <div class="btn">
                            <input type="submit" name="btnpay" id="btnpay" value="Pay">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>
