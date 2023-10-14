<?php
include("../Assets/Connection/Connection.php");
session_start();
	ob_start();
	include('Head.php');
$selqry="select * from tbl_branch u inner join tbl_place  inner join tbl_district   where branch_id=$_SESSION[bid] ";
$result=$con->query($selqry);
$data=$result->fetch_assoc();




if(isset($_POST['btn_submit']))
{
	$upQry="update tbl_branch set   branch_name='".$_POST["txtname"]."',branch_contact='".$_POST["txtcontact"]."'  where branch_id=$_SESSION[bid]";
	echo $upQry;
	if($con->query($upQry))
	{
		?>
        <script>
			alert("Updated")
			window.location="BranchProfile.php";
		</script>
        <?php
	}
	else
	{
		echo "Insert Failed";
	}
}
?> 











<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LuanTech::Branch::BranchProfile</title>
</head>
<body>
<div class="container">
    <form id="form1" name="form1" method="post" action="">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" align="center">
                            <img src="../Assets/Files/Branch/<?php echo $data['branch_photo']; ?>" class="img-fluid" alt="Branch Photo" />
                        </td>
                    </tr>
                    <tr>
                        <td width="137">Name</td>
                        <td width="229">
                            <input type="text" name="txtname" class="form-control" value="<?php echo $data["branch_name"]; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td>
                            <input type="text" name="txtcontact" class="form-control" value="<?php echo $data["branch_contact"]; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="btn_submit" id="btn_submit" value="Update" class="btn btn-primary" />
                            <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn btn-secondary" />
                        </td>
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