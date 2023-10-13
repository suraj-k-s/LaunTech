<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_GET['bid'])){
    $updQry="update tbl_booking set booking_status=".$_GET['st']." where booking_id=".$_GET['bid'];
    if($con->query($updQry)){
        ?>
        <script>
            alert('Booking Cancelled')
            window.location="MyBooking.php"
            </script>
            <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Booking</title>
</head>
<body>
<table cellpadding="10" border='1'>
    <tr>
        <td>Sl.No</td>
        <td>Branch</td>
        <td>Contact</td>
        <td>Cloth Count</td>
        <td>Total Amount</td>
        <td>Status</td>
        <td>Action</td>
    </tr>
    <?php
    $selQry="select * from tbl_booking b inner join tbl_branch br on br.branch_id=b.branch_id where b.user_id=".$_SESSION['uid'];
    $res=$con->query($selQry);
    $i=0;
    while($data=$res->fetch_assoc()){
        $i++;
        ?>
        <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['branch_name'] ?></td>
        <td><?php echo $data['branch_contact'] ?></td>
        <td>
            <?php
                $selCloth="select sum(cloth_quantity) as cloth from tbl_cloth where booking_id=".$data['booking_id'];
                $resCloth=$con->query($selCloth);
                $dataCloth=$resCloth->fetch_assoc();
                echo $dataCloth['cloth'];
            ?>
        </td>
        <td><?php echo $data['booking_amount'] ?></td>
        <td>
            <?php
            if($data['booking_status']==0){
                echo "Request Send. Waiting for Shop response";
            }
            else if($data['booking_status']==1){
                echo "Request Accepted";
            }
            else if($data['booking_status']==2){
                echo "Request Rejected";
            }
            else if($data['booking_status']==3){
                echo "Cloth Picked Up";
            }
            else if($data['booking_status']==4){
                echo "Washing Finished.<br>Complete Payment: Rs.".$data['booking_amount'];
            }
            else if($data['booking_status']==5){
                echo "Payment Completed";
            }
            else if($data['booking_status']==6){
                echo "Cloths Returned";
            }
            else if($data['booking_status']==7){
                echo "Cancelled";
            }
            ?>
            </td>
        <td>
            <?php
            if($data['booking_status']<=1){
                ?>
                <a href="MyBooking.php?bid=<?php echo $data['booking_id'] ?>&st=7">Cancel</a><br>
                <?php
            }
            else if($data['booking_status']==4){
                ?>
                <a href="Payment.php?bid=<?php echo $data['booking_id'] ?>">Payment</a><br>
                <?php
            }
            else if($data['booking_status']==6){
                ?>
                <a href="Review.php?bid=<?php echo $data['booking_id'] ?>">Review</a><br>
                <?php
            }
            if($data['booking_status']>=4){
                ?>
                <a href='bill.php?bid=<?php echo $data['booking_id'] ?>' target='_blank'>View Bill</a>
                <?php
            }
            ?>
                <a href="ViewCloth.php?bid=<?php echo $data['booking_id'] ?>">Show Cloths</a><br>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

</body>
</html>