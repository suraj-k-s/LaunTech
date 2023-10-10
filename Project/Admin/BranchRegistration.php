
<?php

include("../Assets/Connection/connection.php");	
session_start();
ob_start();
include('Head.php');
if(isset($_POST['btn_submit']))
{
	
	$name=$_POST['txt_name'];
	$contact=$_POST['txt_contact'];
	$email=$_POST['txt_email'];
	$place=$_POST['sl_place'];
	$password=$_POST['txt_password'];
	
	
	$image=$_FILES['file_image']['name'];
	$path=$_FILES['file_image']['tmp_name'];
    move_uploaded_file($path,"../Assets/Files/User/".$image	); 
	
	$insqry="insert into tbl_branch(branch_name,branch_contact,branch_email,place_id,branch_password,branch_photo)values('$name','$contact','$email','$place','$password','$image')";
	echo $insqry;
	if($con->query($insqry))
	{
		?>
        <script>
			alert("Query Inserted")
			window.location="NewUser.php";
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
<title>LaunTech::Admin::NewUser</title>
</head>
<body><form action="" method="post" enctype="multipart/form-data">
  <table width="500" border="1" height="500">
   <tr>
      <td colspan="2" align="center"> New Branch Registration</td>
    </tr>
    <tr>
      <td width="243">Name</td>
      <td width="241"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" required /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" required/></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" required/></td>
    </tr>
        <tr>
      <td>District </td>
      <td><label for="sl_district"></label>
        <select name="sl_district" id="sl_district" onChange="getplace(this.value)">
          <option>--Select--</option>
            <?php
		$selQry="select * from tbl_district";
		$result=$con->query($selQry);
		while($row=$result->fetch_assoc())
		{
		?>
        <option value="<?php echo $row['district_id']  ?>"><?php echo $row['district_name']  ?></option>
        <?php
		}
		?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="sl_place"></label>
        <select name="sl_place" id="sl_place">
        <option>--Select--</option>
      </select></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
     <input type="password" name="txt_password" id="txt_password" title="You must be enter 6 or more charaters" required  pattern="[a-zA-Z0-9.@#$%^&*]{6,30}"/></td>
    </tr>
    <tr>
      <td>Confirm password</td>
      <td><label for="txt_confirmpassword"></label>
     <input type="password" name="txt_password" id="txt_password" title="You must be enter 6 or more charaters" required  pattern="[a-zA-Z0-9.@#$%^&*]{6,30}"/></td>
    </tr>
    <tr>
      <td>Image</td>
      <td><label for="file_image"></label>
      <input type="file" name="file_image" id="file_image" required/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
     <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel"/>
      </td>
    </tr>
  </table>
</form>
</body>
<?php

?>
</body>
<script src="../Assets/JQuery/jQuery.js"></script>
<script>
function getplace(pid)
{
	$.ajax({
		url: "../Assets/AjaxPages/AjaxPlace.php?pid=" + pid,
		success: function(a) {
		
			$("#sl_place").html(a);

		}
	});
}
</script>
<?php
						include('Foot.php');
						ob_flush();
						?>
</html>