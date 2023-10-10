<?php

include("../Assets/Connection/connection.php");	
session_start();
ob_start();
include('Head.php');
if(isset($_POST['btn_submit']))
{
	
	$packname=$_POST['txtpackname'];
	$packpriority=$_POST['radio_pack'];
	$packduration=$_POST['txtpackduration'];
	$packdetails=$_POST['txtpackdetails'];
	$packprice=$_POST['txtpackprice'];
	$packpercentage=$_POST['txtpackpercentage'];
	
	$image=$_FILES['packphoto']['name'];
	$path=$_FILES['packphoto']['tmp_name'];
    move_uploaded_file($path,"../Assets/Files/Package/".$image	); 
	
	$insqry="insert into tbl_package(package_name,package_priority,package_duration,package_details,package_price,package_percentage,package_photo)values('$packname','$packpriority','$packduration','$packdetails','$packprice','$packpercentage','$image')";
	
	if($con->query($insqry))
	{
		?>
        <script>
			alert("Successfully Added Package!")
			window.location="AddPackage.php";
		</script>
        
        <?php
	}
	else
	{
		echo "Adding Failed!";
	}
}
	if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$delqry="delete from tbl_package where package_id='$id'";
	$con->query($delqry);
	header("location:AddPackage.php");
	}

?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaunTech::Admin::AddPackage</title>
</head>

<body>
<a href="Homepage.php">Home</a>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="550" height="441" border="1">
   <tr>
      <td width="202">Package Name</td>
      <td width="332"><label for="txtpackname"></label>
      <input type="text" name="txtpackname" id="txtpackname" /></td>
    </tr>
   <tr>
      <td>Package Photo</td>
      <td><label for="packphoto"></label>
      <input type="file" name="packphoto" id="packphoto" /></td>
    </tr>
   
    <tr>
      <td>Package Priority</td>
      <td><input type="radio" name="radio_pack" id="radio_pack" value="Basic" />
      <label for="radio_pack">Basic
        <input type="radio" name="radio_pack" id="radio_pack" value="Standard" />
      Standard 
      <input type="radio" name="radio_pack" id="radio_pack" value="Premium" />
      Premium
      </label></td>
    </tr>
    <tr>
      <td>Package Duration</td>
      <td><label for="txtpackduration"></label>
      <input type="text" name="txtpackduration" id="txtpackduration" /></td>
    </tr>
    <tr>
      <td>Package Details</td>
      <td><label for="txtpackdetails"></label>
      <textarea name="txtpackdetails" id="txtpackdetails" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>Package Price</td>
      <td><label for="txtpackprice"></label>
      <input type="text" name="txtpackprice" id="txtpackprice" /></td>
    </tr>
    <tr>
      <td>Package Percentage</td>
      <td><label for="txtpackpercentage"></label>
      <input type="text" name="txtpackpercentage" id="txtpackpercentage" /></td>
    </tr>
   
   <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
     <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel"/>
      </td>
    </tr>
  </table>
</form>
<table width="500" border="1">
  <tr>
    <td>Sl.No</td>
    <td>Package</td>
    <td>Action</td>
  </tr>
  <?php
	$selqry = "select * from tbl_package";
	$i=0;
	$result = $con->query($selqry);
	while($data = $result->fetch_assoc())
	{
		$i++;
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $data["package_name"];?></td>
			<td><a href="AddPackage.php?id=<?php echo $data["package_id"];?>">Delete</a></td>
	</tr>
    <?php
    }
	?>
 
</table>
<?php
						include('Foot.php');
						ob_flush();
						?>
</html>