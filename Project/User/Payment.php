<?php 
session_start();
include("../assets/connection/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMail/src/Exception.php';
require 'phpMail/src/PHPMailer.php';
require 'phpMail/src/SMTP.php';

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
		if(isset($_GET['action'])){
			$selqry="select max(packagebooking_id) as latest_id from tbl_packagebooking where user_id='".$_SESSION["uid"]."' ";
		$result=$con->query($selqry);
		$data=$result->fetch_assoc();
        $up ="update tbl_packagebooking set packagebooking_status='1' where packagebooking_id='".$data["latest_id"]."'";
        if($con->query($up))
        {
            $_SESSION['type']="";
?>
<script>
window.location="Success.html";
</script>
<?php        }
		
			}
            else{
                $updQry="update tbl_booking set booking_status=5 where booking_id=".$_GET['bid'];
                if($con->query($updQry))
                {
                    $seluser="select * from tbl_user where user_id=".$_SESSION['uid'];
                    $resUser=$con->query($seluser);
                    $dataUser=$resUser->fetch_assoc();
                    $selqry="select * from tbl_booking b inner join tbl_user u on u.user_id=b.user_id inner join tbl_branch br on br.branch_id=b.branch_id where booking_id=".$_GET['bid'];
$result=$con->query($selqry);
$data=$result->fetch_assoc();
$selCheck="select * from tbl_packagebooking pb inner join tbl_package p on p.package_id=pb.package_id where pb.packagebooking_status=1 and user_id=".$_SESSION['uid']." and curdate() between pb.packagebooking_date and DATE_ADD(STR_TO_DATE(pb.packagebooking_date, '%Y-%m-%d'), INTERVAL p.package_duration DAY) order by packagebooking_date desc";
$resCheck=$con->query($selCheck);
if($dataCheck=$resCheck->fetch_assoc())
{
    $discountPerc=$dataCheck['package_percentage'];
}
else{
    $discountPerc=0;
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

            $mail->addAddress($dataUser["user_email"]);

            $mail->isHTML(true);

            // Collect user's email and password
            $userName = $dataUser['user_name'];

            $mailc="";


            $selCloth="SELECT * from tbl_cloth c inner join tbl_subcategory s on s.subcategory_id=c.subcategory_id inner join tbl_category ct on ct.category_id=s.category_id inner join tbl_type t on t.type_id=c.type_id where c.booking_id=".$data["booking_id"];
            $resCloth=$con->query($selCloth);
            $sumTotal=0;
            $i=0;
            while($dataCloth=$resCloth->fetch_assoc()){
              $i++;
            $mailc=$mailc.'
            
            <tr>
              <td>'.$i.'</td>
              <td>'.$dataCloth["subcategory_name"]."/".$dataCloth["category_name"]."/".$dataCloth["type_name"].'</td>
              <td>'.$dataCloth["subcategory_price"].'</td>
              <td>'.$dataCloth["cloth_quantity"].'</td>
              <td>'.$dataCloth["subcategory_price"] * $dataCloth["cloth_quantity"].'</td>
            </tr>
            
            
            ';
            $sumTotal+=($dataCloth["subcategory_price"] * $dataCloth["cloth_quantity"]);
            }
          

            // Send the email with user's email and password
            $mail->Subject = "Welcome to LaunTech, $userName";
            $mail->Body = '<html>
            <head>
              <meta charset="utf-8" />
              <title>Tax Invoice</title>
              <link rel="shortcut icon" type="image/png" href="./favicon.png" />
              <style>
                * {
                  box-sizing: border-box;
                }
          
                .table-bordered td,
                .table-bordered th {
                  border: 1px solid #ddd;
                  padding: 10px;
                  word-break: break-all;
                }
          
                body {
                  font-family: Arial, Helvetica, sans-serif;
                  margin: 0;
                  padding: 0;
                  font-size: 16px;
                }
                .h4-14 h4 {
                  font-size: 12px;
                  margin-top: 0;
                  margin-bottom: 5px;
                }
                .img {
                  margin-left: "auto";
                  margin-top: "auto";
                  height: 30px;
                }
                pre,
                p {
                  /* width: 99%; */
                  /* overflow: auto; */
                  /* bpicklist: 1px solid #aaa; */
                  padding: 0;
                  margin: 0;
                }
                table {
                  font-family: arial, sans-serif;
                  width: 100%;
                  border-collapse: collapse;
                  padding: 1px;
                }
                .hm-p p {
                  text-align: left;
                  padding: 1px;
                  padding: 5px 4px;
                }
                td,
                th {
                  text-align: left;
                  padding: 8px 6px;
                }
                .table-b td,
                .table-b th {
                  border: 1px solid #ddd;
                }
                th {
                  /* background-color: #ddd; */
                }
                .hm-p td,
                .hm-p th {
                  padding: 3px 0px;
                }
                .cropped {
                  float: right;
                  margin-bottom: 20px;
                  height: 100px; /* height of container */
                  overflow: hidden;
                }
                .cropped img {
                  width: 400px;
                  margin: 8px 0px 0px 80px;
                }
                .main-pd-wrapper {
                  box-shadow: 0 0 10px #ddd;
                  background-color: #fff;
                  border-radius: 10px;
                  padding: 15px;
                }
                .table-bordered td,
                .table-bordered th {
                  border: 1px solid #ddd;
                  padding: 10px;
                  font-size: 14px;
                }
              </style>
            </head>
            <body>
           <br />
              <section class="main-pd-wrapper" style="width: 1000px; margin: auto" id="content">
                <div style="display: table-header-group">
                  <h4 style="text-align: center; margin: 0">
                    <b>Tax Invoice</b>
                  </h4>
          
                  <table style="width: 100%; table-layout: fixed">
                    <tr>
                      <td
                        style="border-left: 1px solid #ddd; border-right: 1px solid #ddd"
                      >
                        <div
                          style="
                            text-align: center;
                            margin: auto;
                            line-height: 1.5;
                            font-size: 14px;
                            color: #4a4a4a;
                          "
                        >
                            <span
                          style="color:#F93;font-size:56px">LaunTech</span>
          
                          <p style="font-weight: bold; margin-top: 15px">
                            GST TIN : 06AAFCD6498P1ZT
                          </p>
                          <p style="font-weight: bold">
                            Toll Free No. :
                            <a href="tel:018001236477" style="color: #00bb07"
                              >1800-123-6477</a
                            >
                          </p>
                        </div>
                      </td>
                      <td
                        align="right"
                        style="
                          text-align: right;
                          padding-left: 50px;
                          line-height: 1.5;
                          color: #323232;
                        "
                      >
                        <div>
                          <h4 style="margin-top: 5px; margin-bottom: 5px">
                            Bill to/ Ship to
                          </h4>
                          <p style="font-size: 14px">
                            '.$data["user_name"].'<br>
                            '.$data["user_address"].'
                            <br />
                            Tel:'.$data["user_contact"].'
                          </p>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                <table
                  class="table table-bordered h4-14"
                  style="width: 100%; -fs-table-paginate: paginate; margin-top: 15px"
                >
                  <thead style="display: table-header-group">
                    <tr
                      style="
                        margin: 0;
                        background: #fcbd021f;
                        padding: 15px;
                        padding-left: 20px;
                        -webkit-print-color-adjust: exact;
                      "
                    >
                      <td colspan="3">
                        <p>Booking Date:- '.$data["booking_date"].'</p>
                        <p style="margin: 5px 0">Invoice Generated:- '.date("Y-m-d").'</p>
                      </td>
                      <td colspan="3" style="width: 300px">
                        <h4 style="margin: 0">Sold By:</h4>
                        <p>
                          '.$data["branch_name"].'
                        </p>
                      </td>
                    </tr>
          
                    <tr>
                      <th style="width: 50px">Sl.No</th>
                      <th style="width: 150px">Cloth</th>
                      <th style="width: 150px">Price</th>
                      <th style="width: 80px">Qty</th>
                      <th style="width: 120px"><h4>TOTAL Value</h4></th>
                    </tr>
                  </thead>
                  <tbody>
'.$mailc.'
                  </tbody>
                  <tfoot></tfoot>
                </table>
          
                
                <table class="hm-p table-bordered" style="width: 100%; margin-top: 30px">
                  
                  <tr style="background: #fcbd02">
                    <th>Sub Total</th>
                    <td style="width: 70px; text-align: right; border-right: none">
                      <b>'.$sumTotal.'</b>
                    </td>
                    <td colspan="5" style="border-left: none"></td>
                  </tr>
                  <tr style="background: #fcbd02">
                    <th>Discount</th>
                    <td style="width: 70px; text-align: right; border-right: none">
                      <b>'.$discountPerc.'</b>
                    </td>
                    <td colspan="5" style="border-left: none"></td>
                  </tr>
                  <tr style="background: #fcbd02">
                    <th>Total</th>
                    <td style="width: 70px; text-align: right; border-right: none">
                      <b>'.$sumTotal-$discountPerc.'</b>
                    </td>
                    <td colspan="5" style="border-left: none"></td>
                  </tr>
                </table>
              </section>
          </body>
          </html>';

            if ($mail->send()) {
                // Email sent successfully
                echo 'Email sent successfully';
            } else {
                // Email could not be sent
                echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
            }
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
