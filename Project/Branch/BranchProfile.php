<?php
include("../Assets/Connection/Connection.php");
session_start();
	ob_start();
	include('Head.php');
$selqry="select * from tbl_branch u inner join tbl_place  inner join tbl_district   where branch_id=".$_SESSION['bid'] ;
$result=$con->query($selqry);
$data=$result->fetch_assoc();

?> 











<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaunTech::Branch::MyProfile</title>
</head>
<body>
<div class="container">
    <form id="form1" name="form1" method="post" action="">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" align="center">
                            <img src="../Assets/Files/Branch/<?php echo $data['branch_photo']; ?>" class="img-fluid" alt="Branch Photo">
                        </td>
                    </tr>
                    <tr>
                        <td width="137">Name</td>
                        <td><?php echo $data["branch_name"]; ?></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><?php echo $data["branch_contact"]; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $data["branch_email"]; ?></td>
                    </tr>
                    <tr>
                        <td>Branch Address</td>
                        <td><?php echo $data['branch_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td><?php echo $data['place_name']; ?></td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td><?php echo $data['district_name']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>