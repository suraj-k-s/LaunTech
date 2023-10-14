<?php
session_start();
include("../Assets/Connection/Connection.php");
ob_start();
include('Head.php');
if(isset($_GET['bid'])){
    $updQry="update tbl_booking set booking_status=".$_GET['st']." where booking_id=".$_GET['bid'];
    if($con->query($updQry)){
        ?>
        <script>
            alert('Updated')
            window.location="Bookings.php"
            </script>
            <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>User</th>
            <th>Contact</th>
            <th>Cloth Count</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $selQry = "select * from tbl_booking b inner join tbl_user u on u.user_id=b.user_id where b.branch_id=" . $_SESSION['bid'];
        $res = $con->query($selQry);
        $i = 0;
        while ($data = $res->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $data['user_name'] ?></td>
                <td><?php echo $data['user_contact'] ?></td>
                <td>
                    <?php
                    $selCloth = "select sum(cloth_quantity) as cloth from tbl_cloth where booking_id=" . $data['booking_id'];
                    $resCloth = $con->query($selCloth);
                    $dataCloth = $resCloth->fetch_assoc();
                    echo $dataCloth['cloth'];
                    ?>
                </td>
                <td>
                    <?php
                    if ($data['booking_status'] == 0) {
                        echo "New Request";
                    } else if ($data['booking_status'] == 1) {
                        echo "Request Accepted";
                    } else if ($data['booking_status'] == 2) {
                        echo "Request Rejected";
                    } else if ($data['booking_status'] == 3) {
                        echo "Cloth Picked Up";
                    } else if ($data['booking_status'] == 4) {
                        echo "Washing Finished";
                    } else if ($data['booking_status'] == 5) {
                        echo "Payment Completed";
                    } else if ($data['booking_status'] == 6) {
                        echo "Cloths Returned";
                    } else if ($data['booking_status'] == 7) {
                        echo "Request Cancelled by User";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($data['booking_status'] == 0) {
                        ?>
                        <a href="Bookings.php?bid=<?php echo $data['booking_id'] ?>&st=1" class="btn btn-primary">Accept</a><br>
                        <a href="Bookings.php?bid=<?php echo $data['booking_id'] ?>&st=2" class="btn btn-danger">Reject</a>
                        <?php
                    } else if ($data['booking_status'] == 1) {
                        ?>
                        <a href="Bookings.php?bid=<?php echo $data['booking_id'] ?>&st=3" class="btn btn-success">Cloth Picked Up</a><br>
                        <?php
                    } else if ($data['booking_status'] == 3) {
                        ?>
                        <a href="Bookings.php?bid=<?php echo $data['booking_id'] ?>&st=4" class="btn btn-success">Washing Finished</a><br>
                        <?php
                    } else if ($data['booking_status'] == 5) {
                        ?>
                        <a href="Bookings.php?bid=<?php echo $data['booking_id'] ?>&st=6" class="btn btn-success">Cloth Returned</a><br>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table> 
</body>
<?php
                    include('Foot.php');
                    ob_flush();
                    ?>
</html>